<?php
// tips.php - Travel Tips page: tips, images, links and a destination guide,
// all loaded from the database tables created by db/tips.sql.
// REVIEW FIX (Priyankha, 26 Oct 2026): closed the unclosed HTML comment at the end of the file. Original author: Dimitri.

require_once 'settings.php';

// Turn off mysqli's automatic errors, so a failed connection returns false
// instead of stopping the page with a fatal error (same approach as about.php).
mysqli_report(MYSQLI_REPORT_OFF);

// Connect to the database. @ hides PHP's raw warning if MySQL isn't running.
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
$dbAvailable = ($conn !== false);

// Page headings and text, keyed by section_key, e.g. $sections['intro']['heading']
$sections = [];

// Tip cards to show, one array per tip
$tips = [];

// Rows for the destination quick guide table
$destinations = [];

// Search form values. The form uses GET, so they arrive in the URL, e.g. tips.php?keyword=visa&category=Planning
// trim() removes spaces at the start and end; stripslashes() removes backslashes.
$keyword = stripslashes(trim($_GET['keyword'] ?? ''));
$category = stripslashes(trim($_GET['category'] ?? ''));
$isSearching = ($keyword !== '' || $category !== '');

// Categories for the dropdown (loaded from the database below) and any search error message
$categories = [];
$searchError = '';

if ($dbAvailable) {
    mysqli_set_charset($conn, 'utf8mb4');

    // Load the headings and text for every section of the page
    $result = mysqli_query($conn, "SELECT section_key, heading, body FROM tips_page");
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sections[$row['section_key']] = $row;
        }
    }

    // Load the categories for the dropdown: each category once, in alphabetical order
    $result = mysqli_query($conn, "SELECT DISTINCT category FROM travel_tips ORDER BY category");
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[] = $row['category'];
        }
    }

    // Check the search input on the server
    if (strlen($keyword) > 50) {
        $searchError = 'Please use a search term of 50 characters or fewer.';
    } elseif ($category !== '' && !in_array($category, $categories, true)) {
        $searchError = 'Please choose a category from the list.';
    }

    // Build the tips query from whichever search fields were filled in (same idea as Filter EOIs in manage.php)
    $conditions = [];
    $params = [];

    if ($searchError === '') {
        if ($keyword !== '') {
            // LIKE with % on both sides finds the keyword anywhere in the title or text.
            // addcslashes() makes any % or _ the visitor types count as normal characters.
            $like = '%' . addcslashes($keyword, '%_\\') . '%';
            $conditions[] = '(title LIKE ? OR content LIKE ?)';
            $params[] = $like;
            $params[] = $like;
        }
        if ($category !== '') {
            $conditions[] = 'category = ?';
            $params[] = $category;
        }
    }

    $query = "SELECT * FROM travel_tips";
    if ($conditions) {
        $query .= " WHERE " . implode(' AND ', $conditions);
    }
    $query .= " ORDER BY sort_order";

    // Prepared statement, so whatever the visitor typed can't change the SQL (prevents SQL injection)
    $stmt = mysqli_prepare($conn, $query);
    if ($stmt) {
        if ($params) {
            mysqli_stmt_bind_param($stmt, str_repeat('s', count($params)), ...$params);
        }
        mysqli_stmt_execute($stmt);
        $tips = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
        mysqli_stmt_close($stmt);
    }

          // Load the destinations for the quick guide table, in alphabetical order
         $result = mysqli_query($conn, "SELECT * FROM travel_destinations ORDER BY destination");
         if ($result) {
             $destinations = mysqli_fetch_all($result, MYSQLI_ASSOC);
         }


    mysqli_close($conn);
}

$page_title = 'Travel Tips | HireHub';
$body_class = 'tips-page';

// Embedded CSS: styles only this page uses, printed in a <style> block in the <head> by header.inc
$page_css = '
    /* Search form laid out with grid: keyword, category, button side by side */
    .tips-search {
        display: grid;
        grid-template-columns: 2fr 1fr auto;
        gap: 10px;
        align-items: end;
    }
    .tips-search label {
        display: block;
        font-weight: bold;
        margin-bottom: 4px;
    }
    .tips-search input,
    .tips-search select,
    .tips-search button {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }
    @media screen and (max-width: 600px) {
        .tips-search {
            grid-template-columns: 1fr;
        }
    }
';

include 'header.inc';
?>
<main>
    <?php if (!$dbAvailable): ?>
        <h1>Travel Tips</h1>
        <p>Sorry, travel tips are currently unavailable. Please try again later.</p>
    <?php else: ?>
        <h1><?php echo htmlspecialchars($sections['intro']['heading'] ?? 'Travel Tips'); ?></h1>
         <!-- Inline CSS: slightly larger intro text, kept to a readable line length -->
         <p style="font-size: 1.1rem; max-width: 750px;"><?php echo htmlspecialchars($sections['intro']['body'] ?? ''); ?></p>

        <!-- Search form: filters the tip cards by keyword and/or category -->
        <section>
            <h2><?php echo htmlspecialchars($sections['search']['heading'] ?? 'Find a tip'); ?></h2>
            <p><?php echo htmlspecialchars($sections['search']['body'] ?? ''); ?></p>

             <form method="get" action="tips.php" class="tips-search">
                <div>
                    <label for="keyword">Keyword</label>
                    <input type="text" id="keyword" name="keyword" maxlength="50" value="<?php echo htmlspecialchars($keyword); ?>">
                </div>

                <div>
                    <label for="category">Category</label>
                    <select id="category" name="category">
                        <option value="">All categories</option>
                        <?php foreach ($categories as $option): ?>
                            <option value="<?php echo htmlspecialchars($option); ?>" <?php if ($option === $category) echo 'selected'; ?>><?php echo htmlspecialchars($option); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit">Search</button>
            </form>

            <?php if ($searchError !== ''): ?>
                 <!-- Inline CSS: makes the error message red and bold -->
                 <p style="color: #9b1c1c; font-weight: bold;"><?php echo htmlspecialchars($searchError); ?></p>
            <?php elseif ($isSearching): ?>
                <p><?php echo count($tips); ?> tip(s) found. <a href="tips.php">Show all tips</a></p>
            <?php endif; ?>
        </section>

        <!-- Tip cards: one card per row in the travel_tips table -->
        <section>
            <h2><?php echo htmlspecialchars($sections['tips']['heading'] ?? 'Our top tips'); ?></h2>
            <p><?php echo htmlspecialchars($sections['tips']['body'] ?? ''); ?></p>

            <?php if (empty($tips)): ?>
                 <p>No tips match your search. Try a different keyword or category.</p>
            <?php else: ?>
                <div class="tips-grid">
                    <?php foreach ($tips as $tip): ?>
                        <article class="tip-card">
                            <img src="<?php echo htmlspecialchars($tip['image_path']); ?>"
                                 alt="<?php echo htmlspecialchars($tip['image_alt']); ?>"
                                 width="600" height="400">
                            <p class="tip-category"><?php echo htmlspecialchars($tip['category']); ?></p>
                            <h3><?php echo htmlspecialchars($tip['title']); ?></h3>
                            <p><?php echo htmlspecialchars($tip['content']); ?></p>

                            <!-- Only tips with a link_url get a link -->
                            <?php if (!empty($tip['link_url'])): ?>
                                <?php if (preg_match('/^https?:\/\//', $tip['link_url'])): ?>
                                    <!-- External link (starts with http:// or https://): opens in a new tab -->
                                    <p><a href="<?php echo htmlspecialchars($tip['link_url']); ?>" target="_blank" rel="noopener noreferrer"><?php echo htmlspecialchars($tip['link_text']); ?> (opens in a new tab)</a></p>
                                <?php else: ?>
                                    <!-- Internal link to another page on our site, e.g. jobs.php -->
                                    <p><a href="<?php echo htmlspecialchars($tip['link_url']); ?>"><?php echo htmlspecialchars($tip['link_text']); ?></a></p>
                                <?php endif; ?>
                            <?php endif; ?>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

                <!-- Destination quick guide: one table row per row in travel_destinations -->
        <section>
            <h2><?php echo htmlspecialchars($sections['destinations']['heading'] ?? 'Destination quick guide'); ?></h2>

            <?php if (empty($destinations)): ?>
                <p>No destinations found.</p>
            <?php else: ?>
                <table>
                    <caption><?php echo htmlspecialchars($sections['destinations']['body'] ?? ''); ?></caption>
                    <thead>
                        <tr>
                            <th scope="col">Destination</th>
                            <th scope="col">Best time to visit</th>
                            <th scope="col">Weather</th>
                            <th scope="col">Currency</th>
                            <th scope="col">Quick tip</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($destinations as $place): ?>
                            <tr>
                                <th scope="row"><?php echo htmlspecialchars($place['destination']); ?></th>
                                <td><?php echo htmlspecialchars($place['best_time']); ?></td>
                                <td><?php echo htmlspecialchars($place['weather']); ?></td>
                                <td><?php echo htmlspecialchars($place['currency']); ?></td>
                                <td><?php echo htmlspecialchars($place['quick_tip']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>

    <?php endif; ?>
</main>
<?php include 'footer.inc'; ?>

<!-- AI was used in the making of this file, speciffically in the formatting and creation process, prompt:"how should i format a tips page according do the data / structure of other pages i made (old index.html and manage.php)"-->
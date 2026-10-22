
<?php
// Task 4: Display job listings dynamically from the database
// Group 02 - Tourism and Travel

require_once 'settings.php';
$databaseError = false;

// Connect to the database
mysqli_report(MYSQLI_REPORT_OFF);
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
    http_response_code(500);
    $page_title = "Jobs | HireHub";
    $body_class = "jobs-page";

    include 'header.inc';
    echo '<main>';
    echo '<h1 class="page-title">Career Opportunities</h1>';
    echo '<section>';
    echo '<h2>Jobs Temporarily Unavailable</h2>';
    echo '<p>Sorry, we could not load the job listings right now. Please try again later.</p>';
    echo '</section>';
    echo '</main>';
    include 'footer.inc';
    exit;
}

// Set database character encoding
if (!mysqli_set_charset($conn, 'utf8mb4')) {
    mysqli_close($conn);
    http_response_code(500);

    $page_title = "Jobs | HireHub";
    $body_class = "jobs-page";

    include 'header.inc';
    echo '<main>';
    echo '<h1 class="page-title">Career Opportunities</h1>';
    echo '<section>';
    echo '<h2>Jobs Temporarily Unavailable</h2>';
    echo '<p>Sorry, we could not load the job listings right now. Please try again later.</p>';
    echo '</section>';
    echo '</main>';
    include 'footer.inc';
    exit;
}

// Get the search term from the URL
$search = trim($_GET['search'] ?? '');

// Retrieve job listings, filtering when a search term is entered
if ($search !== '') {
    $query = "SELECT * FROM jobs
              WHERE title LIKE ?
              OR jobRef LIKE ?
              OR description LIKE ?
              ORDER BY jobRef";

    $stmt = mysqli_prepare($conn, $query);
    $searchTerm = '%' . $search . '%';

    mysqli_stmt_bind_param($stmt, "sss", $searchTerm, $searchTerm, $searchTerm);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
} else {
    $query = "SELECT * FROM jobs ORDER BY jobRef";
    $result = mysqli_query($conn, $query);
}

if (!$result) {
    mysqli_close($conn);
    http_response_code(500);

    $page_title = "Jobs | HireHub";
    $body_class = "jobs-page";

    include 'header.inc';

    echo '<main>';
    echo '<h1 class="page-title">Career Opportunities</h1>';
    echo '<section>';
    echo '<h2>Jobs Temporarily Unavailable</h2>';
    echo '<p>Sorry, we could not retrieve the job listings right now. Please try again later.</p>';
    echo '</section>';
    echo '</main>';

    include 'footer.inc';
    exit;
}

// Store the job records
$jobs = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close the database connection
mysqli_free_result($result);
mysqli_close($conn);

// Safely display text from the database
function displayJobText($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

// Convert each line of requirements into a list item
function displayJobList($text) {
    $items = preg_split('/\r\n|\r|\n/', $text);

    foreach ($items as $item) {
        $item = trim($item);

        if ($item !== '') {
            echo '<li>' . displayJobText($item) . '</li>';
        }
    }
}

$page_title = "Jobs | HireHub";
$body_class = "jobs-page";
include 'header.inc';
?>

    <main>
        <h1 class="page-title">Career Opportunities</h1>

        <form action="jobs.php" method="get">
    <label for="search">Search Jobs:</label>

    <input
        type="text"
        id="search"
        name="search"
        placeholder="Search jobs..."
        value="<?php echo displayJobText($search); ?>"
    >

    <button type="submit">Search</button>
    <a href="jobs.php">Clear Search</a>
</form>

        <aside>
            <h2>Why Work With Us?</h2>

            <p>
                Join a team that combines tourism, technology and digital innovation.
            </p>

            <ul>
                <li>Work on modern travel technology.</li>
                <li>Help improve digital experiences for travellers.</li>
                <li>Develop your technical and communication skills.</li>
                <li>Work in a collaborative team environment.</li>
            </ul>
        </aside>

        <?php if (empty($jobs)): ?>

    <section>
        <h2>No Current Vacancies</h2>
        <p>There are currently no job opportunities available. Please check back later.</p>
    </section>

        <?php else: ?>

            <?php foreach ($jobs as $job): ?>

                <section>
                    <h2><?php echo displayJobText($job['title']); ?></h2>

                    <p>
                        <strong>Reference Number:</strong>
                        <?php echo displayJobText($job['jobRef']); ?>
                    </p>

                    <p>
                        <strong>Salary:</strong>
                        <?php echo displayJobText($job['salary']); ?>
                    </p>

                    <p>
                        <strong>Reports To:</strong>
                        <?php echo displayJobText($job['reportsTo']); ?>
                    </p>

                    <p>
                        <?php echo displayJobText($job['description']); ?>
                    </p>

                    <h3>Key Responsibilities</h3>
                    <ul>
                        <?php displayJobList($job['responsibilities']); ?>
                    </ul>

                    <h3>Essential Requirements</h3>

                    <?php if ($job['jobRef'] === 'TRV101'): ?>
                        <ol>
                            <?php displayJobList($job['essentialRequirements']); ?>
                        </ol>
                    <?php else: ?>
                        <ul>
                            <?php displayJobList($job['essentialRequirements']); ?>
                        </ul>
                    <?php endif; ?>

                    <h3>Preferable Requirements</h3>
                    <ul>
                        <?php displayJobList($job['preferableRequirements']); ?>
                    </ul>

                    <p>
    <a href="apply.php?jobRef=<?php echo urlencode($job['jobRef']); ?>"
       class="apply-button">
        Apply Now
    </a>
</p>
                </section>

            <?php endforeach; ?>

        <?php endif; ?>

    </main>

<?php include 'footer.inc'; ?>

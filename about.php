<?php
// about.php - About page: group details, member contributions, quotes, photo and fun facts, all loaded from the database...
$page_title = "About the Team | HireHub";
$body_class = "about-page";
include 'header.inc';
?>
<?php
// Connect to the database (same settings.php used by the other pages)
require_once "settings.php";
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);  // @hides the raw php warning if MySQL is down
if ($conn) {
	mysqli_set_charset($conn, "utf8mb4");
}
?>
	<main>
		<h1 class="page-title-spaced">About the Team</h1>
		<?php if (!$conn) { ?>
			<p>Sorry, the team information is currently unavailable. Please try again later.</p>
		<?php } else { ?>
		<?php
		// Group details, read once and reused for the team details and the photo
		$result= mysqli_query($conn, "SELECT * FROM about_group");
        $group = mysqli_fetch_assoc($result);
        ?>
        <section class="team-details">
            <h2>Team Details</h2>
            <ul>
                <li>Group name:
                    <ul>
                        <li><?php echo htmlspecialchars($group['group_name']); ?></li>
                    </ul>
                </li>
                <li>Tutorial class:
                    <ul>
                        <li><?php echo htmlspecialchars($group['class_day']); ?></li>
                        <li><?php echo htmlspecialchars($group['class_time']); ?></li>
                    </ul>
                </li>
            </ul>
        </section>

		<section>
			<h2>Member Contributions</h2>
			<dl>
			  <?php
                $result = mysqli_query($conn, "SELECT full_name, part1_work, part2_work FROM members ORDER BY member_id");
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<dt>" . htmlspecialchars($row['full_name']) . "</dt>";
                        echo "<dd><strong>Project Part 1:</strong> " . htmlspecialchars($row['part1_work']) . "</dd>";
                        echo "<dd><strong>Project Part 2:</strong> " . htmlspecialchars($row['part2_work']) . "</dd>";
                    }
                } else {
                    echo "<dd>There are no members to display.</dd>";
                }
                ?>
			</dl>	
		</section>

		<section>
            <h2>Member Quotes</h2>
            <?php
            $result = mysqli_query($conn, "SELECT full_name, quote, quote_translation FROM members ORDER BY member_id");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<blockquote>";
                echo "<p>&ldquo;" . htmlspecialchars($row['quote']) . "&rdquo;</p>";
                if (!empty($row['quote_translation'])) {
                    echo "<p>English translation: &ldquo;" . htmlspecialchars($row['quote_translation']) . "&rdquo;</p>";
                }
                echo "<cite>" . htmlspecialchars($row['full_name']) . "</cite>";
                echo "</blockquote>";
            }
            ?>
        </section>

		 <section>
            <h2>Meet the team</h2>
            <figure>
                <img src="<?php echo htmlspecialchars($group['photo_path']); ?>"
                     alt="<?php echo htmlspecialchars($group['photo_alt']); ?>" width="900">
                <figcaption><?php echo htmlspecialchars($group['photo_caption']); ?></figcaption>
            </figure>
        </section>
		
		<section>
            <h2>Fun Facts</h2>
            <table>
                <caption>Fun facts about the team</caption>
                <thead>
                    <tr>
                        <th scope="col">Member</th>
                        <th scope="col">Fun fact</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT full_name, fun_fact FROM members ORDER BY member_id");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<th scope=\"row\">" . htmlspecialchars($row['full_name']) . "</th>";
                        echo "<td>" . htmlspecialchars($row['fun_fact']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
		<?php mysqli_close($conn); ?>
		<?php } ?>
	</main>

<?php include 'footer.inc'; ?>
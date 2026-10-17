<?php
// about.php - About page for the HireHub project: team details, contributions,
// quotes, group photo and fun facts (made dynamic in a later step).
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
	<?php } ?>
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
			<blockquote>
				<p>&ldquo;Work hard, play hard.&rdquo;</p>
				<cite>Priyankha Sakthivel</cite>
			</blockquote>
			<blockquote>
				<p>&ldquo;Arriver en avance est inacceptable, arriver à l'heure revient à être en retard, et arriver à la dernière minute, c'est être à l'heure.&rdquo;</p>
				<p>English translation: &ldquo;To be early is unacceptable to be on time is to be late and to be last minute is to be on time.&rdquo;</p>
				<cite>Dimitri Meric </cite>
			</blockquote>
			<blockquote>
				<p>&ldquo;If it works, don't ask too many questions.&rdquo;</p>
				<cite>Thomas Mathew </cite>
			</blockquote>
            			<blockquote>
				<p>&ldquo;大家好&rdquo;</p>
				<p>English translation: &ldquo;Hello Everyone.&rdquo;</p>
				<cite>Kevin Tan </cite>
			</blockquote>
            			<blockquote>
				<p>&ldquo;石の上にも三年(Ishi no ue ni mo san nen).&rdquo;</p>
				<p>English translation: &ldquo;Perseverance changes things.&rdquo;</p>
				<cite>Mark Leirum </cite>
			</blockquote>
		</section>
		<section>
			<h2>Meet the team</h2>
			<figure>
				<img src="images/group_photo.jpg" alt="WebDevs team group photo, photo collage of five members" width="900">
				<figcaption>WebDevs Group</figcaption>
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
					<tr>
						<th scope="row">Priyankha Sakthivel</th>
						<td>Always has a book on the go.</td>
					</tr>
					<tr>
						<th scope="row">Dimitri Meric</th>
						<td>I'm french, you can make fun of me now</td>
					</tr>
					<tr>
						<th scope="row">Thomas Mathew </th>
						<td>Professional last-minute problem solver.</td>
					</tr>
                    					<tr>
						<th scope="row">Kevin Tan </th>
						<td>My left hand fingers are longer than my right.</td>
					</tr>
                    					<tr>
						<th scope="row">Mark Leirum </th>
						<td>Can either be found sleeping or running around, no inbetween.</td>
					</tr>
				</tbody>
			</table>
		</section>
	</main>

<?php include 'footer.inc'; ?>

<?php
// index.php - Home page: hero, partner logos, office locations table and acknowledgement of Country.
$page_title = "HireHub | Travel & Tourism Careers";
$body_class = "home-page";
include 'header.inc';
?>
<?php 
// Load the three latest job listings so the home page is database driven.
require_once 'settings.php';
mysqli_report(MYSQLI_REPORT_OFF);
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
$latestJobs = [];
if ($conn) {
    mysqli_set_charset($conn, 'utf8mb4');
    $result = mysqli_query($conn, "SELECT jobRef, title, salary FROM jobs ORDER BY jobRef LIMIT 3");
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $latestJobs[] = $row;
        }
        mysqli_free_result($result);
    }
    mysqli_close($conn);
}
?>
<main>
<section class="hero">
  <h1>Your Odyssey To Success</h1>
  <p> HireHub is your ticket to finding a career in the tourism and travelling. From booking agents to travel planners, we have a diverse portfolio of paths we can help you walk in this competitive industry</p>
  <a href="jobs.php" class="btn">View Job Opportunities</a>
</section>

<?php if (!empty($latestJobs)): ?>
<section class="latest-jobs">
  <h2>Latest Opportunities</h2>
  <ul>
    <?php foreach ($latestJobs as $job): ?>
      <li>
        <a href="jobs.php#job-<?php echo htmlspecialchars($job['jobRef']); ?>">
          <?php echo htmlspecialchars($job['title']); ?>
        </a>
        — <?php echo htmlspecialchars($job['salary']); ?>
      </li>
    <?php endforeach; ?>
  </ul>
  <p><a href="jobs.php" class="btn">See all jobs</a></p>
</section>
<?php endif; ?>

<section class="employers">
  <h2>Our Trusted Partners</h2>
  <img src="images/image.png" alt="Collage of companies affiliated with HireHub">
</section>

<section class="offices">
  <h2>Physical Locations</h2>
  <table>
    <caption>Our Offices</caption>
    <thead>
      <tr>
        <th scope="col">City</th>
        <th scope="col">Focus Area</th>
        <th scope="col">Contact</th>
      </tr>
    </thead>
    <tbody>
      <tr><th scope="colgroup" colspan="3">Victoria</th></tr>
      <tr>
        <td class="hq-city">Melbourne (HQ)</td>
        <td>Partnerships, Help centre</td>
        <td>03 0009 4569</td>
      </tr>

      <tr><th scope="colgroup" colspan="3">New South Wales</th></tr>
      <tr>
        <td>Sydney</td>
        <td>Platforms &amp; Bookings</td>
        <td>02 0009 4569</td>
      </tr>

      <tr><th scope="colgroup" colspan="3">Western Australia</th></tr>
      <tr>
        <td>Perth</td>
        <td>Internal Logistics &amp; Human Resources</td>
        <td>08 0009 4469</td>
      </tr>
    </tbody>
  </table>
</section>

<!--Acknowledgement Of Country-->
<section aria-label="Acknowledgement of Country" class="acknowledgement">
  <h2>Acknowledgement of Country</h2>
  <p>HireHub recognises the historical and cultural significance of the Kulin Nation, the Eora Nation and the Noongar Nation, on which our Melbourne, Sydney and Perth offices are located. Each day we all walk on traditional Indigenous lands. We therefore acknowledge the traditional custodians of each of these lands, namely the Wurundjeri Woi Wurrung people, the Gadigal people and the Whadjuk people, and pay respect to Elders past and present.</p>
  <p>As a travel technology platform, HireHub is committed to partnering with Aboriginal and Torres Strait Islander-led tourism operators, ensuring cultural experiences on our platform are curated in genuine consultation with the communities they represent.</p>
</section>
</main>
<?php include 'footer.inc'; ?>
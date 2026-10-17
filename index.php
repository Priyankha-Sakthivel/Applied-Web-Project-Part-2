<?php
// index.php - Home page: hero, partner logos, office locations table and acknowledgement of Country.
$page_title = "HireHub | Travel & Tourism Careers";
$body_class = "home-page";
include 'header.inc';
?>
<main>
<section class="hero">
  <h1>Your Odyssey To Success</h1>
  <p> HireHub is your ticket to finding a career in the tourism and travelling. From booking agents to travel planners, we have a diverse portfolio of paths we can help you walk in this competitive industry</p>
  <a href="jobs.php" class="btn">View Job Opportunities</a>
</section>
<section class="employers">
  <h2>Our Trusted Partners</h2>
  <img src="images/image.png" alt="Collage of companies affiliated with HireHub">
</section>
<section class="offices">
  <h2>Physical Locations</h2>
  <table>
    <caption>Our Offices</caption>
    <tr>
      <th colspan="3">Victoria</th>
    </tr>
    <tr>
      <th>City</th>
      <th>Focus Area</th>
      <th>Contact</th>
    </tr>
    <tr>
      <td class="hq-city">Melbourne (HQ)</td> 
      <td>Partnerships, Help centre</td>
      <td>03 0009 4569</td>
    </tr>

    <tr>
      <th colspan="3">New South Wales</th>
    </tr>
    <tr>
      <th>City</th>
      <th>Focus Area</th>
      <th>Contact</th>
    </tr>
    <tr>
      <td>Sydney</td>
      <td>Platforms &amp; Bookings</td>
      <td>02 0009 4569</td>
    </tr>

    <tr>
      <th colspan="3">Western Australia</th>
    </tr>
    <tr>
      <th>City</th>
      <th>Focus Area</th>
      <th>Contact</th>
    </tr>
    <tr>
      <td>Perth</td>
      <td>Internal Logistics &amp; Human Resources</td>
      <td>08 0009 4469</td>
    </tr>
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
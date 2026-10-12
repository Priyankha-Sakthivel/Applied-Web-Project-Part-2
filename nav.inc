<?php
// nav.inc - shared navigation; highlights the current page automatically.
$current = basename($_SERVER['PHP_SELF']);
?>
<nav aria-label="Main navigation">
  <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="jobs.php">Jobs</a></li>
    <li><a href="apply.php">Apply</a></li>
    <li><a href="about.php">About</a></li>
  </ul>
</nav>
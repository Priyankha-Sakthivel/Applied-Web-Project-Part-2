<?php
// nav.inc - shared navigation; highlights the current page automatically.
$current = basename($_SERVER['PHP_SELF']);
?>
<nav aria-label="Main navigation">
  <ul>
    <li><a href="index.php" <?php if ($current == 'index.php') echo 'class="active" aria-current="page"'; ?>>Home</a></li>
    <li><a href="jobs.php" <?php if ($current == 'jobs.php') echo 'class="active" aria-current="page"'; ?>>Jobs</a></li>
    <li><a href="apply.php" <?php if ($current == 'apply.php') echo 'class="active" aria-current="page"'; ?>>Apply</a></li>
    <li><a href="about.php" <?php if ($current == 'about.php') echo 'class="active" aria-current="page"'; ?>>About</a></li>
    <li><a href="tips.php" <?php if ($current == 'tips.php') echo 'class="active" aria-current="page"'; ?>>Travel Tips</a></li>
  </ul>
</nav>
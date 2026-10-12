<?php // header.inc ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="HireHub is a travel technology platform advertising travel and tourism job vacancies in areas near you.">
        <meta name="keywords" content="travel jobs, tourism careers, HireHub, job vacancies, travel technology,making a difference">
        <meta name="author" content="HireHub">
        <title>HireHub | Travel &amp; Tourism Careers</title>
        <link rel="stylesheet" href="styles/styles.css">
        <style>
        /*Embedded CSS: page specific print rule that makes only this page have a logo collage worth hiding when printed */
            @media print {
                .employers {
                display: none;
                }
            }
        </style>
    </head>

    <body class="home-page">
    <header>
        <a href="index.php" class="brand">
            <img src="images/Logo.png" alt="HireHub Logo" width="100">
            <span>HireHub</span>
        </a>
        <nav>
        <ul>
            <li><a href="index.php" class="active" aria-current="page">Home</a></li>
            <li><a href="jobs.php">Job Description</a></li>
            <li><a href="apply.php">Apply</a></li>
            <li><a href="about.php">About</a></li>
        </ul>
        </nav>
    </header>
<?php include 'nav.inc'; ?>
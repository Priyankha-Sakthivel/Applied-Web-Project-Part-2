<?php
// header.inc - shared <head>, logo and navigation for every page.
// Each page sets $page_title and $body_class (optionally $page_description) before including this file.
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($page_description ?? 'HireHub is a travel technology platform advertising travel and tourism job vacancies.') ?>">
    <meta name="keywords" content="travel jobs, tourism careers, HireHub, job vacancies, travel technology">
    <meta name="author" content="HireHub">
    <title><?php echo htmlspecialchars($page_title ?? 'HireHub | Travel & Tourism Careers'); ?></title>
    <link rel="stylesheet" href="styles/styles.css">
</head>
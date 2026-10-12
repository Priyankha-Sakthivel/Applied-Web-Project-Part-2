<?php
// Task 3: Process job applications
// Group 02 - Tourism and Travel

require_once 'settings.php';

// Only accept form submissions using POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Invalid request. Please submit the application form.');
}

// Read submitted application details
$jobRef = trim($_POST['jobRef'] ?? '');
$firstName = trim($_POST['firstName'] ?? '');
$lastName = trim($_POST['lastName'] ?? '');
$dob = trim($_POST['dob'] ?? '');
$gender = trim($_POST['gender'] ?? '');

$streetAddress = trim($_POST['streetAddress'] ?? '');
$suburb = trim($_POST['suburb'] ?? '');
$state = trim($_POST['state'] ?? '');
$postcode = trim($_POST['postcode'] ?? '');

$email = trim($_POST['email'] ?? '');
$phoneNum = trim($_POST['phoneNum'] ?? '');

$skills = $_POST['skills'] ?? [];
$otherSkills = trim($_POST['otherSkills'] ?? '');
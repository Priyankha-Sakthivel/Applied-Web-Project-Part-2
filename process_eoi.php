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

// Check that all required fields have been submitted
$requiredFields = [
    'Job Reference' => $jobRef,
    'First Name' => $firstName,
    'Last Name' => $lastName,
    'Date of Birth' => $dob,
    'Gender' => $gender,
    'Street Address' => $streetAddress,
    'Suburb' => $suburb,
    'State' => $state,
    'Postcode' => $postcode,
    'Email' => $email,
    'Phone Number' => $phoneNum
];

foreach ($requiredFields as $field => $value) {
    if ($value === '') {
        http_response_code(400);
        exit("Error: $field is required.");
    }
}

// Validate job reference: exactly 6 letters or numbers
if (!preg_match('/^[A-Za-z0-9]{6}$/', $jobRef)) {
    exit('Error: Job reference must contain exactly 6 letters or numbers.');
}

// Validate applicant names
if (!preg_match('/^[A-Za-z]{1,20}$/', $firstName) ||
    !preg_match('/^[A-Za-z]{1,20}$/', $lastName)) {
    exit('Error: First and last names must contain 1 to 20 letters.');
}
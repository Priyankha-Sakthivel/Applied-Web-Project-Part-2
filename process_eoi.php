<?php
// Task 3: Process job applications
// Group 02 - Tourism and Travel

require_once 'settings.php';

// Only accept form submissions using POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Invalid request. Please submit the application form.');
}
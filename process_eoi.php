
<?php
// Task 3: Process job applications
// Group 02 - Tourism and Travel

require_once 'settings.php';

// Display validation errors using the normal website layout
function showApplicationError($message) {
    http_response_code(400);

    $page_title = "Application Error | HireHub";
    $body_class = "apply-page";

    include 'header.inc';
    ?>

    <main>
        <h1 class="page-title">Application Error</h1>

        <section>
            <p><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
            <p>Please check your details and try again.</p>
            <p><a href="apply.php">Return to Application Form</a></p>
        </section>
    </main>

    <?php
    include 'footer.inc';
    exit;
}

// Display database errors using the normal website layout
function showDatabaseError($message) {
    http_response_code(500);

    $page_title = "Database Error | HireHub";
    $body_class = "apply-page";

    include 'header.inc';
    ?>

    <main>
        <h1 class="page-title">Something Went Wrong</h1>

        <section>
            <p><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
            <p>Please try again later.</p>
            <p><a href="index.php">Return to Home</a></p>
        </section>
    </main>

    <?php
    include 'footer.inc';
    exit;
}

// Only accept form submissions using POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: apply.php');
    exit;
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
        showApplicationError("$field is required.");
    }
}

// Validate job reference: exactly 6 letters or numbers
if (!preg_match('/^[A-Za-z0-9]{6}$/', $jobRef)) {
    showApplicationError('Job reference must contain exactly 6 letters or numbers.');
}

// Validate applicant names
if (!preg_match('/^[A-Za-z]{1,20}$/', $firstName) ||
    !preg_match('/^[A-Za-z]{1,20}$/', $lastName)) {
    showApplicationError('First and last names must contain 1 to 20 letters.');
}

// Validate date of birth in dd/mm/yyyy format
$date = DateTime::createFromFormat('!d/m/Y', $dob);

if (!$date || $date->format('d/m/Y') !== $dob) {
    showApplicationError('Please enter a valid date of birth in dd/mm/yyyy format.');
}

// Check that the applicant is not born in the future
if ($date > new DateTime('today')) {
    showApplicationError('Date of birth cannot be in the future.');
}

// Convert to MySQL DATE format
$dob = $date->format('Y-m-d');

// Validate gender
$validGenders = ['Male', 'Female', 'Other', 'Prefer not to say'];

if (!in_array($gender, $validGenders, true)) {
    showApplicationError('Please select a valid gender.');
}

// Validate street address
if (strlen($streetAddress) < 2 || strlen($streetAddress) > 40) {
    showApplicationError('Street address must be between 2 and 40 characters.');
}

// Validate suburb
if (!preg_match("/^[A-Za-z0-9 ]{2,40}$/", $suburb)) {
    showApplicationError('Please enter a valid suburb.');
}

// Validate Australian state
$validStates = ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'];

if (!in_array($state, $validStates, true)) {
    showApplicationError('Please select a valid Australian state.');
}

// Validate postcode
if (!preg_match('/^[0-9]{4}$/', $postcode)) {
    showApplicationError('Postcode must contain exactly 4 digits.');
}

// Validate email address
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    showApplicationError('Please enter a valid email address.');
}

// Validate phone number: 8 to 12 digits
if (!preg_match('/^[0-9]{8,12}$/', $phoneNum)) {
    showApplicationError('Phone number must contain 8 to 12 digits.');
}

// Validate selected skills
$allowedSkills = [
    'adaptability',
    'communication',
    'problem-solving',
    'time_Management',
    'conflict_resolution'
];

if (!is_array($skills)) {
    showApplicationError('Invalid skills selection.');
}

foreach ($skills as $skill) {
    if (!in_array($skill, $allowedSkills, true)) {
        showApplicationError('Invalid skill selected.');
    }
}

// Validate other skills length
if (strlen($otherSkills) > 1000) {
    showApplicationError('Other skills must not exceed 1000 characters.');
}

// Connect to the project database
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

// Check the connection before running any database queries
if (!$conn) {
    showDatabaseError('Unable to connect to the database.');
}

// Use UTF-8 for database communication
if (!mysqli_set_charset($conn, 'utf8mb4')) {
    mysqli_close($conn);
    http_response_code(500);
    exit('Error: Unable to configure the database connection.');
}

// Create the EOI table if it does not already exist
$createTableQuery = "CREATE TABLE IF NOT EXISTS eoi (
    EOInumber INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    jobRef VARCHAR(6),
    firstName VARCHAR(20),
    lastName VARCHAR(20),
    dob DATE,
    gender VARCHAR(20),
    streetAddress VARCHAR(40),
    suburb VARCHAR(40),
    state CHAR(3),
    postcode CHAR(4),
    email VARCHAR(255),
    phoneNum VARCHAR(12),
    skills TEXT,
    otherSkills TEXT,
    status ENUM('New', 'Current', 'Final') NOT NULL DEFAULT 'New'
)";

if (!mysqli_query($conn, $createTableQuery)) {
    mysqli_close($conn);
    http_response_code(500);
    exit('Unable to prepare the application database. Please try again later.');
}

// Convert selected skills into a string
$skillsText = implode(', ', $skills);

// Insert the application using a prepared statement
$query = "INSERT INTO eoi
    (jobRef, firstName, lastName, dob, gender,
     streetAddress, suburb, state, postcode,
     email, phoneNum, skills, otherSkills)
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    mysqli_close($conn);
    http_response_code(500);
    exit('Error: Unable to prepare the application.');
}

mysqli_stmt_bind_param(
    $stmt,
    "sssssssssssss",
    $jobRef,
    $firstName,
    $lastName,
    $dob,
    $gender,
    $streetAddress,
    $suburb,
    $state,
    $postcode,
    $email,
    $phoneNum,
    $skillsText,
    $otherSkills
);

if (!mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    http_response_code(500);
    exit('Error: Unable to save the application.');
}

$eoiNumber = mysqli_insert_id($conn);

mysqli_stmt_close($stmt);
mysqli_close($conn);

// Display confirmation using the normal HireHub layout
$page_title = "Application Confirmation | HireHub";
$body_class = "apply-page";

include 'header.inc';
?>

<main>
    <h1 class="page-title">Application Submitted Successfully!</h1>

    <section>
        <h2>Thank You for Applying</h2>

        <p>Your application has been submitted successfully.</p>

        <p>
            <strong>Your EOI Reference Number:</strong>
            <?php echo htmlspecialchars((string)$eoiNumber, ENT_QUOTES, 'UTF-8'); ?>
        </p>

        <p>
            <strong>Application Status:</strong> New
        </p>

        <p>Please keep your EOI reference number for future enquiries.</p>

        <p>
            <a href="index.php">Return to Home</a>
        </p>
    </section>
</main>

<?php include 'footer.inc'; ?>

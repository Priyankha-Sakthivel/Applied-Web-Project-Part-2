<?php
// manage.php - HR manager queries on the eoi table.

session_start();

// TODO - Redirect anyone who isn't logged in to login.php, waiting on Mark to write/let me know which $_SESSION variable does login.php set.
// if (!isset($_SESSION['NAME_FROM_MARK'])) {
//     header('Location: login.php');
//     exit;
// }

require_once 'settings.php';

// Holds the EOIs to show in the results table.
// null = no list requested yet, so the results section stays hidden.
$results = null; 

// Message to show if the search form is filled in the wrong way
$error = '';

// Sort fields the manager can choose from: column name => label shown in the dropdown.
// Column names can't be sent as ? placeholders, so the chosen value is checked against this list instead (the whitelist). Anything else falls back to EOI number.
$sortFields = [
    'EOInumber' => 'EOI number',
    'jobRef' => 'Job reference',
    'firstName' => 'First name',
    'lastName' => 'Last name',
    'status' => 'Status',
];

// Reads the chosen sort field. If it's missing or not in the list, sorts by EOI number.
$sort = $_GET['sort'] ?? 'EOInumber';
if (!array_key_exists($sort, $sortFields)) {
    $sort = 'EOInumber';
}




// List of all EOIs: runs when the "List all EOIs" button is clicked
if (($_GET['action'] ?? '') === 'list-all') {
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);
    $result = mysqli_query($conn, "SELECT * FROM eoi ORDER BY $sort");
    $results = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
}

// Filter EOIs: runs when "Search EOIs" is clicked, which loads the page as manage.php?action=filter&jobRef=...&firstName=...&lastName=...
if (($_GET['action'] ?? '') === 'filter') {
// Read the three search boxes. trim() removes spaces from the start and end
    $jobRef = trim($_GET['jobRef'] ?? '');
    $firstName = trim($_GET['firstName'] ?? '');
    $lastName = trim($_GET['lastName'] ?? '');

    // Checks the format of anything typed in, using the same rules as process_eoi.php
    if ($jobRef === '' && $firstName === '' && $lastName === '') {
        $error = 'Please enter a job reference, first name or last name to search.';
    } elseif ($jobRef !== '' && !preg_match('/^[A-Za-z0-9]{6}$/', $jobRef)) {
        $error = 'Job reference must be exactly 6 letters or numbers.';
    } elseif (($firstName !== '' && !preg_match('/^[A-Za-z]{1,20}$/', $firstName)) ||
            ($lastName !== '' && !preg_match('/^[A-Za-z]{1,20}$/', $lastName))) {
        $error = 'Names can only contain letters (up to 20).';
    } else {
            // Build the WHERE part from whichever boxes were filled in.
            // $conditions holds the SQL pieces, $params holds the matching values.
            $conditions = [];
            $params = [];
        
            if ($jobRef !== '') {
            $conditions[] = 'jobRef = ?';
            $params[] = $jobRef;
            }
            if ($firstName !== '') {
                $conditions[] = 'firstName = ?';
                $params[] = $firstName;
            }
            if ($lastName !== '') {
                $conditions[] = 'lastName = ?';
                $params[] = $lastName;
            }

            $query = "SELECT * FROM eoi WHERE " . implode(' AND ', $conditions) . " ORDER BY $sort";

            $conn = mysqli_connect($host, $user, $pwd, $sql_db);
            
            // Prepared statement: the query and the values are sent separately, so whatever the manager typed can't change the SQL (prevents SQL injection)
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, str_repeat('s', count($params)), ...$params);

            mysqli_stmt_execute($stmt);
            $results = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
    }
    
$page_title = 'Manage EOIs | HireHub';
$body_class = 'manage-page';
include 'header.inc';
?>
<main>
    <h1>Manage Expressions of Interest</h1>

    <section>
        <h2>List EOIs</h2>
        <!-- 𝗧𝗢𝗗𝗢: Add the form control that lists all EOIs. -->
        <form method="get">
            <label for="sortAll">Sort by</label>
            <select id="sortAll" name="sort">
                <?php foreach ($sortFields as $column => $label): ?>
                    <option value="<?php echo $column; ?>" <?php if ($column === $sort) echo 'selected'; ?>><?php echo $label; ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit" name="action" value="list-all">List all EOIs</button>
        </form>
    </section>

    <section>
        <h2>Filter EOIs</h2>
        <!-- 𝗧𝗢𝗗𝗢: Implement filtering by job reference and applicant first/last name. -->
        <form method="get">
            <label for="jobRef">Job reference</label>
            <input id="jobRef" name="jobRef">

            <label for="firstName">Applicant first name</label>
            <input id="firstName" name="firstName">

            <label for="lastName">Applicant last name</label>
            <input id="lastName" name="lastName">

            <label for="sortFilter">Sort by</label>
            <select id="sortFilter" name="sort">
                <?php foreach ($sortFields as $column => $label): ?>
                    <option value="<?php echo $column; ?>" <?php if ($column === $sort) echo 'selected'; ?>><?php echo $label; ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" name="action" value="filter">Search EOIs</button>
        </form>
    </section>

    <section>
        <h2>Delete EOIs by job reference</h2>
 <!-- 𝗧𝗢𝗗𝗢: Implement deletion securely and request confirmation before deleting. -->
        <form method="post">
            <label for="deleteJobRef">Job reference</label>
            <input id="deleteJobRef" name="jobRef">
            <button type="submit" name="action" value="delete-by-job-ref">Delete matching EOIs</button>
        </form>
    </section>

    <section>
        <h2>Change EOI status</h2>
        <!-- 𝗧𝗢𝗗𝗢: Implement status updates using a prepared statement and validate allowed values. -->
        <form method="post">
            <label for="eoiNumber">EOI number</label>
            <input id="eoiNumber" name="eoiNumber" type="number">
        </form>
    </section>

    <!-- Search error message, e.g. if the search form was left empty -->
    <?php if ($error !== ''): ?>
        <p><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <?php if ($results !== null): ?>
        <section>
            <h2>Results (<?php echo count($results); ?>)</h2>

            <?php if (empty($results)): ?>
                <p>No EOIs found.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>EOI #</th>
                            <th>Job ref</th>
                            <th>First name</th>
                            <th>Last name</th>
                            <th>Date of birth</th>
                            <th>Gender</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Skills</th>
                            <th>Other skills</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($results as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['EOInumber']); ?></td>
                                <td><?php echo htmlspecialchars($row['jobRef']); ?></td>
                                <td><?php echo htmlspecialchars($row['firstName']); ?></td>
                                <td><?php echo htmlspecialchars($row['lastName']); ?></td>
                                <td><?php echo htmlspecialchars($row['dob']); ?></td>
                                <td><?php echo htmlspecialchars($row['gender']); ?></td>
                                <td><?php echo htmlspecialchars($row['streetAddress'] . ', ' . $row['suburb'] . ' ' . $row['state'] . ' ' . $row['postcode']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo htmlspecialchars($row['phoneNum']); ?></td>
                                <td><?php echo htmlspecialchars($row['skills'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($row['otherSkills'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($row['status']); ?></td>
                             </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </section>
    <?php endif; ?>

</main>
<?php include 'footer.inc'; ?>

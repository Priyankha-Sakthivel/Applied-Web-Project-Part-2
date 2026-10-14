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
$results = null; //stays null until the manager asks for a list

// List of all EOIs: runs when the "List all EOIs" button is clicked
if (($_GET['action'] ?? '') === 'list-all') {
    $conn = mysqli_connect($host, $user, $pwd, $sql_db);
    $result = mysqli_query($conn, "SELECT * FROM eoi");
    $results = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
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

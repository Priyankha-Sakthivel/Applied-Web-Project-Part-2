<?php
// 𝗧𝗢𝗗𝗢: Start/validate the manager session; redirect unauthenticated users to login.php.
// 𝗧𝗢𝗗𝗢: Process manager actions with prepared statements and CSRF protection.
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




    
</main>
<?php include 'footer.inc'; ?>

<?php
// TODO: Start the session and process login credentials.
// TODO: Look up the username and verify the password with password_verify().
// TODO: Regenerate the session ID after successful authentication.
$page_title = 'Manager Login | HireHub';
$body_class = 'login-page';
include 'header.inc';
?>
<main>
    <h1>Manager Login</h1>

    <!-- TODO: Display a generic login error without revealing which credential was incorrect. -->
    <form method="post">
        <label for="username">Username</label>
        <input id="username" name="username" autocomplete="username" required>

        <label for="password">Password</label>
        <input id="password" name="password" type="password" autocomplete="current-password" required>

        <!-- TODO: Add CSRF protection. -->
        <button type="submit">Log in</button>
    </form>
</main>
<?php include 'footer.inc'; ?>

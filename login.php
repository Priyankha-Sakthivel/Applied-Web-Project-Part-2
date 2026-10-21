<?php
// Mark: authenticate manager accounts and establish the session used by manage.php.
// Gen Ai was used to assist in writing file, but code was reviewed, modified and tested by us.
session_start();

if (($_SESSION['manager_logged_in'] ?? false) === true) {
    header('Location: manage.php');
    exit;
}

$error = '';
$username = '';

if (empty($_SESSION['login_csrf_token'])) {
    $_SESSION['login_csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submittedUsername = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $submittedToken = $_POST['csrf_token'] ?? '';
    $username = is_string($submittedUsername) ? trim($submittedUsername) : '';

    if (!is_string($password) || !is_string($submittedToken) ||
        !hash_equals($_SESSION['login_csrf_token'], $submittedToken)) {
        $error = 'Your login form has expired. Please try again.';
    } elseif ($username === '' || strlen($username) > 100 || $password === '') {
        $error = 'The username or password is incorrect.';
    } else {
        require_once 'settings.php';

        // Use explicit return-value checks rather than relying on mysqli's
        // version-dependent default error reporting mode.
        mysqli_report(MYSQLI_REPORT_OFF);
        $conn = mysqli_connect($host, $user, $pwd, $sql_db);

        if ($conn === false) {
            error_log('Manager login database connection failed: ' . mysqli_connect_error());
            $error = 'Login is temporarily unavailable. Please try again later.';
        } else {
            $stmt = mysqli_prepare($conn, 'SELECT userID, password_hash FROM users WHERE username = ?');

            if ($stmt === false) {
                error_log('Manager login query preparation failed: ' . mysqli_error($conn));
                $error = 'Login is temporarily unavailable. Please try again later.';
            } else {
                if (!mysqli_stmt_bind_param($stmt, 's', $username)) {
                    error_log('Manager login parameter binding failed: ' . mysqli_stmt_error($stmt));
                    $error = 'Login is temporarily unavailable. Please try again later.';
                } elseif (!mysqli_stmt_execute($stmt)) {
                    error_log('Manager login query failed: ' . mysqli_stmt_error($stmt));
                    $error = 'Login is temporarily unavailable. Please try again later.';
                } else {
                    $result = mysqli_stmt_get_result($stmt);
                    if ($result === false) {
                        error_log('Manager login result retrieval failed: ' . mysqli_stmt_error($stmt));
                        $error = 'Login is temporarily unavailable. Please try again later.';
                    } else {
                        $account = mysqli_fetch_assoc($result);
                        if (is_array($account) && password_verify($password, $account['password_hash'])) {
                            if (session_regenerate_id(true)) {
                                $_SESSION['manager_logged_in'] = true;
                                $_SESSION['manager_user_id'] = (int) $account['userID'];
                                unset($_SESSION['login_csrf_token']);
                                mysqli_stmt_close($stmt);
                                mysqli_close($conn);
                                header('Location: manage.php');
                                exit;
                            }

                            error_log('Manager login failed to regenerate the session ID.');
                            $error = 'Login is temporarily unavailable. Please try again later.';
                        } else {
                            $error = 'The username or password is incorrect.';
                        }
                    }
                }

                mysqli_stmt_close($stmt);
            }

            mysqli_close($conn);
        }
    }
}

$page_title = 'Manager Login | HireHub';
$body_class = 'login-page';
include 'header.inc';
?>
<main>
    <h1>Manager Login</h1>

    <?php if ($error !== ''): ?>
        <p role="alert"><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></p>
    <?php endif; ?>

    <form method="post">
        <label for="username">Username</label>
        <input id="username" name="username" autocomplete="username" value="<?php echo htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>" required>

        <label for="password">Password</label>
        <input id="password" name="password" type="password" autocomplete="current-password" required>

        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['login_csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
        <button type="submit">Log in</button>
    </form>
</main>
<?php include 'footer.inc'; ?>

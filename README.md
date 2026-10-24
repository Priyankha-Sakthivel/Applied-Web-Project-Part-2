# Applied-Web-Project-Part-2
Jira board: [https://studentteam2.atlassian.net/browse/G2]

## Mark — Files created
### login.php
- Checks the manager's username and password against the `users` database table.
- Starts an authenticated session and redirects the manager to `manage.php` after a successful login.
- To run, start Apache and MySQL in XAMPP, import `db/database.sql`, and configure the database connection in `settings.php`.
- Open `http://localhost/<project-folder>/login.php` and enter a manager account's credentials, replacing `<project-folder>` with the project's folder under XAMPP's `htdocs`.

### manage.php
- Requires a manager login and redirects visitors without an authenticated session to `login.php`.
- Lists, filters and sorts EOIs, including applicant details, skills and application status.
- Updates EOI statuses and deletes EOIs by job reference after confirmation.
- To run, log in through `login.php`, then use the forms on `manage.php` with Apache and MySQL running.

### logout.php
- Clears all session data, including the manager's login flag and user ID.
- Removes the session cookie and destroys the session.
- Redirects the manager to `login.php` after logging out.
- To run, click **Log out** on `manage.php` while Apache is running.

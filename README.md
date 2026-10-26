# Applied-Web-Project-Part-2

Jira board: [https://studentteam2.atlassian.net/browse/G2]
GitHub Repository: [https://github.com/Priyankha-Sakthivel/Applied-Web-Project-Part-2]

## How to run
1. Copy this folder into XAMPP's htdocs as `project2`.
2. Start Apache and MySQL in XAMPP.
3. In phpMyAdmin, import `db/project2db.sql` (it creates the database).
4. Open http://localhost/project2/

Marker login for manage.php (via login.php): username `admin`, password `admin`.

Part 2 uses PHP and MySQL, so it can't be hosted on GitHub Pages; run it locally with XAMPP.

## Review fixes (Priyankha, 26 Oct 2026)
Edited during the final review, each marked with a REVIEW FIX comment:
apply.php, process_eoi.php, jobs.php, tips.php, styles/styles.css, db/project2db.sql, README.md.

## GenAI use
| Member | File | Tool | What was asked | What we did |
|---|---|---|---|---|
| Priyankha | apply.php, styles.css, process_eoi.php, jobs.php, tips.php | Claude | Audit the project against the Part 1 feedback and Part 2 rubric, and suggest fixes | Reviewed, applied and tested each change |
| Priyankha | README.md, project2db.sql | Claude | Check contribution text and README for accuracy | Corrected claims, added run steps |
| Teammates | see file header comments | | | Teammates add their own rows |

## Team contributions (Part 2)

### Priyankha Sakthivel
- `header.inc`, `nav.inc`, `footer.inc`: shared header, navigation (highlights the current page) and footer used by every page.
- `settings.php`: database connection settings (no password).
- `db/project2db.sql`: the single exported database file (all tables and seed data).
- `index.php`, `jobs.php`, `apply.php`, `about.php`: converted from Part 1 HTML to PHP using the includes.
- `about.php`: loads group details, member contributions, quotes, group photo and fun facts from the `about_group` and `members` tables.
- `index.php`: "Latest Opportunities" section loaded from the `jobs` table.
- Final review fixes (see "Review fixes" above).
- To check: open `about.php` and `index.php`, and confirm the content matches the database.

### Dimitri Meric
- `manage.php`: HR manager page. Lists all EOIs, filters by job reference / first name / last name / both, sorts by a chosen field, changes an EOI status, and deletes EOIs by job reference after confirmation.
- `tips.php`: Travel Tips page, loaded from the `tips_page`, `travel_tips` and `travel_destinations` tables, with keyword and category search.
- To check: log in through `login.php`, then use each form on `manage.php`. Open `tips.php` and try the search.

### Thomas Mathew
- `eoi` and `jobs` tables in `db/project2db.sql`.
- `process_eoi.php`: receives the application form, validates and sanitises every field on the server, creates the `eoi` table if missing, stores the record and shows the EOI number. Direct visits redirect to `apply.php`.
- `jobs.php`: renders all job details from the `jobs` table and includes the job search bar.
- To check: submit the form on `apply.php`. Search for jobs on `jobs.php`.

### Kevin Tan
- `apply.php`: converted the Part 1 application form to PHP, with the job reference dropdown loaded from the `jobs` table, posting to `process_eoi.php`.
- To check: open `apply.php`, or click "Apply Now" on a job, and confirm the job is preselected.

## Mark — Files created
- `login.php`
  Checks the manager's username and password against the `users` database table.
  Starts an authenticated session and redirects the manager to `manage.php` after a successful login.
  To run, start Apache and MySQL in XAMPP, import `db/project2db.sql`, and configure the database connection in `settings.php`.
  Open `http://localhost/<project-folder>/login.php` and enter a manager account's credentials, replacing `<project-folder>` with the project's folder under XAMPP's `htdocs`.

- `manage.php`
  Requires a manager login and redirects visitors without an authenticated session to `login.php`.
  Lists, filters and sorts EOIs, including applicant details, skills and application status.
  Updates EOI statuses and deletes EOIs by job reference after confirmation.
 To run, log in through `login.php`, then use the forms on `manage.php` with Apache and MySQL running.

- `logout.php`
  Clears all session data, including the manager's login flag and user ID.
 Removes the session cookie and destroys the session.
 Redirects the manager to `login.php` after logging out.
 To run, click **Log out** on `manage.php` while Apache is running.
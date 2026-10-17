-- about.sql - tables for the dynamic About page
SET NAMES utf8mb4;

DROP TABLE IF EXISTS contributions;
DROP TABLE IF EXISTS members;
DROP TABLE IF EXISTS about_group;

CREATE TABLE about_group (
    id INT AUTO_INCREMENT PRIMARY KEY,
    group_name VARCHAR(100) NOT NULL,
    class_day VARCHAR(30) NOT NULL,
    class_time VARCHAR(30) NOT NULL,
    photo_path VARCHAR(255) NOT NULL,
    photo_alt VARCHAR(255) NOT NULL,
    photo_caption VARCHAR(100) NOT NULL
) DEFAULT CHARSET=utf8mb4;

CREATE TABLE members (
    member_id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    part1_work TEXT NOT NULL,
    part2_work TEXT NOT NULL,
    quote TEXT,
    quote_translation TEXT,
    fun_fact VARCHAR(255)
) DEFAULT CHARSET=utf8mb4;

INSERT INTO about_group (group_name, class_day, class_time, photo_path, photo_alt, photo_caption) VALUES
('WebDevs', 'Wednesday', '2:30pm-4:30pm', 'images/group_photo.jpg', 'WebDevs team group photo, photo collage of five members', 'WebDevs Group');

INSERT INTO members (full_name, part1_work, part2_work, quote, quote_translation, fun_fact) VALUES
('Priyankha Sakthivel', 
    'Apply page (job reference, names, date of birth, gender, street address) and corresponding CSS.',
    'Shared PHP includes (header.inc, nav.inc, footer.inc), settings.php, database setup, page conversion to PHP, and the dynamic About page.',
    'Work hard, play hard.', NULL, 'Always has a book on the go.'),
('Dimitri Meric',
    'Home page and corresponding CSS.',
    'manage.php HR functions: list, filter, sort, change status and delete EOIs by job reference.',
    'Arriver en avance est inacceptable, arriver à l''heure revient à être en retard, et arriver à la dernière minute, c''est être à l''heure.',
    'To be early is unacceptable to be on time is to be late and to be last minute is to be on time.',
    'I''m french, you can make fun of me now'),
('Thomas Mathew',
    'Jobs page and corresponding CSS.',
    'eoi and jobs tables, process_eoi.php with server-side validation, and the dynamic jobs page.',
    'If it works, don''t ask too many questions.', NULL, 'Professional last-minute problem solver.'),
('Kevin Tan',
    'Apply page (suburb, state, postcode, email, phone, skills) and corresponding CSS.',
    'Converted apply.php to PHP and made the form fields sticky.',
    '大家好', 'Hello Everyone.', 'My left hand fingers are longer than my right.'),
('Mark Leirum',
    'About page and corresponding CSS.',
    'users table, login page with authentication, and the first version of manage.php.',
    '石の上にも三年 (Ishi no ue ni mo san nen).', 'Perseverance changes things.',
    'Can either be found sleeping or running around, no inbetween.');
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

-- about.sql - tables for the dynamic About page
SET NAMES utf8mb4;

DROP TABLE IF EXISTS contributions;
DROP TABLE IF EXISTS members;
DROP TABLE IF EXISTS about_group;
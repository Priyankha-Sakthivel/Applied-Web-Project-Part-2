CREATE TABLE about_group (
    id INT AUTO_INCREMENT PRIMARY KEY,
    group_name VARCHAR(100) NOT NULL,
    class_day VARCHAR(30) NOT NULL,
    class_time VARCHAR(30) NOT NULL,
    photo_path VARCHAR(255) NOT NULL,
    photo_alt VARCHAR(255) NOT NULL,
    photo_caption VARCHAR(100) NOT NULL
) DEFAULT CHARSET=utf8mb4;


-- about.sql - tables for the dynamic About page
SET NAMES utf8mb4;

DROP TABLE IF EXISTS contributions;
DROP TABLE IF EXISTS members;
DROP TABLE IF EXISTS about_group;
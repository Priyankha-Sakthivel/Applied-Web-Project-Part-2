
CREATE DATABASE IF NOT EXISTS project2db
    DEFAULT CHARACTER SET utf8mb4;

USE project2db;

-- Task 3: Expression of Interest table
-- Group 02: Tourism and Travel

CREATE TABLE IF NOT EXISTS eoi (
    EOInumber INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    jobRef VARCHAR(6) NOT NULL,
    firstName VARCHAR(20) NOT NULL,
    lastName VARCHAR(20) NOT NULL,
    dob DATE NOT NULL,
    gender VARCHAR(20) NOT NULL,
    streetAddress VARCHAR(40) NOT NULL,
    suburb VARCHAR(40) NOT NULL,
    state CHAR(3) NOT NULL,
    postcode CHAR(4) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phoneNum VARCHAR(12) NOT NULL,
    skills TEXT,
    otherSkills TEXT,
    status ENUM('New', 'Current', 'Final') NOT NULL DEFAULT 'New'
);

-- Task 4: Store job descriptions in the database
-- Group 02: Tourism and Travel

CREATE TABLE IF NOT EXISTS jobs (
    jobRef VARCHAR(6) NOT NULL PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    salary VARCHAR(100) NOT NULL,
    reportsTo VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    responsibilities TEXT NOT NULL,
    essentialRequirements TEXT NOT NULL,
    preferableRequirements TEXT NOT NULL
);

-- Task 4: First job listing
INSERT INTO jobs (
    jobRef, title, salary, reportsTo, description,
    responsibilities, essentialRequirements, preferableRequirements
) VALUES (
    'TRV101',
    'Front-End Web Developer',
    '$70,000 - $80,000 per year',
    'Web Development Manager',
    'We are looking for a Front-End Web Developer to help create user-friendly and responsive websites for our tourism and travel platform.',
    'Develop and maintain website pages.
Improve website usability and design.
Work with other members of the development team.',
    'Basic knowledge of HTML and CSS.
Good communication skills.
Ability to work effectively in a team.',
    'Knowledge of responsive web design.
Interest in tourism and travel technology.'
);

-- Task 4: Second job listing
INSERT INTO jobs (
    jobRef, title, salary, reportsTo, description,
    responsibilities, essentialRequirements, preferableRequirements
) VALUES (
    'TRV202',
    'Travel Systems Support Analyst',
    '$65,000 - $75,000 per year',
    'IT Support Manager',
    'We are looking for a Travel Systems Support Analyst to provide technical support for our online travel booking systems and services.',
    'Provide technical support to users and staff.
Identify and resolve issues with travel booking systems.
Maintain records of technical problems and solutions.',
    'Good problem-solving skills.
Basic knowledge of computer systems and networks.
Good written and verbal communication skills.',
    'Experience in customer or technical support.
Interest in travel technology systems.'
);

-- Task 4: Third job listing
INSERT INTO jobs (
    jobRef, title, salary, reportsTo, description,
    responsibilities, essentialRequirements, preferableRequirements
) VALUES (
    'TRV303',
    'Digital Travel Content Coordinator',
    '$60,000 - $70,000 per year',
    'Marketing Manager',
    'We are looking for a Digital Travel Content Coordinator to create and maintain engaging content for our tourism and travel platform.',
    'Create and update travel-related website content.
Maintain accurate destination and service information.
Work with the marketing team to support online campaigns.',
    'Good written communication skills.
Strong attention to detail.
Ability to work effectively in a team.',
    'Experience creating digital content.
Interest in tourism, travel and online media.'
);

-- Task 4: Manager accounts for login.php
-- Group 02: Tourism and Travel

CREATE TABLE IF NOT EXISTS users (
    userID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
);

-- Insert or update the test manager account
-- Password: admin (stored as a PHP password_hash)
INSERT INTO users (username, password_hash)
VALUES (
    'admin',
    '$2y$10$3DqUsl.V7XY2SIEUaKDL5uZMZzGb7tEE1wPNMiupF0r0UWc.U43G6'
)
ON DUPLICATE KEY UPDATE password_hash = VALUES(password_hash);

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
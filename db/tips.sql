-- tips.sql - tables for the dynamic Travel Tips page (tips.php)
-- Run after database.sql. Re-running drops and recreates the Travel Tips tables.
CREATE DATABASE IF NOT EXISTS project2db
    DEFAULT CHARSET=utf8mb4;

USE project2db;

SET NAMES utf8mb4;

DROP TABLE IF EXISTS tips_page;
DROP TABLE IF EXISTS travel_tips;
DROP TABLE IF EXISTS travel_destinations;

-- Headings and text for each section of the page, looked up by section_key
CREATE TABLE tips_page (
    section_key VARCHAR(30) NOT NULL PRIMARY KEY,
    heading VARCHAR(100) NOT NULL,
    body TEXT NOT NULL
) DEFAULT CHARSET=utf8mb4;

-- One row per tip card. link_url can be an internal page (jobs.php)
-- or an external website (https://...), or NULL for no link.
CREATE TABLE travel_tips (
    tip_id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(30) NOT NULL,
    title VARCHAR(100) NOT NULL,
    content TEXT NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    image_alt VARCHAR(255) NOT NULL,
    link_text VARCHAR(100) DEFAULT NULL,
    link_url VARCHAR(255) DEFAULT NULL,
    sort_order INT NOT NULL DEFAULT 0
) DEFAULT CHARSET=utf8mb4;

-- One row per destination in the quick-guide table
CREATE TABLE travel_destinations (
    destination_id INT AUTO_INCREMENT PRIMARY KEY,
    destination VARCHAR(60) NOT NULL,
    best_time VARCHAR(80) NOT NULL,
    weather VARCHAR(120) NOT NULL,
    currency VARCHAR(60) NOT NULL,
    quick_tip VARCHAR(255) NOT NULL
) DEFAULT CHARSET=utf8mb4;

INSERT INTO tips_page (section_key, heading, body) VALUES
('intro', 'Travel Tips',
 'Whether you are travelling for a holiday or heading off to start a job in tourism, a little preparation goes a long way. Our team of travel and technology specialists has put together the advice we wish we had on our first trips.'),
('search', 'Find a tip',
 'Search by keyword, choose a category, or both.'),
('tips', 'Our top tips',
 'Practical advice for planning, packing, spending, staying safe and building a career in travel.'),
('destinations', 'Destination quick guide',
 'When to go and what to know for some of the most popular destinations with Australian travellers.');

INSERT INTO travel_tips (category, title, content, image_path, image_alt, link_text, link_url, sort_order) VALUES
('Planning', 'Check entry requirements early',
 'Many countries require your passport to be valid for at least six months after you arrive, and some need a visa arranged before you leave. If you plan to work overseas, check whether you need a work visa rather than a tourist visa.',
 'images/tip_passport.png', 'Illustration of a passport with a globe on the cover',
 'Check advice on Smartraveller', 'https://www.smartraveller.gov.au/', 1),
('Packing', 'Pack light and pack smart',
 'Roll your clothes to save space and use packing cubes to stay organised. Keep medication, chargers, travel documents and a change of clothes in your carry-on in case your checked bag is delayed.',
 'images/tip_suitcase.png', 'Illustration of a packed suitcase with luggage straps',
 NULL, NULL, 2),
('Money', 'Sort out your money before you go',
 'Let your bank know your travel dates and consider a card with no foreign transaction fees. When a card machine asks, choose to pay in the local currency rather than Australian dollars to avoid a poor exchange rate.',
 'images/tip_money.png', 'Illustration of a banknote and coins',
 NULL, NULL, 3),
('Health & Safety', 'Get travel insurance and see a doctor',
 'Buy travel insurance as soon as you book, so you are covered if plans change. Visit your doctor or a travel clinic six to eight weeks before you leave to ask about vaccinations.',
 'images/tip_health.png', 'Illustration of a first aid kit',
 'Read Smartraveller vaccination advice', 'https://www.smartraveller.gov.au/before-you-go/health/vaccinations', 4),
('Culture', 'Learn the basics of local customs',
 'A few words of the local language, such as hello, please and thank you, are always appreciated. Knowing local customs is also a big plus if you work with international guests in tourism.',
 'images/tip_culture.png', 'Illustration of speech bubbles saying hello in several languages',
 NULL, NULL, 5),
('Careers', 'Turn your love of travel into a career',
 'The travel industry needs developers, support analysts and content creators as much as it needs tour guides. If you enjoy technology and travel, a role with HireHub could be a great fit.',
 'images/tip_career.png', 'Illustration of a map pin above a laptop',
 'Browse our current jobs', 'jobs.php', 6);

INSERT INTO travel_destinations (destination, best_time, weather, currency, quick_tip) VALUES
('Japan', 'March to May, September to November', 'Mild in spring and autumn, hot and humid in summer', 'Japanese yen (JPY)', 'Carry some cash, as smaller shops and restaurants may not take cards.'),
('Bali, Indonesia', 'April to October', 'Dry season, warm all year round', 'Indonesian rupiah (IDR)', 'Cover your shoulders and knees when visiting temples.'),
('New Zealand', 'December to February', 'Warm summers, but weather can change quickly', 'New Zealand dollar (NZD)', 'Pack layers and a rain jacket, even in summer.'),
('Italy', 'April to June, September to October', 'Warm and dry, very hot in mid-summer', 'Euro (EUR)', 'Book popular museums and galleries ahead in peak season.'),
('Thailand', 'November to February', 'Cooler and drier than the rest of the year', 'Thai baht (THB)', 'Take your shoes off before entering homes and temples.');

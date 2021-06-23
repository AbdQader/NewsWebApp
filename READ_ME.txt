
// *** this is sql code *** //

// create news_db database

CREATE DATABASE news_db;

/////////////////////////

// create news table in the database

CREATE TABLE news (

    news_id INT PRIMARY KEY AUTO_INCREMENT,
    news_title VARCHAR(50),
    news_content TEXT,
    news_author VARCHAR(50),
    news_date DATE DEFAULT CURRENT_TIMESTAMP

);

/////////////////////////

// create users table in the database

CREATE TABLE users (

    user_id INT PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(50),
    user_email VARCHAR(50),
    user_password VARCHAR(50),

);
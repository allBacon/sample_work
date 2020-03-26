-- Created by Dan Benson
-- Last modification date: 2016-05-18 10:00:13

-- tables
-- Table: Comments
CREATE TABLE Comments (
    id int NOT NULL AUTO_INCREMENT,
    comment varchar(500) NOT NULL,
    created_time timestamp NOT NULL,
    author varchar(40) NOT NULL,
    email varchar(40) NOT NULL,
    review_id int NOT NULL,
    user_id int NOT NULL,
    CONSTRAINT Comments_pk PRIMARY KEY (id)
);

-- Table: Make
CREATE TABLE Make (
    mf_id int NOT NULL AUTO_INCREMENT,
    manufacturer char(50) NOT NULL,
    CONSTRAINT Make_pk PRIMARY KEY (mf_id)
);

-- Table: Model
CREATE TABLE Model (
    model_id int NOT NULL AUTO_INCREMENT,
    model char(50) NOT NULL,
    make_id int NOT NULL,
    CONSTRAINT Model_pk PRIMARY KEY (model_id)
);

-- Table: Reviews
CREATE TABLE Reviews (
    id int NOT NULL AUTO_INCREMENT,
    title varchar(100) NOT NULL,
    youtube_embed_link varchar(200) NOT NULL,
    image_links varchar(200) NOT NULL,
    review_content varchar(2000) NOT NULL,
    published_time timestamp NOT NULL,
    updated_time timestamp NOT NULL,
    user_id int NOT NULL,
    CONSTRAINT review_id PRIMARY KEY (id)
);

-- Table: Tags
CREATE TABLE Tags (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    freq int NOT NULL,
    CONSTRAINT Tags_pk PRIMARY KEY (id)
);

-- Table: UserCredentials
CREATE TABLE UserCredentials (
    id int NOT NULL AUTO_INCREMENT,
    user_id int NOT NULL,
    password varchar(40) NOT NULL,
    administrator boolean NOT NULL,
    passwordSalt varchar(8) NOT NULL,
    CONSTRAINT user_id PRIMARY KEY (id)
);

-- Table: Users
CREATE TABLE Users (
    user_id INT NOT NULL AUTO_INCREMENT,
    username varchar(25) NOT NULL,
    first_name varchar(30) NOT NULL,
    last_name varchar(30) NOT NULL,
    email varchar(50) NOT NULL,
    profile varchar(100) NOT NULL,
    avatar varchar(100) NOT NULL,
    date_created timestamp NOT NULL,
    CONSTRAINT user_id PRIMARY KEY (user_id)
);

-- foreign keys
-- Reference: Make_Model (table: Model)
ALTER TABLE Model ADD CONSTRAINT Make_Model FOREIGN KEY Make_Model (make_id)
    REFERENCES Make (mf_id);

-- Reference: Reviews_Comments (table: Comments)
ALTER TABLE Comments ADD CONSTRAINT Reviews_Comments FOREIGN KEY Reviews_Comments (review_id)
    REFERENCES Reviews (id);

-- Reference: Reviews_Users (table: Reviews)
ALTER TABLE Reviews ADD CONSTRAINT Reviews_Users FOREIGN KEY Reviews_Users (user_id)
    REFERENCES Users (user_id);

-- Reference: Users_Comments (table: Comments)
ALTER TABLE Comments ADD CONSTRAINT Users_Comments FOREIGN KEY Users_Comments (user_id)
    REFERENCES Users (user_id);

-- Reference: Users_UserCredentials (table: UserCredentials)
ALTER TABLE UserCredentials ADD CONSTRAINT Users_UserCredentials FOREIGN KEY Users_UserCredentials (user_id)
    REFERENCES Users (user_id);

-- End of file.


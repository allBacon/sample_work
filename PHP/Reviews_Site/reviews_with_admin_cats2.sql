-- Created by Vertabelo (http://vertabelo.com)
-- Last modification date: 2016-06-01 18:13:55.59

-- tables
-- Table: Tags
CREATE TABLE Tags (
    id int NOT NULL AUTO_INCREMENT,
    name varchar(50) NOT NULL,
    freq int NOT NULL,
    CONSTRAINT Tags_pk PRIMARY KEY (id)
);

-- Table: cat
CREATE TABLE cat (
    id int NOT NULL AUTO_INCREMENT,
    type varchar(200) NOT NULL,
    description text NOT NULL,
    CONSTRAINT cat_pk PRIMARY KEY (id)
);

-- Table: comment
CREATE TABLE comment (
    id int NOT NULL AUTO_INCREMENT,
    comment varchar(5000) NOT NULL,
    created_time timestamp NOT NULL,
    user_id int NOT NULL,
    review_id int NOT NULL,
    CONSTRAINT comment_pk PRIMARY KEY (id)
);

-- Table: make
CREATE TABLE make (
    id int NOT NULL AUTO_INCREMENT,
    manufacturer char(50) NOT NULL,
    CONSTRAINT make_pk PRIMARY KEY (id)
);

-- Table: model
CREATE TABLE model (
    id int NOT NULL AUTO_INCREMENT,
    model_name char(100) NOT NULL,
    year int NOT NULL,
    make_id int NOT NULL,
    cat_id int NOT NULL,
    CONSTRAINT model_pk PRIMARY KEY (id)
);

-- Table: review
CREATE TABLE review (
    review_id int NOT NULL AUTO_INCREMENT,
    title varchar(200) NOT NULL,
    youtube_embed_link varchar(200) NOT NULL,
    image_links varchar(200) NOT NULL,
    review_meta varchar(1000) NOT NULL,
    review_content varchar(8000) NOT NULL,
    published_time timestamp NOT NULL,
    updated_time timestamp NOT NULL,
    model_id int NOT NULL,
    user_id int NOT NULL,
    cat_id int NOT NULL,
    active_post bool NOT NULL,
    CONSTRAINT review_id PRIMARY KEY (review_id)
);

-- Table: user
CREATE TABLE `user` (
    id INT NOT NULL AUTO_INCREMENT,
    username varchar(25) NOT NULL,
    first_name varchar(30) NOT NULL,
    last_name varchar(30) NOT NULL,
    email varchar(50) NOT NULL,
    profile varchar(100) NOT NULL,
    avatar varchar(100) NOT NULL,
    date_created timestamp NOT NULL,
    active_user bool NOT NULL,
    CONSTRAINT user_id PRIMARY KEY (id)
);

-- Table: userCredentials
CREATE TABLE userCredentials (
    id int NOT NULL AUTO_INCREMENT,
    user_id int NOT NULL,
    password varchar(40) NOT NULL,
    administrator boolean NOT NULL,
    passwordSalt varchar(8) NOT NULL,
    CONSTRAINT user_id PRIMARY KEY (id)
);

-- foreign keys
-- Reference: Comments_Reviews (table: comment)
ALTER TABLE comment ADD CONSTRAINT Comments_Reviews FOREIGN KEY Comments_Reviews (review_id)
    REFERENCES review (review_id);

-- Reference: Comments_Users (table: comment)
ALTER TABLE comment ADD CONSTRAINT Comments_Users FOREIGN KEY Comments_Users (user_id)
    REFERENCES `user` (id);

-- Reference: Model_Categories (table: model)
ALTER TABLE model ADD CONSTRAINT Model_Categories FOREIGN KEY Model_Categories (cat_id)
    REFERENCES cat (id);

-- Reference: Model_Make (table: model)
ALTER TABLE model ADD CONSTRAINT Model_Make FOREIGN KEY Model_Make (make_id)
    REFERENCES make (id);

-- Reference: Reviews_Model (table: review)
ALTER TABLE review ADD CONSTRAINT Reviews_Model FOREIGN KEY Reviews_Model (model_id)
    REFERENCES model (id);

-- Reference: Reviews_Users (table: review)
ALTER TABLE review ADD CONSTRAINT Reviews_Users FOREIGN KEY Reviews_Users (user_id)
    REFERENCES `user` (id);

-- Reference: Users_UserCredentials (table: userCredentials)
ALTER TABLE userCredentials ADD CONSTRAINT Users_UserCredentials FOREIGN KEY Users_UserCredentials (user_id)
    REFERENCES `user` (id);

-- Reference: review_cat (table: review)
ALTER TABLE review ADD CONSTRAINT review_cat FOREIGN KEY review_cat (cat_id)
    REFERENCES cat (id);

-- End of file.

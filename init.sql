CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    password VARCHAR(255),
    nickname VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    create_date DATETIME,
    update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    user_id VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
);

CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    body TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    create_date DATETIME,
    update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    delete_flag BOOLEAN DEFAULT NULL
);

CREATE TABLE answers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_id INT,
    user_id VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    body TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    create_date DATETIME,
    update_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    delete_flag BOOLEAN DEFAULT NULL
);




INSERT INTO users (username, password, nickname, create_date, update_date, user_id)
VALUES ('akiko', SHA1('wadaakiko'), 'あきこ', NOW(), NOW(), 'akiko');

INSERT INTO questions (user_id, body, create_date, update_date, delete_flag)
VALUES ('akiko', '初めての質問です', NOW(), NOW(), NULL);


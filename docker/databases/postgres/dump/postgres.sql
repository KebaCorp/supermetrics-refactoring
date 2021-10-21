CREATE TABLE IF NOT EXISTS users
(
    id
    SERIAL
    NOT
    NULL,
    email
    VARCHAR
(
    255
) NOT NULL, PRIMARY KEY
(
    id
));

CREATE
UNIQUE INDEX users_email ON users (email);

INSERT INTO users (email)
VALUES ('test1@gmail.com'),
       ('test2@gmail.com'),
       ('test3@gmail.com'),
       ('test4@gmail.com'),
       ('test5@gmail.com');

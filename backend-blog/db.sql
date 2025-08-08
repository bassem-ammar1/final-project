CREATE DATABASE blog;
USE blog;

/*DROP TABLE comments;
DROP TABLE posts;
DROP TABLE users;*/

CREATE TABLE users(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    email VARCHAR(255)    
);

CREATE TABLE posts(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    content VARCHAR(255),
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE comments(
    id INT AUTO_INCREMENT PRIMARY KEY,
    content VARCHAR(255),
    post_id INT,
    user_id INT,
    FOREIGN KEY (post_id) REFERENCES posts(id),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

/*INSERT INTO users (name, email) VALUES
('Alice', ' alice@example.com'),
('Bob', ' bob@example.com'),
('Charlie', ' charlie@example.com');

INSERT INTO posts (title, content, user_id) VALUES
('First Post', 'This is the content of the first post.', 1),
('Second Post', 'This is the content of the second post.', 2),
('Third Post', 'This is the content of the third post.', 3);

INSERT INTO comments (content, post_id, user_id) VALUES
('Great post!', 1, 2),
('Thanks for sharing!', 1, 3),
('Interesting read.', 2, 1),
('I learned a lot.', 3, 2);*/

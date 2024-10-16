-- 1. Crear la base de datos
drop database twitter_clone;
CREATE DATABASE twitter_clone CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE twitter_clone;

-- 2. Tabla users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    description TEXT,
    createDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- 3. Tabla follows
CREATE TABLE follows (
    users_id INT NOT NULL,
    userToFollow INT NOT NULL,
    follow_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (users_id, userToFollow),
    FOREIGN KEY (users_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (userToFollow) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 4. Tabla publications
CREATE TABLE publications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    userId INT NOT NULL,
    text TEXT NOT NULL,
    createDate DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 5. Tabla likes
CREATE TABLE likes (
    publication_id INT NOT NULL,
    userId INT NOT NULL,
    like_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (publication_id, userId),
    FOREIGN KEY (publication_id) REFERENCES publications(id) ON DELETE CASCADE,
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- 6. Tabla comentarios
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    publication_id INT NOT NULL,
    userId INT NOT NULL,
    text TEXT NOT NULL,
    comment_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (publication_id) REFERENCES publications(id) ON DELETE CASCADE,
    FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

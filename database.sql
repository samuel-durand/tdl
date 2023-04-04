CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255),
  password VARCHAR(255)
);

CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  title VARCHAR(255),
  description TEXT,
  deadline DATETIME,
  completed BOOLEAN,
  modified_at DATETIME,
  FOREIGN KEY (user_id) REFERENCES users(id)
);

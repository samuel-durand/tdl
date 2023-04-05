
ALTER TABLE tasks ADD COLUMN user_id INT NOT NULL;
ALTER TABLE tasks ADD CONSTRAINT fk_tasks_users FOREIGN KEY (user_id) REFERENCES users(id);


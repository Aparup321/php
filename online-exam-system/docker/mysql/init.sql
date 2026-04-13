CREATE DATABASE IF NOT EXISTS online_exam;
USE online_exam;

CREATE TABLE IF NOT EXISTS students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS exams (
  exam_id INT AUTO_INCREMENT PRIMARY KEY,
  exam_name VARCHAR(150) NOT NULL,
  exam_date DATETIME NOT NULL
);

CREATE TABLE IF NOT EXISTS questions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  exam_id INT NOT NULL,
  question TEXT NOT NULL,
  option1 VARCHAR(255) NOT NULL,
  option2 VARCHAR(255) NOT NULL,
  option3 VARCHAR(255) NOT NULL,
  option4 VARCHAR(255) NOT NULL,
  correct_option TINYINT NOT NULL,
  FOREIGN KEY (exam_id) REFERENCES exams(exam_id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS results (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_id INT NOT NULL,
  exam_id INT NOT NULL,
  score INT NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
  FOREIGN KEY (exam_id) REFERENCES exams(exam_id) ON DELETE CASCADE
);

INSERT INTO admin (username, password) VALUES
  ("admin", "admin123")
  ("aparup","12345");

INSERT INTO exams (exam_name, exam_date) VALUES
  ("Sample Exam", NOW());

INSERT INTO questions (exam_id, question, option1, option2, option3, option4, correct_option) VALUES
  (1, "Which data structure uses FIFO order?", "Stack", "Queue", "Tree", "Graph", 2),
  (1, "Which language is primarily used for styling web pages?", "HTML", "CSS", "PHP", "SQL", 2),
  (1, "What does SQL stand for?", "Structured Query Language", "Simple Query Language", "Sequential Query Logic", "Standard Question Language", 1),
  (1, "Which algorithm is commonly used for shortest path in weighted graphs with non-negative edges?", "DFS", "BFS", "Dijkstra", "Prim", 3),
  (1, "What does HTTP stand for?", "HyperText Transfer Protocol", "High Transfer Text Protocol", "Hyperlink Transfer Program", "Host Transfer Packet", 1)
  (1, "Who is our pm? ","Modi","Jai sah","Didi","Balen",1);

CREATE TABLE IF NOT EXISTS todos (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  text VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
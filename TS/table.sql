CREATE TABLE Toys (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT,
  code INT,
  name VARCHAR(250),
  quantity INT,
  description TEXT,
  image VARCHAR(250),
  date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB
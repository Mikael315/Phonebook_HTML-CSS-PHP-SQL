CREATE TABLE user (
  id int(255) NOT NULL AUTO_INCREMENT,
  firstName varchar(50) NOT NULL,
  lastName varchar(50) NOT NULL,
  gender varchar(50) NOT NULL,
  age varchar(255) NOT NULL,
  address varchar(255) NOT NULL,
  phoneNumber varchar(50) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE users (
  id int unsigned not null auto_increment,
  email varchar(250) not null UNIQUE,
  password varchar(250) not null,
  created_at timestamp DEFAULT CURRENT_TIMESTAMP,
  updated_at timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY(id)
) ENGINE=InnoDB;
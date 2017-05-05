CREATE TABLE simples (
  id int unsigned not null auto_increment,
  name varchar(250) not null,
  created_at timestamp,
  updated_at timestamp,
  PRIMARY KEY(id)
) ENGINE=InnoDB;
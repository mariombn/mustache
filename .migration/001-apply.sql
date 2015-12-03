CREATE DATABASE mustache;

use mustache

CREATE TABLE usuarios (
  usua_id        INT NOT NULL AUTO_INCREMENT,
  usua_login     VARCHAR(30) NOT NULL,
  usua_email     VARCHAR(200) NOT NULL,
  usua_nome      VARCHAR(50) NOT NULL,
  usua_sobrenome VARCHAR(250),
  usua_data_cad  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  usua_data_upd  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  usua_status    CHAR(1) NOT NULL DEFAULT '0',
  PRIMARY KEY(usua_id),
  UNIQUE (usua_login, usua_email)
) ENGINE=INNDB
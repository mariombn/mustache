CREATE DATABASE blackinght;

use blackinght

CREATE TABLE usuarios (
  usua_id            INT NOT NULL AUTO_INCREMENT,
  usua_login         VARCHAR(30) NOT NULL,
  usua_email         VARCHAR(200) NOT NULL,
  usua_password      VARCHAR(250) NOT NULL,
  usua_nome          VARCHAR(50) NOT NULL,
  usua_sobrenome     VARCHAR(250),
  usua_data_cad      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  usua_data_upd      DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  usua_ultimo_acesso DATETIME,
  usua_hash          VARCHAR(250),
  usua_status        CHAR(1) NOT NULL DEFAULT '0' COMMENT '0 = Criado | 1 = Ativado | 2 = Excluido',
  PRIMARY KEY(usua_id),
  UNIQUE (usua_login, usua_email),
  KEY (usua_login, usua_email, usua_nome, usua_status)
) ENGINE=InnoDB ;

INSERT INTO usuarios (usua_login, usua_email, usua_nome, usua_password)
VALUES ('admin', 'admin@admin.com', 'Administrator', '21232f297a57a5a743894a0e4a801fc3');
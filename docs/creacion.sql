CREATE TABLE IF NOT EXISTS docente (
  CodDocente INT not null AUTO_INCREMENT PRIMARY KEY,
  Apellido VARCHAR(30) NOT NULL,
  Nombre VARCHAR(30) NOT NULL,
  Activo char(1) default 'S'
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS grupo (
  CodGrupo INT not null AUTO_INCREMENT PRIMARY KEY,
  Nombre VARCHAR(70) NOT NULL,
  Activo char(1) default 'S'
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;


CREATE TABLE IF NOT EXISTS alumno (
  CodAlumno INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  Paterno VARCHAR(20) NOT NULL,
  Materno VARCHAR(20) NOT NULL,  
  Nombres VARCHAR(25) NOT NULL,
  CI VARCHAR(10),
  RU VARCHAR(10),
  Activo char(1) default 'S' 
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

CREATE TABLE IF NOT EXISTS grupo_alumno (
  CodGrupo INT,
  CodAlumno INT,
  PRIMARY KEY(CodGrupo, CodAlumno),
  CONSTRAINT fk_grupo_alumno_1 FOREIGN KEY (CodGrupo) REFERENCES grupo(CodGrupo) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT fk_grupo_alumno_2 FOREIGN KEY (CodAlumno) REFERENCES alumno(CodAlumno) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

# configuracion de actividad evaluativa
CREATE TABLE IF NOT EXISTS actividad (
  CodActividad INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  CodGrupo int not null,
  Nombre varchar(20),
  MaxNota tinyInt,
  Activo char(1) default 'S',
  INDEX fk_actividad_idx (CodGrupo),
  CONSTRAINT fk_actividad_1 FOREIGN KEY (CodGrupo) REFERENCES grupo(CodGrupo) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;


CREATE TABLE IF NOT EXISTS nota (
  CodActividad INT,
  CodAlumno INT,
  Nota tinyInt default 0,
  PRIMARY KEY(CodActividad, CodAlumno)
) ENGINE=InnoDB DEFAULT CHARACTER SET=utf8;

create table parametro(
  Codigo varchar(20) NOT NULL PRIMARY KEY,
  Numero int DEFAULT -1,
  Cadena varchar(100) DEFAULT '',
  CodDocente int not null,
  INDEX fk_parametro_idx (CodDocente),
  CONSTRAINT fk_parametro_1 FOREIGN KEY (CodDocente) REFERENCES docente(CodDocente) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB DEFAULT CHARACTER SET = utf8;


CREATE TABLE ci_sessions (
  id varchar(40) NOT NULL,
  ip_address varchar(45) NOT NULL,
  timestamp int(10) unsigned NOT NULL DEFAULT '0',
  data blob NOT NULL,
  PRIMARY KEY (id),
  KEY ci_sessions_timestamp (timestamp)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE groups (
  id mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(20) NOT NULL,
  description varchar(100) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

insert  into groups(id,name,description) values (1,'admin','Administrador'),(2,'docente','Docente');


CREATE TABLE login_attempts (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  ip_address varbinary(16) NOT NULL,
  login varchar(100) NOT NULL,
  time int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE users (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  ip_address varbinary(16) NOT NULL,
  username varchar(100) NOT NULL,
  password varchar(80) NOT NULL,
  salt varchar(40) DEFAULT NULL,
  email varchar(100) NOT NULL,
  activation_code varchar(40) DEFAULT NULL,
  forgotten_password_code varchar(40) DEFAULT NULL,
  forgotten_password_time int(11) unsigned DEFAULT NULL,
  remember_code varchar(40) DEFAULT NULL,
  created_on int(11) unsigned NOT NULL,
  last_login int(11) unsigned DEFAULT NULL,
  active tinyint(1) unsigned DEFAULT NULL,
  first_name varchar(50) DEFAULT NULL,
  last_name varchar(50) DEFAULT NULL,
  company varchar(100) DEFAULT NULL,
  phone varchar(20) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;


CREATE TABLE users_groups (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  user_id int(11) unsigned NOT NULL,
  group_id mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY uc_users_groups (user_id,group_id),
  KEY fk_users_groups_users1_idx (user_id),
  KEY fk_users_groups_groups1_idx (group_id),
  CONSTRAINT fk_users_groups_groups1 FOREIGN KEY (group_id) REFERENCES groups (id) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT fk_users_groups_users1 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;


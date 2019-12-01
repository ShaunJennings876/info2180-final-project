CREATE DATABASE BugMeDB;

CREATE TABLE Users(
  id int NOT NULL AUTO_INCREMENT,
  firstname varchar(20),
  lastname varchar (20),
  password varchar(255),
  email varchar(20),
  date_joined date,
  PRIMARY KEY (id)
);

CREATE TABLE Issues (
  id int AUTO_INCREMENT,
  title varchar(20),
  description varchar(255),
  type varchar(20),
  priority varchar(10),
  status varchar(20),
  assigned_to int,
  created_by int,
  created boolean,
  updated boolean,
  PRIMARY KEY (id)
);

INSERT INTO Users(firstname,lastname,email,password) VALUES('admin','admin','admin@bugme.com',MD5('password123'));
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER ON MPMgmtDB.* TO ''@'localhost' IDENTIFIED BY '';

CREATE DATABASE Pilar;
SHOW DATABASES;
USE Pilar;

CREATE TABLE EscuelaProfesional(
  id INT AUTO_INCREMENT PRIMARY KEY,
	Nombres VARCHAR(15) NOT NULL
);

CREATE TABLE Jurados(
  id INT AUTO_INCREMENT PRIMARY KEY,
	Nombres VARCHAR(15) NOT NULL,
	ApellidoPaterno VARCHAR(25) NOT NULL,
	Apellidomaterno VARCHAR(25) NOT NULL,
	Celular CHAR(9) NOT NULL,
	Dni CHAR(8) NOT NULL,
	Email VARCHAR(25) NOT NULL,
	Contraseña VARCHAR(25) NOT NULL,
	Realizado TINYINT NOT NULL,
	EscuelaProfesional_Id INT NOT NULL,
	FOREIGN KEY (EscuelaProfesional_Id) REFERENCES EscuelaProfesional(id)
);

CREATE TABLE NotificacionJurado(
  id INT AUTO_INCREMENT PRIMARY KEY,
	Descripcion VARCHAR(45) NOT NULL,
	Fecha DATE NOT NULL,
	hora TIME NOT NULL,
	Jurado_Id INT NOT NULL,
	FOREIGN KEY (Jurado_Id) REFERENCES Jurados(id)
);

CREATE TABLE RecordatorioJurado(
  id INT AUTO_INCREMENT PRIMARY KEY,
	Fecha DATE NOT NULL,
	Hora TIME NOT NULL,
	Descripcion VARCHAR(50) NOT NULL,
	Jurado_Id INT NOT NULL,
	FOREIGN KEY (Jurado_Id) REFERENCES Jurados(id)
);

CREATE TABLE Tesista(
  id INT AUTO_INCREMENT PRIMARY KEY,
	Nombres VARCHAR(15) NOT NULL,
	ApellidoPaterno VARCHAR(25) NOT NULL,
	Apellidomaterno VARCHAR(25) NOT NULL,
	Celular CHAR(9) CHARACTER SET 'utf8' NOT NULL,
	Codigo CHAR(6) NOT NULL,
	Dni CHAR(8) NOT NULL,
	Email VARCHAR(25) NOT NULL,
	Contraseña VARCHAR(25) NOT NULL,
	EscuelaProfesional_Id INT NOT NULL,
	FOREIGN KEY (EscuelaProfesional_Id) REFERENCES EscuelaProfesional(id),
	Jurado_1 INT NOT NULL,
	FOREIGN KEY (Jurado_1) REFERENCES Jurados(id),
	Jurado_2 INT NOT NULL,
	FOREIGN KEY (Jurado_2) REFERENCES Jurados(id),
	Jurado_3 INT NOT NULL,
	FOREIGN KEY (Jurado_3) REFERENCES Jurados(id)
);

CREATE TABLE NotificacionTesista(
  id INT AUTO_INCREMENT PRIMARY KEY,
	Descripcion VARCHAR(45) NOT NULL,
	contenido TEXT(250) NOT NULL,
	Fecha DATE NOT NULL,
	hora TIME NOT NULL,
	Tesista_Id INT NOT NULL,
	FOREIGN KEY (Tesista_Id) REFERENCES Tesista(id)
);

CREATE TABLE RecordatorioTesista(
  id INT AUTO_INCREMENT PRIMARY KEY,
	Fecha DATE NOT NULL,
	Hora TIME NOT NULL,
	Descripcion VARCHAR(50) NOT NULL,
	Tesista_Id INT NOT NULL,
	FOREIGN KEY (Tesista_Id) REFERENCES Tesista(id)
);

CREATE TABLE ProyectoTesis(
  id INT AUTO_INCREMENT PRIMARY KEY,
	Documento BLOB NOT NULL,
	Tesista_Id INT NOT NULL,
	FOREIGN KEY (Tesista_Id) REFERENCES Tesista(id)
);
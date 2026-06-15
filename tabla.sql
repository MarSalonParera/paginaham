CREATE TABLE contactos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    email VARCHAR(100),
    telefono VARCHAR(20),
    comentario TEXT,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE solicitudes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    apellidos VARCHAR(100),
    empresa VARCHAR(100),
    cif VARCHAR(50),
    telefono VARCHAR(20),
    email VARCHAR(100),
    direccion VARCHAR(255),
    ciudad VARCHAR(100),
    codigo_postal VARCHAR(20),
    provincia VARCHAR(100),
    iae VARCHAR(255),
    certificado VARCHAR(255),
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO contactos(nombre,email,telefono,comentario)
VALUES('$nombre','$email','$telefono','$comentario');

INSERT INTO solicitudes(nombre,apellidos,empresa,email,telefono,iae,certificado)
VALUES('$nombre','$apellidos','$empresa','$email','$telefono','$iae','$certificado');


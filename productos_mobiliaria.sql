CREATE TABLE mobiliaria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    precio DECIMAL(8,2),
    categoria VARCHAR(50),
    descripcion TEXT,
    imagen VARCHAR(255)
);

INSERT INTO mobiliaria (nombre, precio, categoria, descripcion, imagen) VALUES
('Escritorio', 149.99, 'Mobiliaria', 'Escritorio de madera', 'imagenes/escritorio.jpg');    
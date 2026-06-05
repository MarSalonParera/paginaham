CREATE TABLE mobiliaria (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    precio DECIMAL(8,2),
    categoria VARCHAR(50),
    marca VARCHAR(50),
    descripcion TEXT,
     imagen VARCHAR(255),
    stock INT,
);

INSERT INTO mobiliaria (nombre, precio, categoria, descripcion, marca, imagen, stock) VALUES
('Escritorio', 149.99, 'Mobiliaria', 'Escritorio de madera', 'Madera', 'imagenes/escritorio.jpg', 10),
('mesa', 149.99, 'Mobiliaria', 'Mesa de madera', 'Madera', 'imagenes/mesa.jpg', 10),
('silla', 79.99, 'Mobiliaria', 'Silla de madera', 'Madera', 'imagenes/silla.jpg', 20),
('estante', 99.99, 'Mobiliaria', 'Estante de madera', 'Madera', 'imagenes/estante.jpg', 15),
('armario', 149.99, 'Mobiliaria', 'Armario de madera', 'Madera', 'imagenes/armario.jpg', 10),
('cajones', 149.99, 'Mobiliaria', 'Cajones de madera', 'Madera', 'imagenes/cajones.jpg', 10),
('sofas', 79.99, 'Mobiliaria', 'Silla de madera', 'Madera', 'imagenes/silla.jpg', 20),
('estante', 99.99, 'Mobiliaria', 'Estante de madera', 'Madera', 'imagenes/estante.jpg', 15),
('sillon', 149.99, 'Mobiliaria', 'Escritorio de madera', 'Madera', 'imagenes/escritorio.jpg', 10),
('camas', 149.99, 'Mobiliaria', 'Mesa de madera', 'Madera', 'imagenes/mesa.jpg', 10),
('silla', 79.99, 'Mobiliaria', 'Silla de madera', 'Madera', 'imagenes/silla.jpg', 20),
('silla', 79.99, 'Mobiliaria', 'Silla de madera', 'Madera', 'imagenes/silla.jpg', 20);




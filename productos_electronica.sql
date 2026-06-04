CREATE TABLE electronica (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    precio DECIMAL(8,2),
    categoria VARCHAR(50),
    descripcion TEXT,
     imagen1 VARCHAR(255),
    imagen2 VARCHAR(255),
    imagen3 VARCHAR(255)
);

INSERT INTO electronica (nombre, precio, categoria, descripcion, imagen1, imagen2, imagen3) VALUES
('Portátil HP', 799.99, 'Electronica', 'Portátil HP de 15 pulgadas', 'imagenes/portatil1.jpg', 'imagenes/portatil2.jpg', 'imagenes/portatil3.jpg'),
('Ratón Logitech', 24.99, 'Electronica', 'Ratón Logitech inalámbrico', 'imagenes/raton1.jpg', 'imagenes/raton2.jpg', 'imagenes/raton3.jpg'),
('Escritorio', 149.99, 'Electronica', 'Escritorio de madera', 'imagenes/escritorio1.jpg', 'imagenes/escritorio2.jpg', 'imagenes/escritorio3.jpg');
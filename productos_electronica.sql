CREATE TABLE electronica (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100),
    precio DECIMAL(8,2),
    categoria VARCHAR(50),
    descripcion TEXT,
    marca VARCHAR(50),
    imagen VARCHAR(255),
    stock INT,
);

INSERT INTO electronica (nombre, precio, categoria, descripcion, marca, imagen, stock) VALUES
('Portátil HP', 799.99, 'Electronica', 'Portátil HP de 15 pulgadas', 'HP', 'imagenes/portatil1.jpg', 5),
('Ratón Logitech', 24.99, 'Electronica', 'Ratón Logitech inalámbrico', 'Logitech', 'imagenes/raton1.jpg', 20),
('Tablet', 149.99, 'Electronica', 'Tablet de 10 pulgadas', 'Apple', 'imagenes/tablet1.jpg', 10),
('Teclado', 149.99, 'Electronica', 'Teclado mecánico', 'Logitech', 'imagenes/teclado1.jpg', 10),
('Pantalla', 149.99, 'Electronica', 'Pantalla de 24 pulgadas', 'Samsung', 'imagenes/pantalla1.jpg', 10),
('cable ethernet', 14.99, 'Electronica', 'Cable ethernet de 3 metros', 'TP-Link', 'imagenes/cable1.jpg', 50),
('router', 14.99, 'Electronica', 'Router inalámbrico', 'TP-Link', 'imagenes/router1.jpg', 50),
('repetidor', 14.99, 'Electronica', 'Repetidor inalámbrico', 'TP-Link', 'imagenes/repetidor1.jpg', 50),
('impresora', 14.99, 'Electronica', 'Impresora multifunción', 'Epson', 'imagenes/impresora1.jpg', 50),
('monitor', 14.99, 'Electronica', 'Monitor de 24 pulgadas', 'Dell', 'imagenes/monitor1.jpg', 50);
('televisor', 14.99, 'Electronica', 'Televisor de 24 pulgadas', 'Sony', 'imagenes/televisor1.jpg', 50);
('pc', 79.99, 'Electronica', 'PC de escritorio', 'imagenes/pc.jpg', 10);

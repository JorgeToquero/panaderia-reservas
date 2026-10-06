CREATE DATABASE IF NOT EXISTS panaderia_db;
USE panaderia_db;

CREATE TABLE IF NOT EXISTS usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  telefono VARCHAR(20),
  rol ENUM('cliente','admin') DEFAULT 'cliente',
  fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS productos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(100) NOT NULL,
  descripcion TEXT,
  precio DECIMAL(6,2) NOT NULL,
  categoria VARCHAR(50),
  stock_diario INT NOT NULL DEFAULT 0,
  imagen VARCHAR(255) DEFAULT NULL,
  activo TINYINT(1) DEFAULT 1,
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS reservas (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_usuario INT NOT NULL,
  fecha_reserva DATE NOT NULL,
  hora_reserva TIME NOT NULL,
  total DECIMAL(8,2) NOT NULL,
  estado ENUM('pendiente','confirmada','cancelada') DEFAULT 'pendiente',
  fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

CREATE TABLE IF NOT EXISTS lineas_reserva (
  id INT AUTO_INCREMENT PRIMARY KEY,
  id_reserva INT NOT NULL,
  id_producto INT NOT NULL,
  cantidad INT NOT NULL,
  precio_unitario DECIMAL(6,2) NOT NULL,
  FOREIGN KEY (id_reserva) REFERENCES reservas(id),
  FOREIGN KEY (id_producto) REFERENCES productos(id)
);

INSERT IGNORE INTO usuarios (nombre, email, password, rol) 
VALUES ('Admin Panadería', 'admin@panaderia.com', 'admin123', 'admin');
INSERT IGNORE INTO productos (nombre,precio,categoria,stock_diario,imagen) VALUES 
('Pan pueblo',2.50,'Pan',30,'Pan_pueblo.jpg'),
('Croissant',1.50,'Pastelería',40,'Croissant.jpg'),
('Baguette',1.80,'Pan',25,'Baguette.jpg');
--$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi
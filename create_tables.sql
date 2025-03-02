-- TABLE DRIVERS -- 
CREATE TABLE drivers (
    driver_number VARCHAR(50) PRIMARY KEY,
    position INT NOT NULL,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    team VARCHAR(100) NOT NULL,
    points INT NOT NULL,
    country VARCHAR(50) NOT NULL,
    flag_url TEXT NOT NULL,
    logo_url TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- TABLE DRIVERS BUENA --
CREATE TABLE drivers (
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL PRIMARY KEY,
    team VARCHAR(100) NOT NULL,
    country VARCHAR(50) NOT NULL,
    flag_url TEXT NOT NULL,
    piloto_img TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- TABLE TEAMS -- 
CREATE TABLE teams (
    team_position INT PRIMARY KEY,
    team_name VARCHAR(100) NOT NULL,
    driver1 VARCHAR(100) NOT NULL,
    driver2 VARCHAR(100) NOT NULL,
    points INT NOT NULL,
    img_team TEXT NOT NULL,
    img_car TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- TABLE TEAMS BUENA -- 
CREATE TABLE teams (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    team_name VARCHAR(100) NOT NULL,
    driver1 VARCHAR(100) NOT NULL,
    driver2 VARCHAR(100) NOT NULL,
    img_team TEXT NOT NULL,
    img_car TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- TABLE RACES BUENA -- 
CREATE TABLE races (
    id INT AUTO_INCREMENT PRIMARY KEY,
    grand_prix VARCHAR(255) NOT NULL UNIQUE,
    race_date VARCHAR(255) NOT NULL,
    winner VARCHAR(255) NOT NULL,
    car VARCHAR(255) NOT NULL,
    laps INT NOT NULL
);






CREATE TABLE User (
    id INT AUTO_INCREMENT PRIMARY KEY,          -- Identificador único del usuario
    username VARCHAR(50) NOT NULL UNIQUE,       -- Nombre de usuario (único)
    email VARCHAR(100) NOT NULL UNIQUE,         -- Correo electrónico (único)
    password VARCHAR(255) NOT NULL,             -- Contraseña cifrada
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Fecha de creación del usuario
);

ALTER TABLE User ADD COLUMN role ENUM('user', 'admin') DEFAULT 'user';
UPDATE User SET role = 'admin' WHERE id = 1; -- Asignar rol admin al usuario con id 1
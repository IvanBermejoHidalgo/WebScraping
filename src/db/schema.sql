CREATE TABLE teams (
    id INT AUTO_INCREMENT PRIMARY KEY,
    team_name VARCHAR(255) NOT NULL,
    img_team VARCHAR(255),
    img_car VARCHAR(255),
    UNIQUE (team_name)  -- Asegura que no haya nombres de equipo duplicados
);

CREATE TABLE drivers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    team_id INT,
    country VARCHAR(255),
    flag_url VARCHAR(255),
    piloto_img VARCHAR(255),
    FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE SET NULL
);

CREATE TABLE races (
    id INT AUTO_INCREMENT PRIMARY KEY,
    grand_prix VARCHAR(255) NOT NULL,
    race_date VARCHAR(255) NOT NULL,
    winner VARCHAR(255),
    team_id INT,
    laps INT,
    FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE SET NULL
);

CREATE TABLE User (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE
);

ALTER TABLE User ADD COLUMN role ENUM('user', 'admin') DEFAULT 'user';
UPDATE User SET role = 'admin' WHERE id = 1; -- Asignar rol admin al usuario con id 1
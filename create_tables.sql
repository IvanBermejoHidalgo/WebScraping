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


-- TABLA FINAL DRIVERS --
CREATE TABLE drivers (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    team_name VARCHAR(100) NOT NULL,
    country VARCHAR(50) NOT NULL,
    flag_url TEXT NOT NULL,
    piloto_img TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE drivers (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    team_name VARCHAR(100),
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

-- TABLA FINAL TEAMS --
CREATE TABLE teams (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    team_name VARCHAR(100) NOT NULL,
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













-- Tabla teams
CREATE TABLE teams (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    team_name VARCHAR(100) NOT NULL,
    img_team TEXT NOT NULL,
    img_car TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla drivers
CREATE TABLE drivers (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    team_id INT,  -- Clave foránea que apunta a teams(id)
    country VARCHAR(50) NOT NULL,
    flag_url TEXT NOT NULL,
    piloto_img TEXT NOT NULL,
    FOREIGN KEY (team_id) REFERENCES teams(id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla races
CREATE TABLE races (
    id INT AUTO_INCREMENT PRIMARY KEY,
    grand_prix VARCHAR(255) NOT NULL UNIQUE,
    race_date DATE NOT NULL,  -- Usamos DATE para almacenar fechas
    winner_id INT,  -- Clave foránea que apunta a drivers(id)
    car_team_id INT,  -- Clave foránea que apunta a teams(id)
    laps INT NOT NULL,
    FOREIGN KEY (winner_id) REFERENCES drivers(id) ON DELETE SET NULL ON UPDATE CASCADE,
    FOREIGN KEY (car_team_id) REFERENCES teams(id) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


























-- Tabla teams
CREATE TABLE teams (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    team_name VARCHAR(100) NOT NULL UNIQUE,  -- Nombre único del equipo
    img_team TEXT NOT NULL,
    img_car TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla drivers
CREATE TABLE drivers (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    team_name VARCHAR(100),  -- Nombre del equipo
    country VARCHAR(50) NOT NULL,
    flag_url TEXT NOT NULL,
    piloto_img TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla races
CREATE TABLE races (
    id INT AUTO_INCREMENT PRIMARY KEY,
    grand_prix VARCHAR(255) NOT NULL UNIQUE,
    race_date DATE NOT NULL,  -- Usamos DATE para almacenar fechas
    winner VARCHAR(255) NOT NULL,  -- Nombre del piloto ganador
    car VARCHAR(255) NOT NULL,  -- Nombre del equipo del coche ganador
    laps INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;










-- Tabla teams
CREATE TABLE teams (
    team_name VARCHAR(100) NOT NULL PRIMARY KEY,  -- Clave primaria
    img_team TEXT NOT NULL,
    img_car TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla drivers
CREATE TABLE drivers (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    team_name VARCHAR(100),  -- Clave foránea que apunta a teams.team_name
    country VARCHAR(50) NOT NULL,
    flag_url TEXT NOT NULL,
    piloto_img TEXT NOT NULL,
    FOREIGN KEY (team_name) REFERENCES teams(team_name) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




-- Tabla races
CREATE TABLE races (
    id INT AUTO_INCREMENT PRIMARY KEY,
    grand_prix VARCHAR(255) NOT NULL UNIQUE,
    race_date DATE NOT NULL,  -- Usamos DATE para almacenar fechas
    winner VARCHAR(255) NOT NULL,  -- Nombre del piloto ganador
    car_team_name VARCHAR(100),  -- Clave foránea que apunta a teams.team_name
    laps INT NOT NULL,
    FOREIGN KEY (car_team_name) REFERENCES teams(team_name) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE races (
    id INT AUTO_INCREMENT PRIMARY KEY,
    grand_prix VARCHAR(255) NOT NULL UNIQUE,
    race_date VARCHAR(255) NOT NULL,  -- Usamos DATE para almacenar fechas
    winner VARCHAR(255) NOT NULL,  -- Nombre del piloto ganador
    car_team_name VARCHAR(100),  -- Clave foránea que apunta a teams.team_name
    laps INT NOT NULL,
    FOREIGN KEY (car_team_name) REFERENCES teams(team_name) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE races (
    id INT AUTO_INCREMENT PRIMARY KEY,
    grand_prix VARCHAR(255) NOT NULL UNIQUE,
    race_date VARCHAR(255) NOT NULL,  -- Usamos DATE para almacenar fechas
    winner VARCHAR(255) NOT NULL,  -- Nombre del piloto ganador
    car_team_name VARCHAR(100),  -- Clave foránea que apunta a team_mapping.race_team_name
    laps INT NOT NULL,
    FOREIGN KEY (car_team_name) REFERENCES team_mapping(race_team_name) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE team_mapping (
    team_name VARCHAR(100) NOT NULL,  -- Clave foránea que apunta a teams.team_name
    race_team_name VARCHAR(100) NOT NULL UNIQUE,  -- Nombre único en races
    PRIMARY KEY (team_name, race_team_name),
    FOREIGN KEY (team_name) REFERENCES teams(team_name) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;







CREATE TABLE User (
    id INT AUTO_INCREMENT PRIMARY KEY,          -- Identificador único del usuario
    username VARCHAR(50) NOT NULL UNIQUE,       -- Nombre de usuario (único)
    email VARCHAR(100) NOT NULL UNIQUE,         -- Correo electrónico (único)
    password VARCHAR(255) NOT NULL,             -- Contraseña cifrada
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Fecha de creación del usuario
);

ALTER TABLE User ADD COLUMN role ENUM('user', 'admin') DEFAULT 'user';
UPDATE User SET role = 'admin' WHERE id = 1; -- Asignar rol admin al usuario con id 1





-- Tabla teams
CREATE TABLE teams (
    team_name VARCHAR(100) NOT NULL PRIMARY KEY,  -- Clave primaria
    img_team TEXT NOT NULL,
    img_car TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla team_mapping
CREATE TABLE team_mapping (
    team_name VARCHAR(100) NOT NULL,  -- Clave foránea que apunta a teams.team_name
    race_team_name VARCHAR(100) NOT NULL UNIQUE,  -- Nombre único en races
    PRIMARY KEY (team_name, race_team_name),
    FOREIGN KEY (team_name) REFERENCES teams(team_name) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla drivers
CREATE TABLE drivers (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    team_name VARCHAR(100),  -- Clave foránea que apunta a teams.team_name
    country VARCHAR(50) NOT NULL,
    flag_url TEXT NOT NULL,
    piloto_img TEXT NOT NULL,
    FOREIGN KEY (team_name) REFERENCES teams(team_name) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Tabla races
CREATE TABLE races (
    id INT AUTO_INCREMENT PRIMARY KEY,
    grand_prix VARCHAR(255) NOT NULL UNIQUE,
    race_date VARCHAR(255) NOT NULL,  -- Usamos VARCHAR para almacenar fechas como texto
    winner VARCHAR(255) NOT NULL,  -- Nombre del piloto ganador
    car_team_name VARCHAR(100),  -- Clave foránea que apunta a team_mapping.race_team_name
    laps INT NOT NULL,
    FOREIGN KEY (car_team_name) REFERENCES team_mapping(race_team_name) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

















-- Crear la tabla teams
CREATE TABLE teams (
    team_name VARCHAR(100) NOT NULL PRIMARY KEY,  -- Clave primaria
    img_team TEXT NOT NULL,
    img_car TEXT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Crear la tabla team_mapping
CREATE TABLE team_mapping (
    team_name VARCHAR(100) NOT NULL,  -- Clave foránea que apunta a teams.team_name
    race_team_name VARCHAR(100) NOT NULL UNIQUE,  -- Nombre único en races
    PRIMARY KEY (team_name, race_team_name),
    FOREIGN KEY (team_name) REFERENCES teams(team_name) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Crear la tabla drivers
CREATE TABLE drivers (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    team_name VARCHAR(100),  -- Clave foránea que apunta a teams.team_name
    country VARCHAR(50) NOT NULL,
    flag_url TEXT NOT NULL,
    piloto_img TEXT NOT NULL,
    FOREIGN KEY (team_name) REFERENCES teams(team_name) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Crear la tabla races
CREATE TABLE races (
    id INT AUTO_INCREMENT PRIMARY KEY,
    grand_prix VARCHAR(255) NOT NULL UNIQUE,
    race_date VARCHAR(255) NOT NULL,  -- Usamos VARCHAR para almacenar fechas como texto
    winner VARCHAR(255) NOT NULL,  -- Nombre del piloto ganador
    car_team_name VARCHAR(100),  -- Clave foránea que apunta a team_mapping.race_team_name
    laps INT NOT NULL,
    FOREIGN KEY (car_team_name) REFERENCES team_mapping(race_team_name) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


INSERT INTO team_mapping (team_name, race_team_name)
VALUES 
('Red Bull Racing', 'Red Bull Racing Honda RBPT'),
('Ferrari', 'Ferrari'),
('Mercedes', 'Mercedes'),
('McLaren', 'McLaren Mercedes'),
('Alpine', 'Alpine'),
('Aston Martin', 'Aston Martin'),
('Haas', 'Haas'),
('Kick Sauber', 'Kick Sauber'),
('Racing Bulls', 'Racing Bulls'),
('Williams', 'Williams Racing');

INSERT INTO team_mapping (team_name, race_team_name) VALUES
('Alpine', 'Alpine'),
('Aston Martin', 'Aston Martin'),
('Ferrari', 'Ferrari'),
('Haas', 'Haas'),
('Kick Sauber', 'Kick Sauber'),
('McLaren', 'McLaren Mercedes'),
('Mercedes', 'Mercedes'),
('Racing Bulls', 'Racing Bulls'),
('Red Bull Racing ', 'Red Bull Racing Honda RBPT'),
('Williams', 'Williams Racing');







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
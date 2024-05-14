CREATE TABLE sesizari (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    Subiect_sesizare VARCHAR(200) NOT NULL,
    Data_interventie DATE NOT NULL,
    Descriere_sesizare VARCHAR(900) NOT NULL,
    Prioritate_sesizare VARCHAR(50) NOT NULL,
    Status_sesizare VARCHAR(100), --activa/inactiva
    Info_sesizare VARCHAR(900),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    closed_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    submittedby VARCHAR(100) NOT NULL,
    technician VARCHAR(100)
);
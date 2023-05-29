CREATE TABLE voiture (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marque VARCHAR(50) NOT NULL,
    modele VARCHAR(50) NOT NULL,
    immatriculation VARCHAR(20) NOT NULL,
    carburant VARCHAR(20) NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    type_vente ENUM('occasion', 'neuve') NOT NULL,
    reserve BOOLEAN NOT NULL
);

INSERT INTO voiture (marque, modele, immatriculation, carburant, prix, type_vente, reserve)
VALUES
    ('Renault', 'Clio', 'AB123CD', 'Essence', 15000.00, 'occasion', true),
    ('Peugeot', '308', 'EF456GH', 'Diesel', 18000.00, 'occasion', false),
    ('Volkswagen', 'Golf', 'IJ789KL', 'Essence', 20000.00, 'neuve', false);
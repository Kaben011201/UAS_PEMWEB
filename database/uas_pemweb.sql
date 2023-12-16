-- Active: 1682758151526@@127.0.0.1@3306@uas_pemweb_bendry
CREATE TABLE jemaat(
    id INT(100) PRIMARY KEY AUTO_INCREMENT,
    nama VARCHAR(100),
    tgllahir DATE,
    usia INT(3),
    jenkel TEXT(50),
    nohp VARCHAR(12),
    alamat VARCHAR(200)
);

INSERT INTO jemaat (id, nama, tgllahir, usia, jenkel, nohp, alamat)
VALUES
    (1, 'John Doe', '1990-05-15', 32, 'Male', '1234567890', '123 Main Street'),
    (2, 'Jane Smith', '1985-08-22', 37, 'Female', '9876543210', '456 Oak Avenue'),
    (3, 'Bob Johnson', '1995-03-10', 27, 'Male', '5551234567', '789 Pine Lane');



-- Active: 1682758151526@@127.0.0.1@3306@uas_pemweb_bendry

CREATE TABLE jemaat(
    ktp INT(16) PRIMARY KEY,
    nama VARCHAR(100),
    tgllahir DATE,
    usia INT(3),
    jenkel TEXT(50),
    nohp VARCHAR(12),
    alamat VARCHAR(200)
);

INSERT INTO jemaat (ktp, nama, tgllahir, usia, jenkel, nohp, alamat)
VALUES
    (123, 'John Doe', '1990-05-15', 32, 'Male', '1234567890', '123 Main Street'),
    (456, 'Jane Smith', '1985-08-22', 37, 'Female', '9876543210', '456 Oak Avenue'),
    (789, 'Bob Johnson', '1995-03-10', 27, 'Male', '5551234567', '789 Pine Lane');



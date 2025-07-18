CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'teknisi', 'service_advisor') NOT NULL,
    nama_lengkap VARCHAR(100),
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE pelanggan (
    pelanggan_id INT PRIMARY KEY AUTO_INCREMENT,
    nama_pelanggan VARCHAR(100),
    no_telepon VARCHAR(20),
    email VARCHAR(100),
    alamat TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE kendaraan (
    kendaraan_id INT PRIMARY KEY AUTO_INCREMENT,
    pelanggan_id INT,
    no_polisi VARCHAR(20) UNIQUE,
    merk VARCHAR(50),
    tipe VARCHAR(50),
    tahun INT,
    warna VARCHAR(30),
    no_rangka VARCHAR(50),
    no_mesin VARCHAR(50),
    FOREIGN KEY (pelanggan_id) REFERENCES pelanggan(pelanggan_id)
);

CREATE TABLE rekam_medis (
    rekam_id INT PRIMARY KEY AUTO_INCREMENT,
    kendaraan_id INT,
    teknisi_id INT,
    tanggal_servis DATE,
    keluhan TEXT,
    tindakan_servis TEXT,
    rekomendasi TEXT,
    status_servis ENUM('Selesai', 'Dalam Proses', 'Dibatalkan'),
    FOREIGN KEY (kendaraan_id) REFERENCES kendaraan(kendaraan_id),
    FOREIGN KEY (teknisi_id) REFERENCES users(user_id)
);

CREATE TABLE suku_cadang (
    suku_cadang_id INT PRIMARY KEY AUTO_INCREMENT,
    nama_barang VARCHAR(100),
    satuan VARCHAR(20),
    harga DECIMAL(10,2),
    stok INT
);

CREATE TABLE rekam_detail_part (
    id INT PRIMARY KEY AUTO_INCREMENT,
    rekam_id INT,
    suku_cadang_id INT,
    jumlah INT,
    subtotal DECIMAL(10,2),
    FOREIGN KEY (rekam_id) REFERENCES rekam_medis(rekam_id),
    FOREIGN KEY (suku_cadang_id) REFERENCES suku_cadang(suku_cadang_id)
);



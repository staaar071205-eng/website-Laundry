CREATE DATABASE IF NOT EXISTS `crud-oop-php`
    DEFAULT CHARACTER SET utf8mb4
    DEFAULT COLLATE utf8mb4_unicode_ci;

USE `crud-oop-php`;

CREATE TABLE tb_users (
    user_id          INT(11)      NOT NULL AUTO_INCREMENT,
    user_name        VARCHAR(50)  NOT NULL,
    user_password    VARCHAR(256) NOT NULL,
    user_namalengkap VARCHAR(100) NOT NULL,
    user_aktif       TINYINT(3)   NOT NULL DEFAULT 1,
    PRIMARY KEY (user_id),
    UNIQUE KEY uq_user_name (user_name)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE tb_pelanggan (
    pel_id     INT(11)      NOT NULL AUTO_INCREMENT,
    pel_nama   VARCHAR(100) NOT NULL,
    pel_alamat TEXT         NULL,
    pel_hp     VARCHAR(30)  NOT NULL,
    PRIMARY KEY (pel_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE tb_layanan (
    lay_id    INT(11)      NOT NULL AUTO_INCREMENT,
    lay_jenis VARCHAR(100) NOT NULL,
    lay_harga INT(11)      NOT NULL,
    PRIMARY KEY (lay_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE tb_transaksi (
    trans_id           INT(11) NOT NULL AUTO_INCREMENT,
    trans_id_pelanggan INT(11) NOT NULL,
    trans_id_layanan   INT(11) NOT NULL,
    trans_tgl_masuk    DATE    NOT NULL,
    trans_tgl_selesai  DATE    NULL,
    trans_berat        INT(11) NOT NULL,
    trans_total        INT(11) NOT NULL,
    PRIMARY KEY (trans_id),
    KEY idx_trans_pelanggan (trans_id_pelanggan),
    KEY idx_trans_layanan (trans_id_layanan),
    CONSTRAINT fk_trans_pelanggan FOREIGN KEY (trans_id_pelanggan)
        REFERENCES tb_pelanggan (pel_id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_trans_layanan FOREIGN KEY (trans_id_layanan)
        REFERENCES tb_layanan (lay_id)
        ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO tb_users (user_name, user_password, user_namalengkap, user_aktif) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator', 1);
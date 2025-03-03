<?php

// File model gaji.php untuk menyimpan data karyawan
define('GAJI_FILE', __DIR__ . '/model/gaji.php');

// Pastikan folder model ada 
if (!file_exists(__DIR__ . '/model')) {
    mkdir(__DIR__ . '/model', 0777, true);
}

// Fungsi untuk membaca data karyawan dari file
function bacakaryawan() {
    if (!file_exists(GAJI_FILE)) {
        return[];
    }
    $data = include GAJI_FILE;
    return is_array($data) ? $data : [];
}

// Fungsi untuk menyimpan data karyawan ke file
function simpanKaryawan() {
    $Karyawan = bacakaryawan();
    if (empty($Karyawan)) {
        echo "Belum ada data karyawan.\n";
        return;
    }
    echo "\n Daftar Karyawan:\n";
    echo "============= Daftar Karyawan =============\n";
    foreach ($Karyawan as $index => $k) {
        echo "[$index] Nama: {$k['nama']}, Jabatan: {$k['jabatan']}\n";
    } 
    echo "===============================================\n";
}

//Fungsi menambahkan karyawan
function tambahKaryawan() {
    $jabatanTersedia = ['Manager', 'Supervisor', 'Staff'];
    $Karyawan = bacaKaryawan();
    echo "Masukan nama karyawan: ";
    $nama = trim(fgets(STDIN));
    echo "Masukan jabatan karyawan (Manager/Supervisor/Staff): ";
    $jabatan = trim(fgets(STDIN));
    if (!in_array($jabatan, $jabatanTersedia)) {
        echo "Jabatan tidak valid! Hanya boleh manager, supervisor, atau staff.\n";
        return;
    }
    $Karyawan[] = ['nama' => $nama, 'jabatan' => $jabatan];
    simpanKaryawan($karyawan);
    echo "Karyawan berhasil ditambahkan!\n";
}

//Fungsi memperbarui data karyawan 
Function updateKaryawan() {
    $jabatanTersedia = ['Manager', 'Supervisor', 'Staff'];
    $karyawan = bacaKaryawan();
    lihatKaryawan();
    echo "Masukan nomor karyawan yang akan diupdate: ";
    $index = (int)trim(fgets(STDIN));
    if (!isset($karyawan[$index])) {
        echo "Karyawan tidak ditemukan!\n";
        return;
    }
    echo "Maskan nama baru: ";
    $nama = trim(fgets(STDIN));
    echo "Masukan jabatan baru (Manager/Supervisor/Staff): ";
    $jabatan = trim(fgets(STDIN));
    if (!in_array($jabatan, $jabatanTersedia)) {
        echo "Jabatan tidak valid!\n";
        return;
    }
    $Karyawan[$index] = ['nama' => $nama, 'Jabatan' => $jabatan];
    simpanKaryawan($Karyawan);
    echo "Data karyawan berhasil diperbarui!\n";
}

//Fungsi menghapus karyawan
function hapusKaryawan() {
    $karyawan = bacaKaryawan();
    lihatKaryawan;
    echo "Masukan nomor Karyawan yang akan dihapus: ";
    $index = (int)trim(fgets(STDIN));
    if (!isset($konfirmasi[$index])) {
        echo "Karyawan tidak ditemukan!\n";
        return;
    }
    unset($karyawan[$index]);
    simpanKaryawan(array_values($karyawan));
    echo "Karyawan berhasil dihapus!\n";
}

//Fungsi menghitung gaji karyawan berdasarkan jabatan dan lembur
function hitungGaji() {
    $gajiJabatan = [
        'Manager' => 10000000,
        'Supervisor' => 8000000,
        'Staff' => 5000000
    ];
    $Karyawan = bacakaryawan();
    lihatKaryawan();
    echo "Masukan nomor karyawan yang akan dihitung gajinya: ";
    $index = (int)trim(fgets(STDIN));
    if (!isset($karyawan [$index])) {
        echo "Karyawan tidak ditemukan!\n";
        return;
    }
    echo "Masukan jumlah jam lembur: ";
    $jamLembur = (int)trim(fgets(STDIN));
    $jabatan = $Karyawan[$index]['jabatan'];
    $gajiPokok = $gajiJabatan[$jabatan] ?? 4000000; // Default gaji jika jabatan tidak terdaftar
    $gajiLembur = $jamLembur * 50000; // Tarif Lembur per jam
    $totalGaji = $gajiPokok + $gajiLembur;
    echo "Gaji {$karyawan[$index]['nama']} ({$jabatan}) adalah Rp. " . number_format($totalGaji, 0, ',', ',') . "\n";
}

// Menu utama
while (true) {
    echo "\nSistem Manajemen Gaji Karyawan\n";
    echo "1. Lihat Karyawan\n";
    echo "2. Tambah Karyawan\n";
    echo "3. Update Karyawan\n";
    echo "4. Hapus Karyawan\n";
    echo "5. Hitung gaji Karyawan\n";
    echo "6. Keluar aplikasi\n";
    echo "Pilih aksi (1-6): ";
    $pilihan = trim(fgets(STDIN));
    switch ($pilihan) {
        case '1':
            lihatKaryawan();
            break;
            case '2':
                tambahKaryawan();
                break;
                case '3':
                    updateKaryawan();
                    break;
                    case '4':
                        hapusKaryawan();
                        break;
                        case '5':
                            hitungGaji();
                            break;
                            case '6':
                                exit("Keluar dari aplikasi. Thanks youu\n");
                                default:
                                echo "Pilihan tidak valid! Silahkan masukan nomor aksi yang tersedia.\n";
    }
}
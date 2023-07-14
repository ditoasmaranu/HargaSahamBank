<?php
// Konfigurasi koneksi ke database
$servername = "ditoasmaranu.tech";
$username = "dito_saham_user"; 
$password = "Saham@)23"; 
$dbname = "dito_saham_database"; 
// Buat koneksi ke database
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Periksa apakah koneksi berhasil
if ($mysqli->connect_errno) {
    die("Koneksi ke database gagal: " . $mysqli->connect_error);
}

// Query untuk mengambil data saham yang disimpan di database
$query = "SELECT * FROM harga_saham";

// Eksekusi query
$result = $mysqli->query($query);

// Buat array untuk menyimpan data saham
$data = array();

// Loop melalui hasil query dan tambahkan data ke array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Tutup koneksi ke database
$mysqli->close();

// Mengembalikan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);
?>

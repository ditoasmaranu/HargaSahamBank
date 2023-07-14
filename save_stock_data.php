<?php
$servername = "ditoasmaranu.tech";
$username = "dito_saham_user"; 
$password = "Saham@)23"; 
$dbname = "dito_saham_database"; 

// Ambil data dari request
$data = json_decode(file_get_contents('php://input'), true);

// Buat koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Looping untuk menyimpan data ke database
foreach ($data as $stock) {
    $date = $stock['date'];
    $symbol = $stock['symbol'];
    $open = $stock['open'];
    $high = $stock['high'];
    $low = $stock['low'];
    $close = $stock['close'];
    $volume = $stock['volume'];

    // Query untuk menyimpan data
    $sql = "INSERT INTO harga_saham (date, symbol, open, high, low, close, volume)
            VALUES ('$date', '$symbol', '$open', '$high', '$low', '$close', '$volume')";

    if ($conn->query($sql) === TRUE) {
        $response = [
            'status' => 'success',
            'message' => 'Data saved to MySQL successfully.'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'Error saving data to MySQL: ' . $conn->error
        ];
        break;
    }
}

// Tutup koneksi database
$conn->close();

// Mengembalikan response dalam format JSON
header('Content-Type: application/json');
echo json_encode($response);
?>

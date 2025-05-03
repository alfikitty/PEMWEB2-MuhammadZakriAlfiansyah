<?php
$host = "localhost";
$dbname = "dbpuskesmas";
$username = "root";
$password = "";

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
    die();
}
?>
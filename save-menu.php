<?php
include "config.php";

// Ambil data form
$name        = $_POST["name"];
$price       = $_POST["price"];
$description = $_POST["description"];

// Upload gambar
$imageName = $_FILES["image"]["name"];
$imageTmp  = $_FILES["image"]["tmp_name"];
$uploadPath = "asset/" . $imageName;

move_uploaded_file($imageTmp, $uploadPath);


// ============================
// 1. SIMPAN KE DATABASE
// ============================

$imageData = file_get_contents($uploadPath);

$stmt = $conn->prepare("INSERT INTO menu (Nama_Menu, Harga, Image, Deskripsi) VALUES (?, ?, ?, ?)");
$stmt->bind_param("siss", $name, $price, $imageData, $description);
$stmt->execute();


// ============================
// 2. SIMPAN KE JSON
// ============================

$jsonFile = "menu.json";
$menuData = [];

if (file_exists($jsonFile)) {
    $menuData = json_decode(file_get_contents($jsonFile), true);
}

$newMenu = [
    "name"        => $name,
    "price"       => $price,
    "description" => $description,
    "image"       => $imageName
];

$menuData[] = $newMenu;

file_put_contents($jsonFile, json_encode($menuData, JSON_PRETTY_PRINT));


// Redirect
header("Location: add-menu.php?success=1");
exit;
?>

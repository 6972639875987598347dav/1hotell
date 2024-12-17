<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Sertakan file koneksi
include 'show-data.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Cek apakah input diterima
    if (empty($_POST['username']) || empty($_POST['password'])) {
        die("Username atau password kosong!");
    }

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Debugging input
    echo "Username: $username <br>";
    echo "Password (hash): $password <br>";

    // Persiapkan statement SQL
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    // Bind parameter dan debugging
    if (!$stmt->bind_param("ss", $username, $password)) {
        die("Bind failed: " . $stmt->error);
    }

    // Eksekusi statement
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Execute failed: " . $stmt->error;
    }

    $stmt->close(); // Tutup statement
}

$conn->close(); // Tutup koneksi
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Register</title>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-6 rounded shadow-md w-96">
        <h2 class="text-2xl mb-6 text-center">Register</h2>
        <form method="POST" action="">
            <div class="mb-4">
                <label class="block text-gray-700">Username</label>
                <input type="text" name="username" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded">Register</button>
        </form>
        <p class="mt-4 text-center">Already have an account? <a href="login.php" class="text-blue-500">Login</a></p>
    </div>
</body>
</html>

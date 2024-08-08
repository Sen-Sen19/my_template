<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


include 'conn2.php';

header('Content-Type: application/json');

if (!$conn) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $role = trim($_POST['role'] ?? '');

    if (empty($username) || empty($password) || empty($role)) {
        echo json_encode(['success' => false, 'error' => 'All fields are required.']);
    } else {
        
        $sql = "INSERT INTO [my_template_db].[dbo].[account] ([username], [password], [role]) VALUES (?, ?, ?)";
        $params = [$username, $password, $role];
        
  
        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            echo json_encode(['success' => false, 'error' => sqlsrv_errors()]);
        } else {
            echo json_encode(['success' => true]);
        }

        sqlsrv_free_stmt($stmt);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}


sqlsrv_close($conn);
?>

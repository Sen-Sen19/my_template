<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection file
include 'conn2.php';

header('Content-Type: application/json');

if (!$conn) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input data
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $role = trim($_POST['role'] ?? '');

    // Validate input data
    if (empty($username) || empty($password) || empty($role)) {
        echo json_encode(['success' => false, 'error' => 'All fields are required.']);
    } else {
        // Prepare the SQL statement
        $sql = "INSERT INTO [my_template_db].[dbo].[account] ([username], [password], [role]) VALUES (?, ?, ?)";
        $params = [$username, $password, $role];
        
        // Execute the statement
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

// Close the database connection
sqlsrv_close($conn);
?>

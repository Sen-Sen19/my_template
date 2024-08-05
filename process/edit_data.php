<?php
include 'conn2.php'; // Include your database connection

header('Content-Type: application/json');

if (!$conn) {
    echo json_encode(['success' => false, 'error' => 'Database connection failed']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeNo = $_POST['EmployeeNo'];
    $username = $_POST['Username'];
    $fullName = $_POST['FullName'];
    $section = $_POST['Section'];
    $userType = $_POST['UserType'];

    $sql = "UPDATE [my_template_db].[dbo].[employee] 
            SET [Username] = ?, [FullName] = ?, [Section] = ?, [UserType] = ?
            WHERE [EmployeeNo] = ?";
    
    $params = array($username, $fullName, $section, $userType, $employeeNo);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        echo json_encode(['success' => false, 'error' => sqlsrv_errors()]);
    } else {
        echo json_encode(['success' => true]);
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>

<?php
session_name("my_template");
session_start();

include 'conn2.php';

if (isset($_POST['Login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT username, role FROM account WHERE username = ? AND password = ?";
    $params = array($username, $password);
    $stmt = sqlsrv_prepare($conn, $sql, $params);

    if ($stmt && sqlsrv_execute($stmt)) {
        if (sqlsrv_has_rows($stmt)) {
            $result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
            $role = $result['role']; 
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['role'] = $role;

            if ($role == 'user') {
                header('location: page/user/pagination.php');
                exit;
          
            } elseif ($role == 'admin') { 
                header('location: page/admin/view.php');
                exit;
            }
        } else {
            echo '<script>alert("Sign In Failed. Maybe an incorrect credential or account not found")</script>';
        }
    } else {
        echo '<script>alert("Sign In Failed. Error in preparing or executing SQL query.")</script>';
    }
}

if (isset($_POST['Logout'])) {
    session_unset();
    session_destroy();
    header('location: /my_template/');
    exit;
}
?>

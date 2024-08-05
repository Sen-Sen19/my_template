<?php

include 'conn2.php';

$employee_no = isset($_GET['employee_no']) ? $_GET['employee_no'] : '';
$full_name = isset($_GET['full_name']) ? $_GET['full_name'] : '';
$user_type = isset($_GET['user_type']) ? $_GET['user_type'] : '';

$sql = "SELECT [EmployeeNo], [Username], [FullName], [Section], [UserType] FROM [my_template_db].[dbo].[employee] WHERE 1=1";

$params = [];
if ($employee_no != '') {
    $sql .= " AND [EmployeeNo] LIKE ?";
    $params[] = "%$employee_no%";
}
if ($full_name != '') {
    $sql .= " AND [FullName] LIKE ?";
    $params[] = "%$full_name%";
}
if ($user_type != '') {
    $sql .= " AND [UserType] = ?";
    $params[] = $user_type;
}

$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$rows = [];

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $rows[] = $row;
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo json_encode($rows);
?>

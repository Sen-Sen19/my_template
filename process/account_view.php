<?php
include 'conn2.php'; 


$sql = "SELECT TOP (1000)[username], [password], [role] FROM [my_template_db].[dbo].[account]";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(json_encode(array('error' => sqlsrv_errors())));
}

$data = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
}


sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

echo json_encode($data);
?>

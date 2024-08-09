<?php
include 'conn2.php'; // Include your database connection

// Fetching data from the employee table
$sql = "SELECT TOP (1000) [EmployeeNo], [Username], [FullName], [Section], [UserType] FROM [my_template_db].[dbo].[employee]";
$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(json_encode(array('error' => sqlsrv_errors())));
}

$data = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
}

// Free the statement and close the connection
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

// Return data as JSON
echo json_encode($data);
?>
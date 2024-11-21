?php
include 'conn2.php'; 


$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0; 
$limit = 20; 


$sql = "SELECT [EmployeeNo], [Username], [FullName], [Section], [UserType] FROM [my_template_db].[dbo].[employee] ORDER BY [EmployeeNo] OFFSET ? ROWS FETCH NEXT ? ROWS ONLY";
$params = array($offset, $limit);

$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(json_encode(array('error' => sqlsrv_errors())));
}

$data = array();
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
}


sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

// Return data as JSON
echo json_encode($data);
?>

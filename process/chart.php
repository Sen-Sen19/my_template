<?php
include 'conn2.php';

$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

$sql = "SELECT [month], [rate] FROM [my_template_db].[dbo].[monthly_performance] WHERE [year] = ?";
$params = array($year);

$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$data = array('months' => array(), 'rates' => array());
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $data['months'][] = $row['month'];
    $data['rates'][] = $row['rate'];
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

header('Content-Type: application/json');
echo json_encode($data);
?>

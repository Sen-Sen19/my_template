<?php
include 'conn2.php'; // Include your database connection

// Generate the filename with today's date
$filename = "Employee_data_" . date("Y-m-d") . ".csv";

// Set headers to force download with the generated filename
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');

// Open output stream
$output = fopen('php://output', 'w');

// Add CSV header
fputcsv($output, ['Employee No', 'Username', 'Full Name', 'Section', 'User Type']);

// Query to fetch employee data
$query = "SELECT EmployeeNo, Username, FullName, Section, UserType FROM employee";
$stmt = sqlsrv_query($conn, $query);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

// Fetch data and write to CSV
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    fputcsv($output, $row);
}

// Close the output stream
fclose($output);
exit;
?>

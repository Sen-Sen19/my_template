<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'conn2.php';

// Get the input data from the request
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// Initialize response array
$response = [
    'success' => false,
    'message' => 'An error occurred.'
];

// Check if data is received
if (isset($data['data']) && !empty($data['data'])) {
    $rows = $data['data'];
    $errors = [];
    $processedCount = 0;

    // Remove empty rows
    $rows = array_filter($rows, function ($row) {
        return !empty(array_filter($row));
    });

    foreach ($rows as $row) {
        // Extract data
        $name = isset($row[0]) ? trim($row[0]) : '';
        $username = isset($row[1]) ? trim($row[1]) : '';
        $age = isset($row[2]) ? trim($row[2]) : '';
        $country = isset($row[3]) ? trim($row[3]) : '';

        // SQL query using MERGE
        $sql = "
        MERGE masterlist1 AS target
        USING (VALUES (?, ?, ?, ?)) AS source (name, username, age, country)
        ON target.name = source.name
        WHEN MATCHED THEN
            UPDATE SET 
                target.username = source.username, 
                target.age = source.age, 
                target.country = source.country
        WHEN NOT MATCHED THEN
            INSERT (name, username, age, country)
            VALUES (source.name, source.username, source.age, source.country);
        ";

        // Parameters
        $params = [
            $name,
            $username,
            $age,
            $country
        ];

        // Prepare the statement
        $stmt = sqlsrv_prepare($conn, $sql, $params);
        if ($stmt === false) {
            $errors[] = 'Error preparing statement: ' . print_r(sqlsrv_errors(), true);
            continue;
        }

        // Execute the statement
        $result = sqlsrv_execute($stmt);
        if ($result === false) {
            $errors[] = 'Error executing statement: ' . print_r(sqlsrv_errors(), true);
        } else {
            $processedCount++;
        }
    }

    // Set success message
    if (empty($errors)) {
        $response['success'] = true;
        $response['message'] = "Successfully processed $processedCount records.";
    } else {
        $response['message'] = implode("\n", $errors);
    }
} else {
    $response['message'] = 'No data received.';
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>

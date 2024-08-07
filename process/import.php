<?php
include 'conn2.php'; // Include your database connection

// Set content type to JSON
header('Content-Type: application/json');

$response = [];

// Check if the file was uploaded without errors
if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == 0) {
    $file = $_FILES['csvFile']['tmp_name'];

    // Open the CSV file
    if (($handle = fopen($file, 'r')) !== FALSE) {
        // Skip the header row if necessary
        fgetcsv($handle);

        $insertedRows = 0; // To keep track of inserted rows
        while (($data = fgetcsv($handle)) !== FALSE) {
            // Prepare the SQL statement for each row
            $sql = "INSERT INTO employee (EmployeeNo, Username, FullName, Section, UserType) VALUES (?, ?, ?, ?, ?)";
            $stmt = sqlsrv_prepare($conn, $sql, [
                $data[0], // EmployeeNo
                $data[1], // Username
                $data[2], // FullName
                $data[3], // Section
                $data[4]  // UserType
            ]);

            if ($stmt === false) {
                // If preparation fails, send error and exit
                $response['success'] = false;
                $response['message'] = 'Failed to prepare SQL statement: ' . print_r(sqlsrv_errors(), true);
                echo json_encode($response);
                exit;
            }

            // Execute the statement
            if (sqlsrv_execute($stmt)) {
                $insertedRows++; // Increment the count of inserted rows
            } else {
                // Handle execution error
                $response['success'] = false;
                $response['message'] = 'Error executing statement for row: ' . print_r(sqlsrv_errors(), true);
                echo json_encode($response);
                exit;
            }

            sqlsrv_free_stmt($stmt); // Free statement after execution
        }

        fclose($handle);
        $response['success'] = true;
        $response['message'] = "$insertedRows rows imported successfully!";
    } else {
        $response['success'] = false;
        $response['message'] = 'Could not open file.';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'No file uploaded or there was an error: ' . $_FILES['csvFile']['error'];
}

// Send the response as JSON
echo json_encode($response);

// Close the database connection
sqlsrv_close($conn);
?>

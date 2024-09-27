<?php
include 'conn2.php'; 


header('Content-Type: application/json');

$response = [];

if (isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] == 0) {
    $file = $_FILES['csvFile']['tmp_name'];


    if (($handle = fopen($file, 'r')) !== FALSE) {
       
        fgetcsv($handle);

        $insertedRows = 0; 
        while (($data = fgetcsv($handle)) !== FALSE) {
         
            $sql = "INSERT INTO employee (EmployeeNo, Username, FullName, Section, UserType) VALUES (?, ?, ?, ?, ?)";
            $stmt = sqlsrv_prepare($conn, $sql, [
                $data[0], 
                $data[1], 
                $data[2], 
                $data[3], 
                $data[4]  
            ]);

            if ($stmt === false) {
          
                $response['success'] = false;
                $response['message'] = 'Failed to prepare SQL statement: ' . print_r(sqlsrv_errors(), true);
                echo json_encode($response);
                exit;
            }
    if (sqlsrv_execute($stmt)) {
                $insertedRows++;
            } else {
                $response['success'] = false;
                $response['message'] = 'Error executing statement for row: ' . print_r(sqlsrv_errors(), true);
                echo json_encode($response);
                exit;
            }

            sqlsrv_free_stmt($stmt); 
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


echo json_encode($response);


sqlsrv_close($conn);
?>

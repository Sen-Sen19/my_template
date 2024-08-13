<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['csv_file'])) {
        $file = $_FILES['csv_file']['tmp_name'];
        $results = [];

        if (($handle = fopen($file, 'r')) !== false) {
           
            fgetcsv($handle);
            $sums = []; 
            
            while (($data = fgetcsv($handle)) !== false) {
                foreach ($data as $index => $value) {
                    if (!isset($sums[$index])) {
                        $sums[$index] = 0; 
                    }
                   
                    $sums[$index] += is_numeric($value) ? (float)$value : 0;
                }
            }
            fclose($handle);
        }

       
        session_start();
        $_SESSION['results'] = $sums; 
        header('Location: ../page/admin/comp_dashboard.php');
        exit();
    }
}
?>

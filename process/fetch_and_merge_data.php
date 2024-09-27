<?php
include 'conn2.php';

header('Content-Type: application/json');

// SQL queries to fetch data from both tables
$sql1 = "SELECT * FROM masterlist1";
$sql2 = "SELECT * FROM masterlist2";

$stmt1 = sqlsrv_query($conn, $sql1);
$stmt2 = sqlsrv_query($conn, $sql2);

if ($stmt1 === false || $stmt2 === false) {
    echo json_encode(['message' => 'Error fetching data', 'error' => sqlsrv_errors()]);
    exit;
}

$data1 = [];
$data2 = [];

// Fetch data from masterlist1
while ($row = sqlsrv_fetch_array($stmt1, SQLSRV_FETCH_ASSOC)) {
    $data1[$row['name']] = $row;
}

// Fetch data from masterlist2
while ($row = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC)) {
    $data2[$row['name']] = $row;
}

// Merge data based on the 'name' column
$mergedData = [];
foreach ($data1 as $name => $item1) {
    if (isset($data2[$name])) {
        $item2 = $data2[$name];
        $mergedData[] = array_merge($item1, $item2); // Merge data from both tables
    }
}

// Convert merged data to HTML
function convertDataToHtml($data) {
    $html = '<table border="1"><thead><tr>';
    if (!empty($data)) {
        // Create table headers
        $headers = array_keys($data[0]);
        foreach ($headers as $header) {
            $html .= "<th>$header</th>";
        }
        $html .= '</tr></thead><tbody>';

        // Add rows to table
        foreach ($data as $row) {
            $html .= '<tr>';
            foreach ($row as $cell) {
                $html .= "<td>$cell</td>";
            }
            $html .= '</tr>';
        }
        $html .= '</tbody></table>';
    }
    return $html;
}

$mergedHtml = convertDataToHtml($mergedData);

// Send the merged data as JSON
echo json_encode([
    'dataCount' => count($mergedData),
    'tableHtml' => $mergedHtml
]);
?>

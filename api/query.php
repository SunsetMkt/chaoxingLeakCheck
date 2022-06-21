<?php
// Open file
$file = fopen("school.txt", "r");
// Read file
$content = fread($file, filesize("school.txt"));
// Close file
fclose($file);
// Split file by line
$lines = explode("\n", $content);
// Get query string
if (isset($_GET["q"])) {
    $query = $_GET["q"];
} else {
    $query = "";
}
// If query string is empty, return error
if ($query == "") {
    // mime json
    header("Content-Type: application/json");
    // return error
    echo "[\"查询字符串不能为空\"]";
} else {
    // Create array to store result
    $returnArray = array();
    // Check every line
    foreach ($lines as $line) {
        // Check if line contain query string
        if (strpos($line, $query) !== false) {
            // Push line to return array
            array_push($returnArray, $line);
        }
    }
    // If Array is empty, return error
    if (empty($returnArray)) {
        // mime json
        header("Content-Type: application/json");
        // return error
        echo "[\"没有找到相关结果\"]";
    } else {
        // mime json
        header("Content-Type: application/json");
        // Return json
        echo json_encode($returnArray);
    }
}
?>
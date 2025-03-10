<?php
file_put_contents('log.txt', print_r(file_get_contents('php://input'), true));

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Credentials: true");

$hostname = "localhost";
$database = "schoolattendance";
$username = "root";
$password = "";

$db = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
if (!$db) {
    http_response_code(500);
    $response->error = "Database connection failed";
    exit();
}

// initial response code
// response code will be changed if the request goes into any of the process
http_response_code(404);
$response = new stdClass();

$jsonbody = json_decode(file_get_contents('php://input'));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        if ($jsonbody && isset($jsonbody->name) && isset($jsonbody->formNumber) &&
            isset($jsonbody->maxCapacity)) 
            {

            $name = $jsonbody->name;
            $formNumber = $jsonbody->formNumber;  
            $maxCapacity = $jsonbody->maxCapacity; 

            // Perform database insertion
            $stmt = $db->prepare("INSERT INTO class (name, formNumber, maxCapacity) 
                                   VALUES  (:name, :formNumber, :maxCapacity)");

            $stmt->execute([
                'name' => $name,
                'formNumber' => $formNumber,
                'maxCapacity' => $maxCapacity,
            ]);

            http_response_code(200);
            $response->success = "Classroom added successfully";
        } else {
            http_response_code(400); // Bad Request
            $response->error = "Invalid JSON or missing required parameters";
        }
    } catch (Exception $ee) {
        error_log("Error occurred: " . $ee->getMessage(), 0);
        http_response_code(500);
        $response->error = "Error occurred " . $ee->getMessage();
    }
}

// Before sending the JSON response, set the content type header
header('Content-Type: application/json');
echo json_encode($response);
exit();
?>

<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Credentials: true");

$hostname = "localhost";
$database = "schoolattendance";
$username = "root";
$password = "";

$db = new PDO ("mysql:host=$hostname;dbname=$database",$username,$password);
// initial response code
// response code will be changed if the request goes into any of the process

http_response_code(404);
$response = new stdClass();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
		$stmt = $db->prepare("SELECT COUNT(classId) as count FROM class");
			
		$stmt->execute();
		if ($stmt->rowCount() > 0) {
			http_response_code(200);
			$userData = $stmt->fetch(PDO::FETCH_ASSOC);
			$response = ['count' => $userData['count']];
			
		} else {
			http_response_code(404); // Not Found
			$response['error'] = "No Student Registered in School";
			$response['count'] = 0;
		}
		  
    } catch (Exception $ee) {
        http_response_code(500);
        $response['error'] = "Error occurred " . $ee->getMessage();
    }
}
else if ($_SERVER["REQUEST_METHOD"] == "GET") {
   
}
else if ($_SERVER["REQUEST_METHOD"] == "PUT")
{

}

// Before sending the JSON response, set the content type header
header('Content-Type: application/json');

// Then send the JSON response
echo json_encode($response);
exit();
?>

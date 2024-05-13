<?php

$hostname = "localhost";
$database = "schoolattendance";
$username = "root";
$password = "";

$db = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

// initial response code
// response code will be changed if the request goes into any of the processes

http_response_code(404);
$response = new stdClass();

{
	$jsonbody = json_decode(file_get_contents('php://input'));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        // Check if the email and password are set in the POST request
        if (isset($jsonbody->username) && isset($jsonbody->password)) {
            $username = $jsonbody->username;
            $password = $jsonbody->password;  

            // Check if the email already exists
			$stmt = $db->prepare("SELECT * FROM staff WHERE username=:username AND password=:password");

            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {

                $userData = $stmt->fetch(PDO::FETCH_ASSOC);
                http_response_code(200);
				$response = [
					'staffId' => $userData['staffId'],
					'staffName' => $userData['staffName'],
					'username' => $userData['username'],
					'password' => $userData['password'],
					'position' => $userData['position'],
					'nickname' => $userData['nickname'],
					'image' => $userData['image'],
				];
            } else {
                http_response_code(401);  // Unauthorized
                $response->error = "Invalid username or password.";
            }
        } else {
            http_response_code(400);  // Bad Request
            $response->error = "Username and password are required.";
        }
    } catch (Exception $ee) {
        http_response_code(500);
        $response->error = "Error occurred " . $ee->getMessage();
    }
} 



// Before sending the JSON response, set the content type header
header('Content-Type: application/json');

// Then send the JSON response
echo json_encode($response);
exit();
?>

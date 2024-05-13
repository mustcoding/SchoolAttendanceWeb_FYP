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

{
	$jsonbody = json_decode(file_get_contents('php://input'));
}

if ($_SERVER["REQUEST_METHOD"] == "PUT")
{
			try 
			{
				if(isset($jsonbody->staffId) && isset($jsonbody->password)){
					$staffId = $jsonbody->staffId;
					$password = $jsonbody->password;

					$stmt = $db->prepare("UPDATE staff SET password = :password WHERE staffId = :staffId");
					$stmt->bindParam(':staffId', $staffId);
					$stmt->bindParam(':password', $password);

					$stmt->execute();

					if ($stmt->rowCount() == 1) {
						http_response_code(200);
						$response->success = "Password updated successfully.";
					} else {
						http_response_code(400);  // Bad Request
						$response->error = "Failed to update profile.";
					}

				}
				else {
					http_response_code(400);  // Bad Request
					$response->error = "Invalid JSON format. appUserId and accessStatus are required.";
				}
				
			} catch (Exception $e) {
				http_response_code(500);
				$response->error = "Error occurred " . $e->getMessage();
			}
             
}
else if ($_SERVER["REQUEST_METHOD"] == "POST")
{
			try 
			{
				if (isset($jsonbody->staffId)&&isset($jsonbody->password) ) {
					 $staffId = $jsonbody->staffId;
                     $password = $jsonbody->password;

					$stmt = $db->prepare("SELECT * FROM staff WHERE staffId = :staffId and password=:password");
					$stmt->bindParam(':staffId', $staffId);
                    $stmt->bindParam(':password', $password);
					$stmt->execute();

					if ($stmt->rowCount() == 1) {
						$userData = $stmt->fetch(PDO::FETCH_ASSOC);
                        http_response_code(200);
                        $response = [
                            'staffId' => $userData['staffId'],
                            'staffName' => $userData['staffName'],
                            'nickName' => $userData['nickName'],
                            'username' => $userData['username'],
                            'password' => $userData['password'],
                            'image' => $userData['image'], // Include roleId in the response
                            'position' => $userData['position'],
                        ];
						
					} else {
						http_response_code(400);  // Bad Request
						$response->error = "user not exist.";
					}
				} 
				else {
					http_response_code(400);  // Bad Request
					$response->error = "Invalid JSON format. appUserId and accessStatus are required.";
				}
			} catch (Exception $e) {
				http_response_code(500);
				$response->error = "Error occurred " . $e->getMessage();
			}
   
}

// Before sending the JSON response, set the content type header
header('Content-Type: application/json');
echo json_encode($response);
exit();
?>

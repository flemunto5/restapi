<?php 
//headers 
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-headers:Access-Control-Allow-headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/County.php';

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate county post object
$county = new County($db);

// get the raw posted data
$data = json_decode(file_get_contents("php://input"));

//set id to be updated
$county->id = $data->id;

$county->countyName = $data->countyName;

//update post
if ($county->update()) {
	echo json_encode(array('message' => 'County updated' ));
}
else{
	echo json_encode(array('message' => 'County Not updated' ));
}
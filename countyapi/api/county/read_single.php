<?php 
//headers 
header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

include_once '../../config/Database.php';
include_once '../../models/County.php';

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate county object
$county = new County($db);

//GET ID
$county->id =isset($_GET['id']) ? $_GET['id'] : die();

//GET county
$county->read_single();


//Create array
$county_arr = array(
		  'id' => $county->id,
          'countyName' => $county->countyName
);

//make json
print json_encode($county_arr);
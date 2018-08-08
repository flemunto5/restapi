<?php 
//headers 
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/County.php';

//instantiate DB & connect
$database = new Database();
$db = $database->connect();

//instantiate county post object
$county = new County($db);

//query
$result = $county->read();

//get row count
$num=$result->rowCount();

//check if any post
if($num>0){
	//post array
	$county_arr = array();
	$county_arr['data'] =array();

	while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
		extract($row);
		$county_item=array(
          'id' => $id,
          'countyName' => $countyName
		);

		//pust to "data"
		array_push($county_arr['data'], $county_item);
	}
	echo json_encode($county_arr);

}else{
	 //no posts
      echo json_encode(array('message'=> 'No Posts Found'));
}


?>
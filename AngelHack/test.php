<?php
// Includes
require_once 'cps_simple.php';



// Connection hubs
$connectionStrings = array(
	'tcp://cloud-eu-0.clusterpoint.com:9007',
	'tcp://cloud-eu-1.clusterpoint.com:9007',
	'tcp://cloud-eu-2.clusterpoint.com:9007',
	'tcp://cloud-eu-3.clusterpoint.com:9007'
);

// Creating a CPS_Connection instance
$cpsConn = new CPS_Connection(
	new CPS_LoadBalancer($connectionStrings),
	'angelfwm',
	'saimonbasil@gmail.com',
	'sai7basil',
	'document',
	'//document/id',
	array('account' => 931)
);

// Debug
//$cpsConn->setDebug(true);
// Creating a CPS_Simple instance
$cpsSimple = new CPS_Simple($cpsConn);
// Creating a new document

$retrieveRequest = new CPS_RetrieveRequest('1');
$retrieveResponse = $cpsConn->sendRequest($retrieveRequest);
foreach ($retrieveResponse->getDocuments() as $id => $document) {
	$cnt = $document->cnt;
}
$cnt = $cnt + 1; 
echo $cnt;
$document1['cnt'] = $cnt;
$cpsSimple->updateSingle('1', $document1);

$name = $_POST['name'];
$mobno = $_POST['mobno'];
$amount = $_POST['amount'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$status = $_POST['status'];

$document2 = array(
	'title' => 'userdata',
	'name' => $name,
	'mobno' => $mobno,
	'amount' => $amount,
	'latitude' => $latitude,
	'longitude' => $longitude,
	'status' => $status	
);

// Insert
$insertRequest = new CPS_InsertRequest($cnt, $document2);
$cpsConn->sendRequest($insertRequest);
header("location:table.php?lat=$latitude&lon=$longitude");
?>
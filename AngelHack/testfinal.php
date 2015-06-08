<?php // Includes
require_once 'cps_simple.php';
require_once 'distance.php';


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
$documents = $cpsSimple->listLast(array('document' => 'yes'), 0, $cnt);
foreach ($documents as $id => $document) {
	$stat = $document->status;
	$la1 = (double)$latitude;
	$lo1 = (double)$longitude;
	$la2 = (double)$document->latitude ;
	$lo2 = (double)$document->longitude ;
	$point1 = array("lat" => "$la1", "long" => "$lo1"); // Paris (France)
	$point2 = array("lat" => "$la2", "long" => "$lo2"); // Mexico City (Mexico)
	$km = distanceCalculation($point1['lat'], $point1['long'], $point2['lat'], $point2['long']); // Calculate distance in kilometres (default)
	if($stat == 'give' && $km <= 10)
	{	   
	$flag['name'] = $document2->name ;    
    $flag['mobno'] = $document2->mobno ;    
    $flag['amount'] = $document2->amount ;     
    $flag['latitude'] = $document2->latitude ;     
    $flag['longitude'] = $document2->longitude ;     
    $flag['status'] = $document2->status ; 
	print (json_encode($flag));
	}
	}
$documents2 = $cpsSimple->listLast(array('document' => 'yes'), 0, $cnt);
foreach ($documents2 as $id => $document2) {
	$stat=$document2->status;
	$la1 = (double)$latitude;
	$lo1 = (double)$longitude;
	$la2 = (double)$document2->latitude ;
	$lo2 = (double)$document2->longitude ;
	$point1 = array("lat" => "$la1", "long" => "$lo1"); // Paris (France)
	$point2 = array("lat" => "$la2", "long" => "$lo2"); // Mexico City (Mexico)
	$km = distanceCalculation($point1['lat'], $point1['long'], $point2['lat'], $point2['long']);
	if($stat == 'take' && $km <= 10)
	{
	   
	$flag['name'] = $document2->name ;    
    $flag['mobno'] = $document2->mobno ;    
    $flag['amount'] = $document2->amount ;     
    $flag['latitude'] = $document2->latitude ;     
    $flag['longitude'] = $document2->longitude ;     
    $flag['status'] = $document2->status ; 
	print (json_encode($flag));
	}
	}
?>
<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;
}
table#t01 {
    width: 100%;    
    background-color: #f1f1c1;
}
</style>
</head>
<body>
<?php
// Includes
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
// Retrieving one document
$retrieveRequest = new CPS_RetrieveRequest('1');
$retrieveResponse = $cpsConn->sendRequest($retrieveRequest);
foreach ($retrieveResponse->getDocuments() as $id => $document1) {
	$cnt = $document1->cnt;
}
?>
<?php
$documents = $cpsSimple->listLast(array('document' => 'yes'), 0, $cnt);
?>
<table style="width:100%">
  <tr>
    <th>Name</th>
    <th>Mob No.</th>		
    <th>amount</th>
    <th>latitude</th>
    <th>longitude</th>
    <th>status</th>
  </tr>
  <?php
foreach ($documents as $id => $document) {
	$stat = $document->status;
	$la1 = (double)$_GET['lat'];
	$lo1 = (double)$_GET['lon'];
	$la2 = (double)$document->latitude ;
	$lo2 = (double)$document->longitude ;
	$point1 = array("lat" => "$la1", "long" => "$lo1"); // Paris (France)
	$point2 = array("lat" => "$la2", "long" => "$lo2"); // Mexico City (Mexico)
	$km = distanceCalculation($point1['lat'], $point1['long'], $point2['lat'], $point2['long']); // Calculate distance in kilometres (default)
	if($stat == 'give' && $km <= 10)
	{
	?>
  <tr>
    <td><?php echo $document->name ; ?></td>    
    <td><?php echo $document->mobno ; ?></td>    
    <td><?php echo $document->amount ; ?></td>    
    <td><?php echo $document->latitude ; ?></td>    
    <td><?php echo $document->longitude ; ?></td>    
    <td><?php echo $document->status ; ?></td>    
  </tr>
  <?php
	}
	}
?>
</table>

<br>

<?php
$documents2 = $cpsSimple->listLast(array('document' => 'yes'), 0, $cnt);
?>
<table style="width:100%">
  <tr>
    <th>Name</th>
    <th>Mob No.</th>		
    <th>amount</th>
    <th>latitude</th>
    <th>longitude</th>
    <th>status</th>
  </tr>
  <?php
foreach ($documents2 as $id => $document2) {
	$stat=$document2->status;
	$la1 = (double)$_GET['lat'];
	$lo1 = (double)$_GET['lon'];
	$la2 = (double)$document2->latitude ;
	$lo2 = (double)$document2->longitude ;
	$point1 = array("lat" => "$la1", "long" => "$lo1"); // Paris (France)
	$point2 = array("lat" => "$la2", "long" => "$lo2"); // Mexico City (Mexico)
	$km = distanceCalculation($point1['lat'], $point1['long'], $point2['lat'], $point2['long']);
	if($stat == 'take' && $km <= 10)
	{
	?>
  <tr>
    <td><?php echo $document2->name ; ?></td>    
    <td><?php echo $document2->mobno ; ?></td>    
    <td><?php echo $document2->amount ; ?></td>    
    <td><?php echo $document2->latitude ; ?></td>    
    <td><?php echo $document2->longitude ; ?></td>    
    <td><?php echo $document->status ; ?></td>    
  </tr>
  <?php
	}
	}
?>
</table>

</body>
</html>

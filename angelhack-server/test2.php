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
// Retrieving one document

$documents = $cpsSimple->listLast(array('document' => 'yes'), 0, 5);
foreach ($documents as $id => $document) {
	$stat=$document->status;
	if($stat == 'give')
	{
	echo $document->title . '<br />';
	echo $document->longitude . '<br />';
	echo $document->latitude . '<br />';
	echo $stat . '<br />';
	}
	}
?>
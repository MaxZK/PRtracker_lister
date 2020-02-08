<?php
# Total number of servers to generate server buttons
$config[totalSrv] = 2;
# Specific server configs
# if you have one server then remove config[2]
# if you more than 2 server then copy line 17 to 25 then paste it bellow and change the config number to 3
# make sure that the ids are set correctly with path and name.
$config[1] = array(
	'id' => 1,
	'btnName' => 'My server #1',
	'serverName' => 'Page hearder name',
	'cfgTrackerPath' => '../tracker/',
	'cfgSummaryPath' => '../../../../prbf2/1/json/',
	'cfgDemoPath' => '../demos/',
	'viewURL' => '../../viewer.v3/index.html?demo=../1/tracker/'
);
$config[2] = array(
	'id' => 2,
	'btnName' => 'My server #2',
	'serverName' => 'Page hearder name2',
	'cfgTrackerPath' => '../../2/tracker/',
	'cfgSummaryPath'=> '../../../../prbf2/2/json/',
	'cfgDemoPath'=> '../../2/demos/',
	'viewURL' => '../../viewer.v3/index.html?demo=../2/tracker/'
);
# Configuration for the community website button.
$config[site] = array(
	'URL'=> 'My website URL',
	'btnName'=> 'Forums'
);
# Configuration for a voice or direct communication application button.
$config[voice] = array(
	'URL'=> 'My voice link',
	'btnName'=> 'Discord'
);
# Configuration for the community logo.
$config[logoURL] = 'My logo URL.png';
# Configuration for the server time. Background colour is #161414.
$config[srvTime] =  'http://free.timeanddate.com/clock/i5kdm9ml/n137/fn2/fcfff/tc161414/pcfff161414fff/ahl/tt0/tw1/th1/ta1/tb2';
?>

<?php 
# Total number of servers to generate server buttons
$config[totalSrv] = 2;
# Specific server configs
# if you have one server then remove config[2]
# if you more than 2 server then copy line 16 to 24 and paste it bellow
# make sure that the ids are set correctly with path and name.
$config[1] = array(
	'id' => 1,
	'btnName' => 'FCV #1',
	'serverName' => 'Free Candy Van #1',
	'cfgTrackerPath' => '../tracker/',
	'cfgSummaryPath' => '../../../../prbf2/1/json/',
	'cfgDemoPath' => '../demos/',
	'viewURL' => '../../viewer.v3/index.html?demo=../1/tracker/'
);
$config[2] = array(
	'id' => 2,
	'btnName' => 'FCV #2',
	'serverName' => 'Free Candy Van #2',
	'cfgTrackerPath' => '../../2/tracker/',
	'cfgSummaryPath'=> '../../../../prbf2/2/json/',
	'cfgDemoPath'=> '../../2/demos/',
	'viewURL' => '../../viewer.v3/index.html?demo=../2/tracker/'
);
# Configuration for the community website button.
$config[site] = array(
	'URL'=> 'https://forum.bluedrake42.com/index.php?/gc/1-project-reality/',
	'btnName'=> 'Forums'
);
# Configuration for a voice or direct communication application button.
$config[voice] = array(
	'URL'=> 'https://discord.gg/tat4W8R',
	'btnName'=> 'Discord'
);
# Configuration for the community logo.
$config[logoURL] = 'https://forum.bluedrake42.com/uploads/monthly_2017_02/freecandyvan.png.1336f08dd08e654753b56847eede037f.png';
# Configuration for the server time. Background colour is #161414.
$config[srvTime] =  'http://free.timeanddate.com/clock/i5kdm9ml/n137/fn2/fcfff/tc161414/pcfff161414fff/ahl/tt0/tw1/th1/ta1/tb2';
?>
<!DOCTYPE html>
<?php 
require 'config.php';
$srvID = $_GET['srv'];
if ($srvID == ""){
	return header('Location: ?srv=1');
}
elseif ($config[$srvID]['id'] == "") {
	return header('Location: ?srv=1');
}
$configID = $config[$srvID]['id'];
error_reporting(0);
?>
<html lang="en" ng-app="App">
<head>
    <meta charset="UTF-8">
    <title><?php echo $config[$srvID]['serverName']; ?></title>
    <link href='style/bootstrap.css' rel='stylesheet' type='text/css'>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.7/angular.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.3.js"></script>
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script>
    <script>
    </script>

    <?php
    $dir = $config[$srvID]['cfgTrackerPath'];
	$demoDir = $config[$srvID]['cfgDemoPath'];

    #$res = ();
    $allFiles = scandir($dir);
    $file = array_diff($allFiles, array(
      '.',
      '..',
      'index.html',
      'style',
      'index.php',
      'cdhash.log',
      'kickp_log.txt',
      'dodlog.log',
      'banlist.con',
      'banlist_info.log',
      'banlistbkp',
      'PRDemoViewer',
      'viewer',
      'json',
      'summary.php',
      'viewer_f',
      'index_new.php',
	  'index_old.php',
	  'js',
	  'index2.php',
	  'getSummary.php',
	  'config.php',
	  'getTracker.php'
    ));
    $index=0;
    foreach ( $file as $linha ) {
        $index++;
        $line = $linha;
		$trackerTime = filemtime($line);
		$allDemos = array_diff(scandir($demoDir), array('.','..'));
		foreach ($allDemos as $demoFile){
			$demoTime = filemtime($demoDir.$demoFile);
			if ($demoTime != $trackerTime){
				$trueDemoFile = '<a class="btn btn-sm btn-blocked" href="#"><b>Demo</b></a>';
				continue;
			}
			else {
				$trueDemoFile = '<a class="btn btn-sm btn-info" href="'.$demoDir.$demoFile.'"><b>Demo</b></a>';
				break;
			}
		}
        $notxt = str_replace('.PRdemo', '', $line);
        $nochattxt = str_replace('tracker_', '', $notxt);
        $exploded = explode("_", $nochattxt);
		$GetData0 = substr($nochattxt, 20);
		$getData1 = explode("_gpm_", $GetData0);
		$getData2 = explode("_", $getData1[1]);
        if ($exploded[1] == "01"){
          $month = "January";
        }
        elseif ($exploded[1] == "02"){
          $month = "February";
        }
        elseif ($exploded[1] == "03"){
          $month = "March";
        }
        elseif ($exploded[1] == "04"){
          $month = "April";
        }
        elseif ($exploded[1] == "05"){
          $month = "May";
        }
        elseif ($exploded[1] == "06"){
          $month = "June";
        }
        elseif ($exploded[1] == "07"){
          $month = "July";
        }
        elseif ($exploded[1] == "08"){
          $month = "August";
        }
        elseif ($exploded[1] == "09"){
          $month = "September";
        }
        elseif ($exploded[1] == "10"){
          $month = "October";
        }
        elseif ($exploded[1] == "11"){
          $month = "November";
        }
        elseif ($exploded[1] == "12"){
          $month = "December";
        }
        $time = $exploded[3] . ":" . $exploded[4];
        #$map = ucwords(str_replace("_", " ", $chopeddata3[0]));
        #$rawgpm = $chopeddata3[1];
        $summary = str_replace("PRdemo", "json", $line);
        $getSummary = $config[$srvID]['cfgSummaryPath'] . $summary;
        $getSummaryData = file_get_contents($getSummary);
        $summaryJson = json_decode($getSummaryData, True);
        $map = ucwords(str_replace("_", " ", $getData1[0]));
        #print_r($summaryJson);
        #print "<br><br><br><br><br>";
        #if ($map == ""){
        #  $map = '<i class="grayedout">Server Crashed or stopped mid-round. </i>';
        #}
        if ($getData2[1] == "16"){
          $layer = "Infantry";
        }
        elseif ($getData2[1] == "32"){
          $layer = "Alternative";
        }
        elseif ($getData2[1] == "64"){
          $layer = "Standard";
        }
        elseif ($getData2[1] == "128"){
          $layer = "Large";
        }
        else {
          $layer = "";
        }
        if ($getData2[0] == "skirmish"){
          $mode = "Skirmish";
        }
        elseif ($getData2[0] == "insurgency"){
          $mode = "Insurgency";
        }
        elseif ($getData2[0] == "cq"){
          $mode = "Assault & Secure";
        }
        elseif ($getData2[0] == "vehicles"){
          $mode = "Vehicle Warfare";
        }
        elseif ($getData2[0] == "cnc"){
          $mode = "Command & Control";
        }
        else {
          $mode = "";
        }
        if ($layer == "") {
          $modeLayer = "";
        }
        else {
          $modeLayer = $mode . ", " . $layer;
        }
        $opfortick = $summaryJson['Team1Tickets'];
        $blufortick = $summaryJson['Team2Tickets'];
        if ($blufortick == "0") {
          $opforcollor = "opfor";
          $blueforcollor = "winfor";
        }
        elseif ($opfortick == "0") {
          $opforcollor = "winfor";
          $blueforcollor = "bluefor";
        }
        elseif ($blufortick == "") {
          $opforcollor = "";
          $blueforcollor = "";
        }
        else {
          $opforcollor = "opfor";
          $blueforcollor = "bluefor";
        }
        $Team1Name = $summaryJson['Team1Name'];
        $Team2Name = $summaryJson['Team2Name'];

        $demoYear = $exploded[0];
        $demoMonth = $exploded[1];
        $demoDay = $exploded[2];
        $demoHour = $exploded[3];
        $demoMin = $exploded[4];
        $demoSec = $exploded[5];
        if ($demoMin>55){
          $demoMin0 = $demoMin-60;
          $demoMin = $demoMin0+4;
          $demoHour = $demoHour+1;
        }
        else {
          $demoMin = $demoMin+4;
        }
        if ($demoHour==25){
          $demoHour = $demoHour-24;
          $demoHour = $demoDay+1;
        }


        $res[] = array(
            'view'=> $line,
            'summary' => $summary,
            'year' => $exploded[0],
            'month' => $month,
            'day' => $exploded[2],
            'time' => $time,
            'map' => $map,
            'modeLayer' => $modeLayer,
            'demo' => $trueDemoFile,
            'opforDisplay' => '<span class="'.$opforcollor.'"> '.$blufortick.' </span>',
            'blueforDisplay' => '<span class="'.$blueforcollor.'"> '.$opfortick.' </span>',
            'Team1Name' => $Team1Name,
            'Team2Name' => $Team2Name,
        );

    }

    rsort($res);
    ?>
</head>
<body ng-controller="ApplicationController">
<div id="page-wrap" class="" ng-init="loadContents()">
	<div class="leftstuffstay"> <div class="leftstuffstayin">
		<div class="row-fluid" style="float: left; margin-top: 20px;">
			<img src="<?php echo $config[logo]['logoURL']; ?>" style="margin-top: -7px;" width="60" height="60" alt="Computer Hope logo normal">
		</div>
		<div style="position: absolute; left: 100px; top: 13px;">
			<div> <b><?php echo $config[$srvID]['serverName']; ?></b>
				<ul class="nav nav-pills">
				<?php 
				$totalSrv = $config[totalSrv];
				$idx = 1;
				while($idx <= $totalSrv){
					if ($idx == $configID){
						echo '<li><a class="btn btn-sm btn-active" href="#"><b>'.$config[$idx]['btnName'].'</b></a></li>';
					}
					else {
						echo '<li><a  class="btn btn-sm btn-info" href="?srv='.$idx.'"><b>'.$config[$idx]['btnName'].'</b></a></li>';
					}
					$idx++;
				}
				
				
				?>
					<li><a class="btn btn-sm btn-info" target="_blank" href="<?php echo $config[site]['URL']; ?>"><b><?php echo $config[site]['btnName']; ?></b></a></li>
					<li><a class="btn btn-sm btn-info" target="_blank" href="<?php echo $config[voice]['URL']; ?>"><b><?php echo $config[voice]['btnName']; ?></b></a></li>
				</ul>
			</div>
		</div>
		<div class="row">
			<div class="">
				<div class="well-sm" style="width: 250px; margin-top: 15px; margin-left: 28%;">
					<input id="search" class="form-control form-lg" placeholder="Search">
				</div>
				<div style="font-family: Arial; position: fixed; top: 0; left: 0; float: right; width: 250px; margin-top: 9px; margin-left: 60%; pointer-events: none;"><b>Server Time:</b>
					<iframe src="http://free.timeanddate.com/clock/i5kdm9ml/n137/fn2/fcfff/tc161414/pcfff161414fff/ahl/tt0/tw1/th1/ta1/tb2" frameborder="0" width="250" height="20" allowTransparency="true"></iframe>
				</div>
			</div>
		</div>
    </div>
</div>
        <div id="inner" class="rightstuffnotunder2 row-fluid" style="margin-top: 75px;">
          <div class="col-lg-10ad">
            <table id="table" class="table table-striped table-hover" style="width: 820px; margin: 0 auto; margin-top: 5px; margin-bottom: 5px;" border="1">
                    <thead>
                    <tr>
                        <th>Date and Time:</th>
                        <th>Map name:</th>
                        <th colspan="2">Ended with:</th>
                        <th class="col-md-dl">View:</th>
                    </tr>
                  </thead><tbody><!--
                    <tr ng-repeat="item in results.banlistbkp_log | filter:filter_list">
                        <td class="col-md-1">
                          {{ item.command }}
                        </td>
                    </tr>-->
                    <?php foreach ($res as $item): ?>
                    <tr>
                         <td class="smalltext" style="width: 125px;"><?php echo $item['month']." ". (int) $item['day'].", ".$item['year']."<br><b>".$item['time']."</b>"; ?></td>
                         <td class="smalltext"><b><?php echo $item['map']; ?></b><br><i style="color: #999999; font-size: 9px; margin-top: -10px;"><?php echo $item['modeLayer']; ?></i></td>
                         <?php
						 if ($item['Team2Name'] == "") {
							echo '<td colspan="2"><i class="grayedout">Data unavailable</i></td>';
						 }
						 else {
							echo '<td class="factionflag-' . $item['Team2Name'] . '" style="width: 95px; text-align: center; vertical-align: middle;"><b>' . $item['blueforDisplay'] . '</b></td>';
							echo '<td class="factionflag-' . $item['Team1Name'] . '" style="width: 95px; text-align: center; vertical-align: middle;"><b>' . $item['opforDisplay'] . '</b></td>';
                         }?>
                         <td class="smalltext" style="width: 232px;"><ul class="nav nav-pills">
                           <li><?php echo $item['demo']?></li>
                           <li><a class="btn btn-sm btn-info" target="_blank" href="../../viewer.v3/index.html?demo=../1/tracker/<?php echo $item['view']?>"><b>Tracker</b></a></li>
                           <?php
						 if ($item['Team2Name'] == "") {
							echo '<li><button class="btn btn-sm btn-blocked"><b>Summary</b></button></li>';
						 }
						 else {
							echo '<button data-toggle="modal" data-target="#view-modal" data-id="' . $configID . $item['summary'] . '" id="getSummary" class="btn btn-sm btn-info"><b>Summary</b></button>';
                         }?>
                         </ul></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody></table>
        </div>

</div>
</div>
<!-- .modal --> 		
	<div id="view-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; font-size: 11px;">
		<div class="modal-dialog"> 
			<div class="modal-content"> 
				<div class="modal-header"> 
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
					<h4 class="modal-title">
						Summary
					</h4> 
				</div>
				<div class="modal-body"> 
					<div id="modal-loader" style="display: none; text-align: center;">
						<!-- <img src="ajax-loader.gif">-->Loading...
					</div>
					<!-- content will be load here -->                          
					<div id="dynamic-content"></div>
				</div> 
				<div class="modal-footer"> 
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
				</div> 
			</div> 
		</div>
	</div><!-- /.modal -->  
<script src="js/jquery-1.12.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	
	$(document).on('click', '#getSummary', function(e){
		
		e.preventDefault();
		
		var uid = $(this).data('id');   // it will get id of clicked row
		
		$('#dynamic-content').html(''); // leave it blank before ajax call
		$('#modal-loader').show();      // load ajax loader
		
		$.ajax({
			url: 'getSummary.php',
			type: 'POST',
			data: 'id='+uid,
			dataType: 'html'
		})
		.done(function(data){
			console.log(data);	
			$('#dynamic-content').html('');    
			$('#dynamic-content').html(data); // load response 
			$('#modal-loader').hide();		  // hide ajax loader	
		})
		.fail(function(){
			$('#dynamic-content').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
			$('#modal-loader').hide();
		});
		
	});
	
});

</script>
</body>

<script>
var $rows = $('#table tbody tr');
$('#search').keyup(function() {
    var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();

    $rows.show().filter(function() {
        var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
        return !~text.indexOf(val);
    }).hide();
});
</script>
</html>

<?php
	error_reporting(0);
	require 'config.php';
	if (isset($_REQUEST['id'])) {
	$rawRequest = $_REQUEST['id'];
	$getSrvID = $rawRequest[0];
	$sumFileName = substr($rawRequest,1);
    $sumPath = $config[$getSrvID]['cfgSummaryPath'] . $sumFileName;
	$sumContent = file_get_contents($sumPath);
	$sumJson = json_decode($sumContent, True);
	$sumMapName = ucwords(str_replace("_", " ", $sumJson['MapName']));
	$notxt = str_replace('.json', '', $sumFileName);
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
		$opfortick = $sumJson['Team1Tickets'];
        $blufortick = $sumJson['Team2Tickets'];
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
		$opforDisplay = '<span class="'.$opforcollor.'"> '.$blufortick.' </span>';
        $blueforDisplay = '<span class="'.$blueforcollor.'"> '.$opfortick.' </span>';
		$sumPlayersAll = $sumJson['Players'];
		
		?>
			
		<div class="table-responsive">
		<h3 style="margin-top: -0px;"><?php echo $sumMapName . ' - ' . $month . ' ' . $exploded[2] . ', ' . $exploded[0] . ' ' . $time; ?></h3>
		<table style="float: left; width:49%; border-top: 5px double #aaa;" class="table table-striped">
		<tr><td colspan="5" class="factionflag-<?php echo $sumJson['Team2Name'] ?>" style="height: 133px; text-align: center; vertical-align: middle;"><b style="font-size: 20px;"><?php echo $blueforDisplay?> </b></td></tr>
		<tr style="border-top: 5px double #aaa;">
			<th>Name</th>
			<th><img src="style/overallscore_icon.png" alt="Overall Score" height="15" width="15"></th>
			<th><img src="style/teamworkscore_icon.png" alt="Teamwork Score" height="15" width="15"></th>
			<th><img src="style/killscore_icon.png" alt="Kills" height="15" width="15"></th>
			<th><img src="style/deathscore_icon.png" alt="Deaths" height="15" width="15"></th>
		</tr>
		<tr style="border-top: 5px double #aaa;"><th style="background: #25334D; text-align: center;" colspan="5">Commander</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['SquadLeader']=='true' && $item['Squad']=='0' && $item['Disconnected']=='false'){?>
		<tr style="background: #6B6B25;">
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<tr style="border-top: 5px double #aaa;"><th style="background: #25334D; text-align: center;" colspan="5">Squad #1</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['SquadLeader']=='true' && $item['Squad']=='1' && $item['Disconnected']=='false'){?>
		<tr style="background: #2B432B;">
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['SquadLeader']=='false' && $item['Squad']=='1' && $item['Disconnected']=='false'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		<tr style="border-top: 5px double #aaa;"><th style="background: #25334D; text-align: center;" colspan="5">Squad #2</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['SquadLeader']=='true' && $item['Squad']=='2' && $item['Disconnected']=='false'){?>
		<tr style="background: #2B432B;">
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['SquadLeader']=='false' && $item['Squad']=='2' && $item['Disconnected']=='false'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		<tr style="border-top: 5px double #aaa;"><th style="background: #25334D; text-align: center;" colspan="5">Squad #3</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['SquadLeader']=='true' && $item['Squad']=='3' && $item['Disconnected']=='false'){?>
		<tr style="background: #2B432B;">
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['SquadLeader']=='false' && $item['Squad']=='3' && $item['Disconnected']=='false'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		<tr style="border-top: 5px double #aaa;"><th style="background: #25334D; text-align: center;" colspan="5">Squad #4</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['SquadLeader']=='true' && $item['Squad']=='4' && $item['Disconnected']=='false'){?>
		<tr style="background: #2B432B;">
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['SquadLeader']=='false' && $item['Squad']=='4' && $item['Disconnected']=='false'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		<tr style="border-top: 5px double #aaa;"><th style="background: #25334D; text-align: center;" colspan="5">Squad #5</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['SquadLeader']=='true' && $item['Squad']=='5' && $item['Disconnected']=='false'){?>
		<tr style="background: #2B432B;">
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['SquadLeader']=='false' && $item['Squad']=='5' && $item['Disconnected']=='false'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		<!-- REF FOR COPY PASTA-->
		<tr style="border-top: 5px double #aaa;"><th style="background: #25334D; text-align: center;" colspan="5">Squad #6</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['SquadLeader']=='true' && $item['Squad']=='6' && $item['Disconnected']=='false'){?>
		<tr style="background: #2B432B;">
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['SquadLeader']=='false' && $item['Squad']=='6' && $item['Disconnected']=='false'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		<tr style="border-top: 5px double #aaa;"><th style="background: #25334D; text-align: center;" colspan="5">Squad #7</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['SquadLeader']=='true' && $item['Squad']=='7' && $item['Disconnected']=='false'){?>
		<tr style="background: #2B432B;">
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['SquadLeader']=='false' && $item['Squad']=='7' && $item['Disconnected']=='false'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		<tr style="border-top: 5px double #aaa;"><th style="background: #25334D; text-align: center;" colspan="5">Squad #8</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['SquadLeader']=='true' && $item['Squad']=='8' && $item['Disconnected']=='false'){?>
		<tr style="background: #2B432B;">
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['SquadLeader']=='false' && $item['Squad']=='8' && $item['Disconnected']=='false'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		<tr style="border-top: 5px double #aaa;"><th style="background: #25334D; text-align: center;" colspan="5">Squad #9</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['SquadLeader']=='true' && $item['Squad']=='9' && $item['Disconnected']=='false'){?>
		<tr style="background: #2B432B;">
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['SquadLeader']=='false' && $item['Squad']=='9' && $item['Disconnected']=='false'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		<tr style="border-top: 5px double #aaa;"><th style="background: #25334D; text-align: center;" colspan="5">Unassigned</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['Squad']=='0' && $item['Disconnected']=='false'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		<tr style="border-top: 5px double #aaa;"><th style="background: #25334D; text-align: center;" colspan="5">Disconnected</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='2' && $item['Disconnected']=='true'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		</table>
		
		<table style="float: right; width:49%; border-top: 5px double #aaa;" class="table table-striped">
		<tr><td colspan="5" class="factionflag-<?php echo $sumJson['Team1Name'] ?>" style="height: 133px; text-align: center; vertical-align: middle;"><b style="font-size: 20px;"><?php echo $opforDisplay?> </b></td></tr>
		<tr style="border-top: 5px double #aaa;">
			<th>Name</th>
			<th><img src="style/overallscore_icon.png" alt="Overall Score" height="15" width="15"></th>
			<th><img src="style/teamworkscore_icon.png" alt="Teamwork Score" height="15" width="15"></th>
			<th><img src="style/killscore_icon.png" alt="Kills" height="15" width="15"></th>
			<th><img src="style/deathscore_icon.png" alt="Deaths" height="15" width="15"></th>
		</tr>
		<tr style="border-top: 5px double #aaa;"><th style="background: #4D2525; text-align: center;" colspan="5">Commander</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['SquadLeader']=='true' && $item['Squad']=='0' && $item['Disconnected']=='false'){?>
		<tr style="background: #6B6B25;">
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<tr style="border-top: 5px double #aaa;"><th style="background: #4D2525; text-align: center;" colspan="5">Squad #1</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['SquadLeader']=='true' && $item['Squad']=='1' && $item['Disconnected']=='false'){?>
		<tr style="background: #2B432B;">
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['SquadLeader']=='false' && $item['Squad']=='1' && $item['Disconnected']=='false'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		<tr style="border-top: 5px double #aaa;"><th style="background: #4D2525; text-align: center;" colspan="5">Squad #2</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['SquadLeader']=='true' && $item['Squad']=='2' && $item['Disconnected']=='false'){?>
		<tr style="background: #2B432B;">
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['SquadLeader']=='false' && $item['Squad']=='2' && $item['Disconnected']=='false'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		<tr style="border-top: 5px double #aaa;"><th style="background: #4D2525; text-align: center;" colspan="5">Squad #3</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['SquadLeader']=='true' && $item['Squad']=='3' && $item['Disconnected']=='false'){?>
		<tr style="background: #2B432B;">
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['SquadLeader']=='false' && $item['Squad']=='3' && $item['Disconnected']=='false'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		<tr style="border-top: 5px double #aaa;"><th style="background: #4D2525; text-align: center;" colspan="5">Squad #4</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['SquadLeader']=='true' && $item['Squad']=='4' && $item['Disconnected']=='false'){?>
		<tr style="background: #2B432B;">
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['SquadLeader']=='false' && $item['Squad']=='4' && $item['Disconnected']=='false'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		<tr style="border-top: 5px double #aaa;"><th style="background: #4D2525; text-align: center;" colspan="5">Squad #5</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['SquadLeader']=='true' && $item['Squad']=='5' && $item['Disconnected']=='false'){?>
		<tr style="background: #2B432B;">
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['SquadLeader']=='false' && $item['Squad']=='5' && $item['Disconnected']=='false'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		<tr style="border-top: 5px double #aaa;"><th style="background: #4D2525; text-align: center;" colspan="5">Squad #6</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['SquadLeader']=='true' && $item['Squad']=='6' && $item['Disconnected']=='false'){?>
		<tr style="background: #2B432B;">
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['SquadLeader']=='false' && $item['Squad']=='6' && $item['Disconnected']=='false'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		<tr style="border-top: 5px double #aaa;"><th style="background: #4D2525; text-align: center;" colspan="5">Squad #7</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['SquadLeader']=='true' && $item['Squad']=='7' && $item['Disconnected']=='false'){?>
		<tr style="background: #2B432B;">
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['SquadLeader']=='false' && $item['Squad']=='7' && $item['Disconnected']=='false'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		<tr style="border-top: 5px double #aaa;"><th style="background: #4D2525; text-align: center;" colspan="5">Squad #8</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['SquadLeader']=='true' && $item['Squad']=='8' && $item['Disconnected']=='false'){?>
		<tr style="background: #2B432B;">
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['SquadLeader']=='false' && $item['Squad']=='8' && $item['Disconnected']=='false'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		<tr style="border-top: 5px double #aaa;"><th style="background: #4D2525; text-align: center;" colspan="5">Squad #9</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['SquadLeader']=='true' && $item['Squad']=='9' && $item['Disconnected']=='false'){?>
		<tr style="background: #2B432B;">
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['SquadLeader']=='false' && $item['Squad']=='9' && $item['Disconnected']=='false'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		<tr style="border-top: 5px double #aaa;"><th style="background: #4D2525; text-align: center;" colspan="5">Unassigned</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['Squad']=='0' && $item['Disconnected']=='false'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		<tr style="border-top: 5px double #aaa;"><th style="background: #4D2525; text-align: center;" colspan="5">Disconnected</th></tr>
		<?php foreach ($sumPlayersAll as $item): 
		if ($item['Team']=='1' && $item['Disconnected']=='true'){?>
		<tr>
			<td><?php echo $item['Name']; ?></td>
			<td><?php echo $item['Score']; ?></td>
			<td><?php echo $item['ScoreTW']; ?></td>
			<td><?php echo $item['Kills']; ?></td>
			<td><?php echo $item['Deaths']; ?></td>
		</tr>
		<?php } endforeach; ?>
		<!-- REF FOR COPY PASTA-->
		</table>
		 <?php    
} ?>
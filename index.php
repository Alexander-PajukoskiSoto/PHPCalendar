<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>calendar</title>
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
	<style>
		a{
			background-color:rgb(129, 158, 198);
			border:solid rgb(0, 0, 0);
			margin:10px;
		}
	</style>
	<div id='navigation'>
		<?php
		//gets the url
	$monthFromNow = $_GET['monthFromNow'];
	echo "<nav><a href='http://localhost/CalNewNew?monthFromNow=" . ($monthFromNow - 1) . "'>←</a></nav>";
	echo "Månader";
	echo "<nav><a href='http://localhost/CalNewNew?monthFromNow=" . ($monthFromNow + 1) . "'>→</a></nav>";
		?>
		<br>	
		<?php
		//gets the url
	$monthFromNow = $_GET['monthFromNow'];
	echo "<nav><a href='http://localhost/CalNewNew?monthFromNow=" . ($monthFromNow - 12) . "'>←</a></nav>";
	echo "År";
	echo "<nav><a href='http://localhost/CalNewNew?monthFromNow=" . ($monthFromNow + 12) . "'>→</a></nav>";
		?>
	</div>
	<?php 
	
	require_once 'namnsdag.php';
	?>
	<table class='Table table-dark'>
		<thead>
			<?php
			//true modulo 
			function truemod($num, $mod) {
				return ($mod + ($num % $mod)) % $mod;
			}

			

			
			
			//Month Array
			$monthArray = array("Januari ❄️","Februari 🥶","Mars ✝️⛪️🔥","April 🌺","Maj 🐝","Juni 🇸🇪","Juli 🌞","Augusti 🍎","September 🌦","Oktober 🍁","November 🍂","December ✝️⛪️🎄");
			
			//calculate wanted month and year
			$wantedYear = date("Y") + floor(((date("m") -1 + $monthFromNow)/12));
			$wantedMonth = date("m") -1 + $monthFromNow;
			
			//leapCheck
			$leapCheck=0;
			$forLeapYear = date("$wantedYear-12-t");
			$rawLeaping = strtotime($forLeapYear); 
			$highestForLeap = date("z",($rawLeaping));
			$leapCheck = $highestForLeap;
			

			if($leapCheck==364){
				unset($namnsdag[59]);
			}
			$wantedMonthsFromNow = truemod($wantedMonth, 12);
			
			//Links
		
			 echo "<tr>
			 		<th></th>
					<th class='firstHead' colspan='2'>$monthArray[$wantedMonthsFromNow] $wantedYear </th>
					</tr>";
					?>
		</thead>
		<tbody>
		<?php
		//needs separate variable because other one has "-1"
		$monthForLoop = truemod((date("m") + $monthFromNow),12);

		for($d=1; $d<=date("t",$rawDate); $d++){

			$rawDate = strtotime("$wantedYear-$monthForLoop-$d");
			$dayDay = date("l",$rawDate);
			$dayAsNumber = date("d",$rawDate);
			$currentNumberOfDays = date("z",$rawDate) + 1; 
			if($leapCheck==364 && $currentNumberOfDays > 59){
				$febLeapCheck =1;
			}
			else{
				$febLeapCheck=0;
			}

			if(isset($namnsdag[date("z",$rawDate)+$febLeapCheck][1])){
				$currentName = $namnsdag[date("z",$rawDate)+$febLeapCheck][0] . ", " . $namnsdag[date("z",$rawDate)+$febLeapCheck][1];
			}
			else{
				$currentName = $namnsdag[date("z",$rawDate)+$febLeapCheck][0];
			}
			
			
			 echo "<tr>
					<td class='small'>$dayAsNumber</td>
					<td class='$dayDay'>$dayDay</td>
					<td>$currentName</td>
					<td>$currentNumberOfDays</td>
					</tr>";
					}
			?>
					
		</tbody>
	</table>
</body>
</html>
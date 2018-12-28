<?php 
	// $headers = getallheaders();
	// foreach ($headers as $key => $value) {
	// 	echo "$key : $value <br>";
	// }

	// input start and end date 
	$startDate = "01-01-2018"; 
	$endDate = "01-01-2019"; 
	
	$resultDays = array('Monday' => 0, 
	'Tuesday' => 0, 
	'Wednesday' => 0, 
	'Thursday' => 0, 
	'Friday' => 0, 
	'Saturday' => 0, 
	'Sunday' => 0); 

	// change string to date time object 
	$startDate = new DateTime($startDate); 
	$endDate = new DateTime($endDate); 

	// iterate over start to end date 
	while($startDate <= $endDate ){ 
		// find the timestamp value of start date 
		$timestamp = strtotime($startDate->format('d-m-Y')); 

		// find out the day for timestamp and increase particular day 
		$weekDay = date('l', $timestamp); 
		$resultDays[$weekDay] = $resultDays[$weekDay] + 1; 

		// increase startDate by 1 
		$startDate->modify('+1 day'); 
	} 

	// print the result 
	print_r($resultDays); 

?>
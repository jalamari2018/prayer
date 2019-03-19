<?php

function calculate_date_difference($thdate) {	 
		$dateofthelast = strtotime($thdate); 	   
        $today= strtotime(date("Y-m-d"));
	    $difference = ($today - $dateofthelast)/86400;

	    return $difference;
}

function day_days($val){
	if($val <= 10){
		return "أيام";
	}else{
		return "يوم ";

	}
}
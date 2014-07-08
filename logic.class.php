<?php

class logic
{

	public function normalise($days, $sum)  //Statistical normalisation for domain age and aggregate performance score.
    {
    	$real_age = $days;
    	echo ("<p>Confirm real age: $real_age</P>");
	    $real_score = $sum; // The site's real aggregate score. Perfect score is 100%.
        echo ("<p> Real Aggregate score = $real_score </p>");
        $normalised_age = 365;
    	#global $real_age, $real_score, $normalised_age;
		$common_quotient = $real_age / $normalised_age; // The common quotient derived from cross-multiplication.
		$normalised_score = $real_score / $common_quotient;
		echo ("<p>Website's normalised score = $normalised_score</p>");
	}

}

?>
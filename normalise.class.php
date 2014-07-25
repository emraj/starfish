<?php
/**
* normalise.class.php
* Executes a statistical normalisation for website's age and performance index.
*/

class normalise
{

	public function normalise_age_index($site_age, $index)
    {
    	$real_age = $site_age;
    	$real_index = $index; // Site's real aggregate score. Perfect score is 100%.
  		$normalised_age = 365;
		$common_quotient = $real_age / $normalised_age; // Common quotient derived from cross-multiplication.
		$normalised_index = $real_index / $common_quotient;
	}

}

?>
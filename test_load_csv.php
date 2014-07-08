<?php

        $file = fopen('C:\xampp\htdocs\reef.umiapps.com\wp-content\plugins\starfish\websites.csv', 'r'); 
		while (($line = fgetcsv($file))!== FALSE) {   // $line is an array of the csv elements.
			$blog_id = null;
			$profile_id = null;
			$domain = null;
			if (empty($blog_id)){
				$blog_id = $line;
			}
			else{   // $blog_id not empty.
				if (empty($profile_id)){
					$profile_id = $line;
				}
				else{
					$domain = $line;
				}
			}
			print_r($blog_id);
			echo "<br>";
			print_r($profile_id);
			echo "<br>";
			print_r($domain);
		}

		fclose($file);

?>
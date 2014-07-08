<?php
/**
* blog_ids.class.php gets data from websites.csv file.
*/

#require('domain_age.class.php');

class blog_ids
{
	#public $file;
	#public $line = array();
	public static $blog_id;
	public static $profile_id;
	public static $domain;
	public $mydomain;
	public $myprofile;
	public $position;
	
	public function load_csv()
	{
		global $blog_id;
		global $profile_id;
		global $domain;
		$blog_id = array();
		$profile_id = array();
		$domain = array();
		#$file = fopen('C:\xampp\htdocs\reef.umiapps.com\wp-content\plugins\starfish\websites.csv', 'r'); // Open websites.csv file. It requires full directory (a potential issue).
		$file = fopen(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'websites.csv', 'r'); // Open websites.csv file.
		while (($line = fgetcsv($file))!== FALSE) {   // $line is an array of the csv elements.
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

		}

		fclose($file);
	}

	public function compare($current)
	{
		$current_blog_id = $current;
		global $blog_id;
		global $profile_id;
		global $domain;
		global $position;
		var_dump($blog_id);
		echo "<br>";
		var_dump($profile_id);
		echo "<br>";
		var_dump($domain);
		foreach($blog_id as $id)
		{
			if ($current_blog_id == $id){
				echo ("<br>Match!");
				$position = array_search($id, $blog_id); // Get position of matched blog ID.
				echo ("$position<br>");
				echo ("$profile_id[$position]<br>");
				echo ("$domain[$position]<br>");
			}
			else{
				echo ("Not match!<br>");
			}
		}
	}

	public function get_mydomain()
	{
		global $mydomain;
		global $domain;
		global $position;
		$mydomain = $domain[$position];
		#echo ("The domain $mydomain is <br>");
		#$w = new domain_age();
		#echo $w->age($mydomain);
		#return $w->age($mydomain);
	}

	public function get_myprofile()
	{
		global $myprofile;
		global $profile_id;
		global $position;
		$myprofile = $profile_id[$position];
		return $myprofile;
	}

}

?>
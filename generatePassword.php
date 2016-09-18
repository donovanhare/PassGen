<?php

	function checkUpper($str) { for ($i=0; $i < strlen($str) ; $i++)  if(ctype_upper($str[$i])) return 1; return 0; }
	function checkDigit($str) { for ($i=0; $i < strlen($str) ; $i++) if(ctype_digit($str[$i])) return 1; return 0; }
	
	function generate()
	{
		$maxLength = rand(6, 10);
		$minLength = 6;
		
		$dictLen = 0;
		$accepted = 0;
		$generated = 0;

		$pass = ''; // Dictonary-RAND
		$rand = '';
		$dictPhrase = '';


		$dict = file('words.txt');
		$seed = str_split('abcdefghijklmnopqrstuvwxyz' .'ABCDEFGHIJKLMNOPQRSTUVWXYZ' .'0123456789!@#$%^&*()');
		

		while(!$generated) {
			while(!$accepted) { 
				if($dictLen < $minLength || $dictLen > $maxLength) {
					$dictPhrase = $dict[rand(0,235885)];
					$dictPhrase = substr($dictPhrase, 0, -1);
					$dictLen = strlen($dictPhrase);
				} else {
					$accepted = 1;
				}
			}
			
			shuffle($seed);
			foreach (array_rand($seed, 4) as $x) {		
				$rand .= $seed[$x];
			}
			
			$pass = $dictPhrase . "-" . $rand;
			if ($pass && checkUpper($pass) && checkDigit($pass)) {
				$generated = 1;
			} else {
				$pass = ''; 
				$rand = ''; 
				$accepted = 0; 
			}
			
		}

		echo $pass;
		return 1;
	}

	generate();

?>





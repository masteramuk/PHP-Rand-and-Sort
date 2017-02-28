<?php

$val = array();
$exit = false;

	while (!$exit){
		$val = array();
		//setting the dice first time
		for ($i = 0; $i < 4; $i++){
			for ($j = 0; $j < 6; $j++){
				$val[$i][$j] = rand(1,6);
			}
		};
		
		foreach ($val as $row){
			echo "First Round<br/>" . PHP_EOL;
			print_r($row);
			echo "<br/>" . PHP_EOL;
		}
		
		//all dice with number 6, remove from the array
		$temp = array();
		$y = 0;
		$z = 0;
		foreach ($val as $row){
			for ($x = 0; $x < sizeof($row); $x++){
				if ( $row[$x] != 6 ) {
					$temp[$y] = $row[$x];
					$y++;
				}
			}
			$y = 0;
			$val[$z] = $temp;
			$temp = array();
			$z++;
		}
		
		foreach ($val as $row){
			echo "After Remove 6 Round<br/>" . PHP_EOL;
			print_r($row);
			echo "<br/>" . PHP_EOL;
		}
		
		//move all dice with number 1 to right player
		$temp = array();
		$temp2 = array();
		$tempHold = array(); //to hold 1 from previous array
		$z = 0;
		$i = 0;
		$str = "";
		for($x = 0; $x < sizeof($val); $x++){
			$temp = $val[$x];
			for ($y = 0; $y < sizeof($temp); $y++){
				if ( $temp[$y] == 1 ){ //transfer to temp array
					if ( $x == (sizeof($val) - 1) ){
						$tempHold[0][$i] = $temp[$y];	
						$str = $str . "-0";					
					} else {
						$tempHold[$x+1][$i] = $temp[$y];
						$str = $str . "-" . ($x+1);
					}
					$i++;
					
				} else {
					$temp2[$z] = $temp[$y];
					$z++;
				}
			}
			$i = 0;
			$val[$x] = $temp2;
			$temp2 = array();
		}
		
		//var_dump($tempHold);
		
		$z = 0;
		//transfer all 1 in temphold to correct array
		for ( $x = 0; $x < sizeof($tempHold); $x++) {
			if ( strpos( $str, "". $x ."" ) !== false ){
				$temp = $tempHold[$x];
				for ($y = 0; $y < sizeof($temp); $y++) {
					$val[$x][sizeof($val[$z])+1] = $temp[$y]; 				
				}
			}		
		}
		
		foreach ($val as $row){
			echo "After Transfer 1 Round<br/>" . PHP_EOL;
			print_r($row);
			echo "<br/>" . PHP_EOL;
		}
		
		$x = 1;
		foreach ($val as $row){
			if ( sizeof($row) == 0 ){
				echo "Finally<br/>" . PHP_EOL . "The winner is player: " . $x;				
				echo "<br/>" . PHP_EOL; 
				print_r($row);
				$exit = true;
			}
			$x++;
		}
	}
?>
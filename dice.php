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
		$z = 0;
		for($x = 0; $x < sizeof($val); $x++){
			$temp = $val[$x];
			for ($y = 0; $y < sizeof($temp); $y++){
				if ( $temp[$y] == 1 ){ //transfer to the right player
					if ( $x == (sizeof($val) - 1) ){ //transfer to left most if it is the right most player
						$val[0][sizeof($val[0])] = $temp[$y];
					} else { //transfer to right player
						$val[$x + 1][sizeof($val[$x+1])] = $temp[$y];
					}
				} else {
					$temp2[$z] = $temp[$y];
					$z++;
				}
			}
			$val[$x] = $temp2;
			$temp2 = array();
		}
		foreach ($val as $row){
			echo "After Transfer 1 Round<br/>" . PHP_EOL;
			print_r($row);
			echo "<br/>" . PHP_EOL;
		}
		
		$x = 0;
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
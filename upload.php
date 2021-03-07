<?php
try{


	if ( isset($_POST["submit"]) ) {

	   if ( isset($_FILES["file"])) {

	        if ($_FILES["file"]["error"] > 0) {
	            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";

	        }
	        else {
	                 //if file already exists
	             if (file_exists("upload/" . $_FILES["file"]["name"])) {
	            echo $_FILES["file"]["name"] . " already exists. ";
	             }
	             else {
	                    //Store file in directory "upload" with the name of "uploaded_file.txt"
	            $storagename = "uploaded_file.txt";
	            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $storagename);
	            // echo "Stored in: " . "upload/" . $_FILES["file"]["name"] . "<br />";
	            }
	        }
	     } else {
	             echo "No file selected <br />";
	     }
	}

	if ( isset($storagename) && $file = fopen( "upload/" . $storagename , "r" ) ) {


	    $firstline = fgets ($file, 4096 );
	    $num = strlen($firstline) - strlen(str_replace(";", "", $firstline));

	    $fields = array();
	    $fields = explode( ";", $firstline, ($num+1) );

	    $line = array();
	    $i = 0;

	        $dsatz = array();

	    while ( $line[$i] = fgets ($file, 4096) ) {

	        $rows = explode( ";", $line[$i], ($num+1) );
	        foreach ($rows as $key => $row) {
	        	$dsatz[$i] = explode(",",$row);
	        }
	        
	        $i++;
	    }

	    
        $dstartDate=date_create($_POST["startDate"]);
		$startDate = date_format($dstartDate,"Y-m-d");
		$dendDate=date_create($_POST["endDate"]);
		$endDate = date_format($dendDate,"Y-m-d");

        foreach ($dsatz as $key => $row) {
	                //new table row for every record
	        // echo "<tr>";
	        $currDate = date_create($dsatz[$key][1]);
			$date=date_format($currDate,"Y-m-d");

	        if(strtoupper($dsatz[$key][2]) == strtoupper($_POST["company"]) && $currDate >= $dstartDate && $currDate <=  $dendDate) {
	        	
	        	if(  !isset($buyPrice) || $buyPrice > $dsatz[$key][3]) {
	        		$buyPrice = $dsatz[$key][3];
	        		$buyDate = $currDate;
	        		if(!isset($sellDate)) {
	        			$tempDate = date_create($date);
	        			$nextDay = $tempDate->modify('+1 day');
						$sellDate=date_create(date_format($nextDay,"Y-m-d"));
						$sellPrice = $buyPrice;
	        		}
	        	} 
        		if(isset($sellDate) && $sellDate <= $currDate && $dsatz[$key][3]>= $sellPrice) {
						$sellDate=$currDate;
						$sellPrice = $dsatz[$key][3];
        		}	        		
				
	        }
	        
	    }


	    echo "buyPrice: " . $buyPrice . "</br>";
	    echo "buyDate: " . date_format($buyDate,"Y-m-d") . "</br>";
	    if($sellDate > $buyDate) {
	        	
			echo "sellPrice: " . $sellPrice . "</br>";
	   		echo "sellDate: " . date_format($sellDate,"Y-m-d")  . "</br>";
		} else {
			echo "Buy date is not possible for the given date range with profit/ no loss" . "</br>";
		}

	}


} catch(Exception $e) {
	echo 'Message: ' .$e->getMessage();
}


?>
<?php
	//
	//	API Functions
	//
	///////////////////////////////////
 	require ("db_con.inc");

	function isTokenValid($token, $db){
            $sql = "SELECT * FROM `appWeego`.`Users` WHERE `token` = '".$token."';";
            $query = $db->query($sql);
       
            if($query->rowCount()>0){
                    return TRUE;
            }
            return FALSE;
	}
        
 ?>
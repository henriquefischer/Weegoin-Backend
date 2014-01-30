<?php
	//
	// Event Management v0.1
	//
	///////////////////////////////////////////////////////
        //
        // Decidir: quantos eventos a serem enviados por vez'
        // Input: token, geolocation (?), start
        // Output: Events
        //
 	///////////////////////////////////////////////////////
        require_once("erro.php");
        require_once("resources.php");
        
        if(isTokenValid($_POST['token'], $db)){
            //just for test
            $next = $_POST['next'];

            if(isset($_POST['geolocation'])){
                    //TODO - Função que traz as baladas por geolocalização de proximidade
            }else{
                    // Return order by datetime only
                    $now = new DateTime('NOW');
                    $date = $now->format('Y-m-d H:i:s');
                    $sql = "SELECT * FROM `appWeego`.`Events` WHERE `date`>'".$date."' ORDER BY `date` LIMIT $next,4;";
                    $resp = $db->query($sql);
                    $data = $resp->fetchAll(PDO::FETCH_ASSOC);
                    if($resp->rowCount() > 0){
                        $json = json_encode($data);
                        echo $json;
                    }else{
                        $error = json_error("No more events avaible", 4);
                        echo $error;
                    }
            }
   
        }else{
            $error = json_error("Invalid Token", 2);
            echo $error;
        }

?>
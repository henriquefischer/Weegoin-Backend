<?php
        //
	// Login Management v0.1
	//
	///////////////////////////////////////////////////////
        //
        // Input: Name, idFacebook
        // Output: Events
        //
 	///////////////////////////////////////////////////////
        require_once("erro.php");
        require_once("resources.php");
        
        
        // TODO - Verificar se existe usuario
        // Criar perfil. Pegar definir foto de perfil: Local ou não
        // Criar o login do facebook
        // Criar login proprio: Nome/ aniversario/ e-mail/ senha/ numero do cel
        // 
        
        if(isset($_POST['idFacebook'])){
            $name = $_POST['name'];
            $birthday = $_POST['birthday'];
            $email = $_POST['email'];
            
            
        }else{
            
        }
        
        
        
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
<?php
	//
	// Event Management
	//
	/////////////////////////////////
 	require_once("db_con.inc");
 	require_once("erro.php");

 	//TO-DO Verificar se está logado, caso não travar acesso
 	//$next = $_POST['next'];

 	if(isset($_POST['geolocation'])){
 		//TODO - Função que traz as baladas por geolocalização de proximidade
 	}else{
 		// Return order by datetime only
	 	$now = new DateTime('NOW');
	 	$date = $now->format('Y-m-d H:i:s');
	 	$next = $_POST['next'];
	 	$sql = "SELECT * FROM appWeego.Events WHERE `date`>'".$date."' ORDER BY `date` LIMIT $next,4;";
	 	$resp = $db->query($sql);
	 	$data = $resp->fetchAll(PDO::FETCH_ASSOC);
	 	if($resp->rowCount() > 0){
      		$json = json_encode($data);
     		echo $json;
     	}else{
     		$error = json_error("Não existem mais eventos disponíveis", 4);
     		echo $error;
     	}

	}

 	// TODO - Criar query de requisição dos próximos x eventos
 	// Gerar Array de querry com próximos n eventos
 	// Converter para JSON
 	// Verificar se existem proximos x


?>
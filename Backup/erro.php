<?php
	//
	//	Lista de Erros e tratamento
	//
	///////////////////////////////////
	
	// 4: No more events avaible
        // 2: Invalid Token

	function json_error($str, $erro){
		$array = array(
			'num' => $erro,
			'desc' => $str,
			);
		return json_encode($array); 
	}
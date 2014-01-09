<?php
	//
	//	Lista de Erros e tratamento
	//
	///////////////////////////////////
	
	// 4: Não existem mais eventos disponíveis

	function json_error($str, $erro){
		$array = array(
			'num' => $erro,
			'desc' => $str,
			);
		return json_encode($array); 
	}
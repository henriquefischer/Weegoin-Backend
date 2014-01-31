////////////////////////////////////////////
////
///           Weego.in V1.0
////
////////////////////////////////////////////

Para acessar as funções, utilize do seguinte caminho
index.php/Estrutura/Funçao/Parametros

Sempre você precisa passar o token para receber as informações.

1 - Funções

i - Events:
	list_events():
		Input:$token,$next
		Output: Json com os proximos 4 events a partir de $next

	list_single_event():
		Input:$token,$idEvent
		Output: Json com informações de events

ii - Establishment:
	list_establishment():
		Input:$token, $next
		Output: Json com todos os estabelecimentos
	
	list_single_establishment():
		Input:$token, $idEstablishment
		Output: Json com as informações do estabelecimento $idEstablishment

	list_events_establishment():
		Input: $token, $idEstablishment
		Output: Json com informações sobre as festas que o $idEstablishment possui cadastradas

iii - Users:
	sing_up():
		Input: $name,$password,$profilePhoto,$idFacebook,$facebookToken
		Output: $token de login
      
	login():
		Input: $name,$password
		Output: $token de login

        
       edit_user():
		Input: $token,$name,$password,$idFacebook,$facebookToken
		Output: Confirmação de alteração
     
        go_party():
		Input: $token, $idEvent
		Output: Confirmação de alteração
      
        
        favorite():
		Input: $token,$idEstablishment
		Output: Confirmação de alteração
        
        badges():
		Input: $token
		Output: Lista de badges que o usuario possui        
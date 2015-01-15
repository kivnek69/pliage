<html> 
    <title> Flickr </title>
    
    <body> 
	
	<?php 
	
		/*
		http://flickr.com/services/auth/?api_key=[api_key]&perms=[perms]&api_sig=[api_sig]
		
		secret + 'api_key' + [api_key] + 'perms' + [perms].
		
		compte tweeter:
		Nom d’utilisateur: c_hebdo
		Mot de passe: achrafmechant2015


		compte Flickr:
		nom: charlie
		prenom: hebdo
		nom d’utilisateur: c_hebdo2015
		mot de passe: achrafmechant2015
		
		Clé :
		9dea0bef52359d2b6f7ad561a1b5cbfd
		Secret :
		22b3f18e7a2a1f09	
		
		*/
		
		$secret = '22b3f18e7a2a1f09';
		$api_key ='9dea0bef52359d2b6f7ad561a1b5cbfd';
		//$api_sig  = md5('22b3f18e7a2a1f09') + md5('api_key') + md5('9dea0bef52359d2b6f7ad561a1b5cbfd') + md5('perms') + md5('read');
		//$api_sig  = md5('0112223789aabeff') + md5('api_key') + md5('9dea0bef52359d2b6f7ad561a1b5cbfd') + md5('perms') + md5('read');
		//$api_sig  = md5('0112223789aabeffapi_key9dea0bef52359d2b6f7ad561a1b5cbfdpermsread');
		$chaine  = "0112223789aabeff + 'api_key' + 9dea0bef52359d2b6f7ad561a1b5cbfd + 'perms' + read";
		//$chaine  = "22b3f18e7a2a1f09 + 'api_key' + 9dea0bef52359d2b6f7ad561a1b5cbfd + 'perms' + read";
		$chaine = md5($chaine);
		$url_debut = 'http://www.flickr.com/services/auth/?';
		$url_fin = 'api_key=9dea0bef52359d2b6f7ad561a1b5cbfd&perms=read&api_sig=b0e076a860c7b1e8375c939f32373b28';
		 // echo $api_sig;
		 echo $chaine;
		// http://www.flickr.com/services/auth/?api_key=9dea0bef52359d2b6f7ad561a1b5cbfd&perms=write&api_sig=b0e076a860c7b1e8375c939f32373b28
		 //39806830889
		 //b0e076a860c7b1e8375c939f32373b28
		 //39802830935
		 // b2866d18de758bd86b13ad3848f93795
		 //Etape 5 : Convertir un frob en jeton
		$method = 'flickr.auth.getTokenk';		
		$frob = '72157649889136347-d65bfc282f8cce1e-128910564';
		$api_sig1 = md5('0112223789aabeff')  + md5('api_key') + md5('9dea0bef52359d2b6f7ad561a1b5cbfd') + md5('frob') + md5('185-837403740') + md5('method') + md5('flickr.auth.getToken');
		//$api_sig1 = md5($chaine1);
		//$api_sig1 = '39802893171';
		//$api_sig1 = '89f06cdb160e0861e4723db00095b0af';
		$url =  $url_debut.$url_fin;
		//echo $url;
		//echo $api_sig1;
	?>
        
    </body>
</html>    

  




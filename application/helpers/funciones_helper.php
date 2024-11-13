<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function idiomaPagina()
{
	$ruta = substr($_SERVER['SCRIPT_FILENAME'], 0, strrpos($_SERVER['SCRIPT_FILENAME'], '/'));
	$_SESSION["ruta"] = $ruta.="/";
	//Servidor local
	$_SESSION["rutaservidor"] = "http://".$_SERVER["SERVER_NAME"]."/nosvamosdeviajeci/";
	//Servidor internet
	//$_SESSION["rutaservidor"] = "http://".$_SERVER["HTTP_HOST"]."/";

	//Comprobar idioma del navegador cliente  
	if ($_SERVER['HTTP_ACCEPT_LANGUAGE'] != ''){ 
		// Miramos que idiomas ha definido:
		$idiomas = explode(",", $_SERVER['HTTP_ACCEPT_LANGUAGE']); # Convertimos HTTP_ACCEPT_LANGUAGE en array
		/* Recorremos el array hasta que encontramos un idioma del visitante que coincida con los idiomas en que está disponible nuestra web */
		if (substr($idiomas[0], 0, 2) == "es"){$idioma = 1;}
		else if (substr($idiomas[0], 0, 2) == "en"){$idioma = 2;}
		else if (substr($idiomas[0], 0, 2) == "ca"){$idioma = 3;}
		//else if (substr($idiomas[0], 0, 2) == "eu"){$idioma = 3;}
		//else if (substr($idiomas[0], 0, 2) == "gl"){$idioma = 4;}
		else {$idioma=1;}
	}	

	if (!isset($_SESSION["idiomapagina"]))
	{
		$_SESSION["idiomapagina"]=$idioma;
	}

}

function diaSemana($diaDeSemana)
{
	switch ($diaDeSemana) {
		case 1:
			$diaS=_LUNES; 
			break;
		case 2:
			$diaS=_MARTES;
			break;
		case 3:
			$diaS=_MIERCOLES;
			break;
		case 4:
			$diaS=_JUEVES;
			break;
		case 5:
			$diaS=_VIERNES;
			break;
		case 6:
			$diaS=_SABADO;
			break;
		case 7:
			$diaS=_DOMINGO;
			break;
	}
	return $diaS;
}

function mesAny($mes)
{
	$CI = & get_instance();
	if($mes==1||strcmp($mes,"Enero")==0)
	{
		$mesany=$CI->lang->line('enero');
	}
	else if($mes==2||strcmp($mes,"Febrero")==0)
	{
		$mesany=$CI->lang->line('febrero');
	}
	else if($mes==3||strcmp($mes,"Marzo")==0)
	{
		$mesany=$CI->lang->line('marzo');
	}
	else if($mes==4||strcmp($mes,"Abril")==0)
	{
		$mesany=$CI->lang->line('abril');
	}
	else if($mes==5||strcmp($mes,"Mayo")==0)
	{
		$mesany=$CI->lang->line('mayo');
	}
	else if($mes==6||strcmp($mes,"Junio")==0)
	{
		$mesany=$CI->lang->line('junio');
	}
	else if($mes==7||strcmp($mes,"Julio")==0)
	{
		$mesany=$CI->lang->line('julio');
	}
	else if($mes==8||strcmp($mes,"Agosto")==0)
	{
		$mesany=$CI->lang->line('agosto');
	}
	else if($mes==9||strcmp($mes,"Septiembre")==0)
	{
		$mesany=$CI->lang->line('septiembre');
	}
	else if($mes==10||strcmp($mes,"Octubre")==0)
	{
		$mesany=$CI->lang->line('octubre');
	}
	else if($mes==11||strcmp($mes,"Noviembre")==0)
	{
		$mesany=$CI->lang->line('noviembre');
	}
	else if($mes==12||strcmp($mes,"Diciembre")==0)
	{
		$mesany=$CI->lang->line('diciembre');
	}
	return $mesany;
}

function superindice($numero)
{
	if ($_SESSION['idiomapagina']==1||$_SESSION['idiomapagina']==3)
	{
		$devuelveSuperindice="&ordf;";
	}
	else if ($_SESSION['idiomapagina']==2)
	{
		if ($numero==1)
		{
			$devuelveSuperindice="st";
		}
		else if ($numero==2)
		{
			$devuelveSuperindice="nd";
		}
		else if ($numero==3)
		{
			$devuelveSuperindice="rd";
		}
		else
		{
			$devuelveSuperindice="th";
		}
	}
	else
	{
		if ($numero==1)
		{
			$devuelveSuperindice="st";
		}
		else if ($numero==2)
		{
			$devuelveSuperindice="nd";
		}
		else if ($numero==3)
		{
			$devuelveSuperindice="rd";
		}
		else
		{
			$devuelveSuperindice="th";
		}
	}
	return $devuelveSuperindice;
}

function fecha($dia,$mes,$any,$hora,$diasemana)
{
	if ($_SESSION['idiomapagina']==1)
	{
		$fechadevuelta=diaSemana($diasemana).", ".$dia." de ".mesAny($mes)." del ".$any." a las ".$hora;
	}
	else if ($_SESSION['idiomapagina']==2)
	{
		$fechadevuelta=diaSemana($diasemana).", ".mesAny($mes)." ".$dia." of ".$any." at ".$hora;
	}
	else
	{
		$fechadevuelta=diaSemana($diasemana).", ".mesAny($mes)." ".$dia." of ".$any." at ".$hora;
	}
	return $fechadevuelta;
}

function fechamenu($dia,$mes,$any)
{
	if ($_SESSION['idiomapagina']==1)
	{
		$fechadevuelta=$dia." de ".mesAny($mes)." del ".$any;
	}
	else if ($_SESSION['idiomapagina']==2)
	{
		$fechadevuelta=mesAny($mes)." ".$dia." of ".$any;
	}
	else if ($_SESSION['idiomapagina']==3)
	{
		$particula=" de ";
		if ($mes==4||$mes==8){$particula=" d'";}
		$fechadevuelta=$dia.$particula.mesAny($mes)." del ".$any;
	}
	else
	{
		$fechadevuelta=mesAny($mes)." ".$dia." of ".$any;
	}
	return $fechadevuelta;
}

function diaFinal($mes)
{
	$diaF=31;
	if ($mes==2)
	{
		$diaF=28;
	}
	else if ($mes==4||$mes==6||$mes==9||$mes==11)
	{
		$diaF=30;
	}
	return $diaF;
}

function devolverDia($fecha)
{
	$fechacompleta=explode("-",$fecha);
	$dia=$fechacompleta[2];
	return $dia;
}

function devolverMes($fecha)
{
	$fechacompleta=explode("-",$fecha);
	$mes=$fechacompleta[1];
	return $mes;
}

function devolverAny($fecha)
{
	$fechacompleta=explode("-",$fecha);
	$any=$fechacompleta[0];
	return $any;
}

function devolverFecha($fecha)
{
	$dia=devolverDia($fecha);
	$mes=mesAny(devolverMes($fecha));
	$any=devolverAny($fecha);
	$fechaTraducida=$dia."-".$mes."-".$any;
	return $fechaTraducida;
}

function devolverFechaLista($fecha)
{
    $dia=devolverDia($fecha);
    $mes=devolverMes($fecha);
    $any=devolverAny($fecha);
    $fechaTraducida=$dia."-".$mes."-".$any;
    return $fechaTraducida;
}

function devolverFechaBBDD($fecha)
{
    $fechacompleta=explode("-",$fecha);
    $dia=$fechacompleta[2];
    $fechacompleta=explode("-",$fecha);
    $mes=mesAny($fechacompleta[1]);
    $fechacompleta=explode("-",$fecha);
    $any=$fechacompleta[0];
    $fechaTraducida=$dia."-".$mes."-".$any;
    return $fechaTraducida;
}

function cambiarAcentos($cadena) {
	$long=strlen($cadena);
	$devuelveCadena="";

	for ($x=0;$x<$long;$x++)
	{
//Acento agudo
		if(strcmp($cadena[$x],"á")==0)
		{
			$devuelveCadena=$devuelveCadena."&aacute;";
		}
		else if(strcmp($cadena[$x],"Á")==0)
		{
			$devuelveCadena=$devuelveCadena."&Aacute;";
		}
		else if(strcmp($cadena[$x],"é")==0)
		{
			$devuelveCadena=$devuelveCadena."&eacute;";
		}
		else if(strcmp($cadena[$x],"É")==0)
		{
			$devuelveCadena=$devuelveCadena."&Eacute;";
		}
		else if(strcmp($cadena[$x],"í")==0)
		{
			$devuelveCadena=$devuelveCadena."&iacute;";
		}
		else if(strcmp($cadena[$x],"Í")==0)
		{
			$devuelveCadena=$devuelveCadena."&Iacute;";
		}
		else if(strcmp($cadena[$x],"ó")==0)
		{
			$devuelveCadena=$devuelveCadena."&oacute;";
		}
		else if(strcmp($cadena[$x],"Ó")==0)
		{
			$devuelveCadena=$devuelveCadena."&Oacute;";
		}
		else if(strcmp($cadena[$x],"ú")==0)
		{
			$devuelveCadena=$devuelveCadena."&uacute;";
		}
		else if(strcmp($cadena[$x],"Ú")==0)
		{
			$devuelveCadena=$devuelveCadena."&Uacute;";
		}
//Dieresis
		else if(strcmp($cadena[$x],"ä")==0)
		{
			$devuelveCadena=$devuelveCadena."&auml;";
		}
		else if(strcmp($cadena[$x],"Ä")==0)
		{
			$devuelveCadena=$devuelveCadena."&Auml;";
		}
		else if(strcmp($cadena[$x],"ë")==0)
		{
			$devuelveCadena=$devuelveCadena."&euml;";
		}
		else if(strcmp($cadena[$x],"Ë")==0)
		{
			$devuelveCadena=$devuelveCadena."&Euml;";
		}
		else if(strcmp($cadena[$x],"ï")==0)
		{
			$devuelveCadena=$devuelveCadena."&iuml;";
		}
		else if(strcmp($cadena[$x],"Ï")==0)
		{
			$devuelveCadena=$devuelveCadena."&Iuml;";
		}
		else if(strcmp($cadena[$x],"ö")==0)
		{
			$devuelveCadena=$devuelveCadena."&ouml;";
		}
		else if(strcmp($cadena[$x],"Ö")==0)
		{
			$devuelveCadena=$devuelveCadena."&Ouml;";
		}
		else if(strcmp($cadena[$x],"ü")==0)
		{
			$devuelveCadena=$devuelveCadena."&uuml;";
		}
		else if(strcmp($cadena[$x],"Ü")==0)
		{
			$devuelveCadena=$devuelveCadena."&Uuml;";
		}
//Acento grave
		else if(strcmp($cadena[$x],"à")==0)
		{
			$devuelveCadena=$devuelveCadena."&agrave;";
		}
		else if(strcmp($cadena[$x],"À")==0)
		{
			$devuelveCadena=$devuelveCadena."&Agrave;";
		}
		else if(strcmp($cadena[$x],"è")==0)
		{
			$devuelveCadena=$devuelveCadena."&egrave;";
		}
		else if(strcmp($cadena[$x],"È")==0)
		{
			$devuelveCadena=$devuelveCadena."&Egrave;";
		}
		else if(strcmp($cadena[$x],"ì")==0)
		{
			$devuelveCadena=$devuelveCadena."&igrave;";
		}
		else if(strcmp($cadena[$x],"Ì")==0)
		{
			$devuelveCadena=$devuelveCadena."&Igrave;";
		}
		else if(strcmp($cadena[$x],"ò")==0)
		{
			$devuelveCadena=$devuelveCadena."&ograve;";
		}
		else if(strcmp($cadena[$x],"Ò")==0)
		{
			$devuelveCadena=$devuelveCadena."&Ograve;";
		}
		else if(strcmp($cadena[$x],"ù")==0)
		{
			$devuelveCadena=$devuelveCadena."&ugrave;";
		}
		else if(strcmp($cadena[$x],"Ù")==0)
		{
			$devuelveCadena=$devuelveCadena."&Ugrave;";
		}
//Acento circunflejo
		else if(strcmp($cadena[$x],"â")==0)
		{
			$devuelveCadena=$devuelveCadena."&acirc;";
		}
		else if(strcmp($cadena[$x],"Â")==0)
		{
			$devuelveCadena=$devuelveCadena."&Acirc;";
		}
		else if(strcmp($cadena[$x],"ê")==0)
		{
			$devuelveCadena=$devuelveCadena."&ecirc;";
		}
		else if(strcmp($cadena[$x],"Ê")==0)
		{
			$devuelveCadena=$devuelveCadena."&Ecirc;";
		}
		else if(strcmp($cadena[$x],"î")==0)
		{
			$devuelveCadena=$devuelveCadena."&icirc;";
		}
		else if(strcmp($cadena[$x],"Î")==0)
		{
			$devuelveCadena=$devuelveCadena."&Icirc;";
		}
		else if(strcmp($cadena[$x],"ô")==0)
		{
			$devuelveCadena=$devuelveCadena."&ocirc;";
		}
		else if(strcmp($cadena[$x],"Ô")==0)
		{
			$devuelveCadena=$devuelveCadena."&Ocirc;";
		}
		else if(strcmp($cadena[$x],"û")==0)
		{
			$devuelveCadena=$devuelveCadena."&ucirc;";
		}
		else if(strcmp($cadena[$x],"Û")==0)
		{
			$devuelveCadena=$devuelveCadena."&Ucirc;";
		}
//Letras especiales
		else if(strcmp($cadena[$x],"ã")==0)
		{
			$devuelveCadena=$devuelveCadena."&atilde;";
		}
		else if(strcmp($cadena[$x],"Ã")==0)
		{
			$devuelveCadena=$devuelveCadena."&Atilde;";
		}
		else if(strcmp($cadena[$x],"æ")==0)
		{
			$devuelveCadena=$devuelveCadena."&aelig;";
		}
		else if(strcmp($cadena[$x],"Æ")==0)
		{
			$devuelveCadena=$devuelveCadena."&AElig;";
		}
		else if(strcmp($cadena[$x],"ç")==0)
		{
			$devuelveCadena=$devuelveCadena."&ccedil;";
		}
		else if(strcmp($cadena[$x],"Ç")==0)
		{
			$devuelveCadena=$devuelveCadena."&Ccedil;";
		}
		else if(strcmp($cadena[$x],"ñ")==0)
		{
			$devuelveCadena=$devuelveCadena."&ntilde;";
		}
		else if(strcmp($cadena[$x],"Ñ")==0)
		{
			$devuelveCadena=$devuelveCadena."&Ntilde;";
		}
		else if(strcmp($cadena[$x],"õ")==0)
		{
			$devuelveCadena=$devuelveCadena."&otilde;";
		}
		else if(strcmp($cadena[$x],"Õ")==0)
		{
			$devuelveCadena=$devuelveCadena."&Otilde;";
		}
		else if(strcmp($cadena[$x],"ø")==0)
		{
			$devuelveCadena=$devuelveCadena."&oslash;";
		}
		else if(strcmp($cadena[$x],"Ø")==0)
		{
			$devuelveCadena=$devuelveCadena."&Oslash;";
		}
		else if(strcmp($cadena[$x],"ß")==0)
		{
			$devuelveCadena=$devuelveCadena."&szlig;";
		}
		else if(strcmp($cadena[$x],"ÿ")==0)
		{
			$devuelveCadena=$devuelveCadena."&yuml;";
		}
		else if(strcmp($cadena[$x],"¨Y")==0)
		{
			$devuelveCadena=$devuelveCadena."&Yuml;";
		}
		else if(strcmp($cadena[$x],"ý")==0)
		{
			$devuelveCadena=$devuelveCadena."&yacute;";
		}
		else if(strcmp($cadena[$x],"Ý")==0)
		{
			$devuelveCadena=$devuelveCadena."&Yacute;";
		}
		else if(strcmp($cadena[$x],"þ")==0)
		{
			$devuelveCadena=$devuelveCadena."&thorn;";
		}
		else if(strcmp($cadena[$x],"Þ")==0)
		{
			$devuelveCadena=$devuelveCadena."&THORN;";
		}
//Otros signos
		else if(strcmp($cadena[$x],"¡")==0)
		{
			$devuelveCadena=$devuelveCadena."&cent;";
		}
		else if(strcmp($cadena[$x],"¢")==0)
		{
			$devuelveCadena=$devuelveCadena."&pound;";
		}
		else if(strcmp($cadena[$x],"£")==0)
		{
			$devuelveCadena=$devuelveCadena."&curren;";
		}
		else if(strcmp($cadena[$x],"¤")==0)
		{
			$devuelveCadena=$devuelveCadena."&yen;";
		}
		else if(strcmp($cadena[$x],"©")==0)
		{
			$devuelveCadena=$devuelveCadena."&copy;";
		}
		else if(strcmp($cadena[$x],"®")==0)
		{
			$devuelveCadena=$devuelveCadena."&reg;";
		}
		else if(strcmp($cadena[$x],"º")==0)
		{
			$devuelveCadena=$devuelveCadena."&ordm;";
		}
		else if(strcmp($cadena[$x],"ª")==0)
		{
			$devuelveCadena=$devuelveCadena."&ordf;";
		}
		else if(strcmp($cadena[$x],"µ")==0)
		{
			$devuelveCadena=$devuelveCadena."&micro;";
		}
		else if(strcmp($cadena[$x],"å")==0)
		{
			$devuelveCadena=$devuelveCadena."&aring;";
		}
		else if(strcmp($cadena[$x],"Å")==0)
		{
			$devuelveCadena=$devuelveCadena."&Aring;";
		}
		else if(strcmp($cadena[$x],"°")==0)
		{
			$devuelveCadena=$devuelveCadena."&deg;";
		}
		else if(strcmp($cadena[$x],"·")==0)
		{
			$devuelveCadena=$devuelveCadena."&middot;";
		}
		else if(strcmp($cadena[$x],"€")==0)
		{
			$devuelveCadena=$devuelveCadena."&euro;";
		}
		else if(strcmp($cadena[$x],"¨")==0)
		{
			$devuelveCadena=$devuelveCadena."&uml;";
		}
		else if(strcmp($cadena[$x],"´")==0)
		{
			$devuelveCadena=$devuelveCadena."&acute;";
		}
		else if(strcmp($cadena[$x],"¸")==0)
		{
			$devuelveCadena=$devuelveCadena."&cedil;";
		}
		else if(strcmp($cadena[$x],"Ð")==0)
		{
			$devuelveCadena=$devuelveCadena."&ETH;";
		}
		else if(strcmp($cadena[$x],"ð")==0)
		{
			$devuelveCadena=$devuelveCadena."&eth;";
		}
		else if(strcmp($cadena[$x],"ƒ")==0)
		{
			$devuelveCadena=$devuelveCadena."&fnof;";
		}
		else if(strcmp($cadena[$x],"Š")==0)
		{
			$devuelveCadena=$devuelveCadena."&Scaron;";
		}
		else if(strcmp($cadena[$x],"š")==0)
		{
			$devuelveCadena=$devuelveCadena."&scaron;";
		}
		else if(strcmp($cadena[$x],"ž")==0)
		{
			$devuelveCadena=$devuelveCadena."&#382;";
		}
		else if(strcmp($cadena[$x],"Ž")==0)
		{
			$devuelveCadena=$devuelveCadena."&#381;";
		}
//Signos especiales
		else if(strcmp($cadena[$x],"...")==0)
		{
			$devuelveCadena=$devuelveCadena."&hellip;";
		}
		else if(strcmp($cadena[$x],"¡")==0)
		{
			$devuelveCadena=$devuelveCadena."&iexcl;";
		}		
		else if(strcmp($cadena[$x],"¿")==0)
		{
			$devuelveCadena=$devuelveCadena."&iquest;";
		}		
		else
		{
			$devuelveCadena=$devuelveCadena.$cadena[$x];
		}
	}
	return $devuelveCadena;
}


//Devuelve la dirección IP real del cliente 
function getRealIP()
{
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
   
   return $client_ip;
}

function getRealIP2()
{
   
   if( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' )
   {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
   
      // los proxys van añadiendo al final de esta cabecera
      // las direcciones ip que van "ocultando". Para localizar la ip real
      // del usuario se comienza a mirar por el principio hasta encontrar
      // una dirección ip que no sea del rango privado. En caso de no
      // encontrarse ninguna se toma como valor el REMOTE_ADDR
   
      $entries = split('[, ]', $_SERVER['HTTP_X_FORWARDED_FOR']);
   
      reset($entries);
      while (list(, $entry) = each($entries))
      {
         $entry = trim($entry);
         if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) )
         {
            // http://www.faqs.org/rfcs/rfc1918.html
            $private_ip = array(
                  '/^0\./',
                  '/^127\.0\.0\.1/',
                  '/^192\.168\..*/',
                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/',
                  '/^10\..*/');
   
            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
   
            if ($client_ip != $found_ip)
            {
               $client_ip = $found_ip;
               break;
            }
         }
      }
   }
   else
   {
      $client_ip =
         ( !empty($_SERVER['REMOTE_ADDR']) ) ?
            $_SERVER['REMOTE_ADDR']
            :
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ?
               $_ENV['REMOTE_ADDR']
               :
               "unknown" );
   }
   
   return $client_ip;
}

function ObtenerNavegador($user_agent) {  
     $navegadores = array(  
          'Opera' => 'Opera',  
          'Mozilla Firefox'=> '(Firebird)|(Firefox)',  
          'Galeon' => 'Galeon',  
          'Mozilla'=>'Gecko',  
          'MyIE'=>'MyIE',  
          'Lynx' => 'Lynx',  
          'Netscape' => '(Mozilla/4\.75)|(Netscape6)|(Mozilla/4\.08)|(Mozilla/4\.5)|(Mozilla/4\.6)|(Mozilla/4\.79)',  
          'Konqueror'=>'Konqueror',  
          'Internet Explorer 7' => '(MSIE 7\.[0-9]+)',  
          'Internet Explorer 6' => '(MSIE 6\.[0-9]+)',  
          'Internet Explorer 5' => '(MSIE 5\.[0-9]+)',  
          'Internet Explorer 4' => '(MSIE 4\.[0-9]+)',  
);  
foreach($navegadores as $navegador=>$pattern){  
       if (eregi($pattern, $user_agent))  
       return $navegador;  
    }  
return 'Desconocido';  
}

function obtenerMunicipio($idMunicipio, $soloMunicipio){
	$CI = & get_instance();
	$CI->load->model('MunicipiosModel','MM',true);

	$rowmunicipio = $CI->MM->getMunicipio($idMunicipio);
	$municipio=$rowmunicipio[0]['Municipio'];
	$provincia=$rowmunicipio[0]['Provincia'];

	if ($soloMunicipio){
		return cambiarAcentos($municipio);
	} else {
		return cambiarAcentos($municipio." (".$provincia.")");
	}
	
}
?>
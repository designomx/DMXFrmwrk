<?php

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if (!function_exists("GetSQLValueString")) {
	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
	{
		if (PHP_VERSION < 6) {
			$theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
		}
	
		$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);
	
		switch ($theType) {
			case "text":
				$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
				break;    
			case "long":
			case "int":
				$theValue = ($theValue != "") ? intval($theValue) : "NULL";
				break;
			case "double":
				$theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
				break;
			case "date":
				$theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
				break;
			case "defined":
				$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
				break;
		}
		return $theValue;
	}
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$GLOBALS['normalizeChars'] = array(
	'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
	'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
	'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
	'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
	'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
	'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
	'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f', 'ñ'=>'n', ':'=>'-', ','=>'-',
	';'=>'-', '¡'=>'', '!'=>'', '¿'=>'', '?'=>'', ' '=>'-'
);
 
if (!function_exists("cleanForShortURL")) { 
	function cleanForShortURL($fileName) {
		$fileName2 = str_replace('&', '-and-', $fileName);
		 
		return strtr($fileName2, $GLOBALS['normalizeChars']);
	} 
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/* Elimina recursivamente todos los directorios y archivos que se encuentren dentro del directorio que se le pasa como parámetro*/
function rrmdir($dir) {
   if (is_dir($dir)) {
     $objects = scandir($dir);
     foreach ($objects as $object) {
       if ($object != "." && $object != "..") {
         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
       }
     }
     reset($objects);
     rmdir($dir);
   }
 }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function limit_words($string, $word_limit)
{
		$words = explode(" ", $string);
		return implode(" ", array_splice($words, 0, $word_limit));
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function recordSetToJson($mysql_result) {
	$recordSet = array();
	while($record = mysql_fetch_assoc($mysql_result)) {
		$recordSet[] = $record;
	}
	return json_encode(utf8json($recordSet));
	//return json_encode($recordSet);
}	

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function utf8json($inArray) { 

    static $depth = 0; 

    /* our return object */ 
    $newArray = array(); 

    /* safety recursion limit */ 
    $depth ++; 
    if($depth >= '200') { 
        return false; 
    } 

    /* step through inArray */ 
    foreach($inArray as $key=>$val) { 
        if(is_array($val)) { 
            /* recurse on array elements */ 
            $newArray[$key] = utf8json($val); 
        } else { 
            /* encode string values */ 
            $newArray[$key] = $val; 
        } 
    } 

    /* return utf8 encoded array */ 
    return $newArray; 
} 

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>
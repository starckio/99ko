<?php
/*
 * 99ko CMS (since 2010)
 * http://99ko.org
 *
 * Creator / Developper :
 * helloJo (contact@99ko.org / j.coulet@gmail.com)
 * 
 * Contributors :
 * Frédéric Kaplon (frederic.kaplon@me.com)
 * Florent Fortat (florent.fortat@maxgun.fr)
 *
 */

defined('ROOT') OR exit('No direct script access allowed');

class util{
    
    public static function sort2DimArray($data, $key, $mode){
    	if($mode == 'desc') $mode = SORT_DESC;
    	elseif($mode == 'asc') $mode = SORT_ASC;
    	elseif($mode == 'num') $mode = SORT_NUMERIC;
    	$temp = array();
    	foreach($data as $k=>$v){
			$temp[$k] = $v[$key];
		}
    	array_multisort($temp, $mode, $data);
    	return $data;
    }
	
	public static function cutStr($str, $length, $add = '...'){
		if(mb_strlen($str) > $length) $str = mb_strcut($str, 0, $length).$add;
		return $str;
	}

    public static function strToUrl($str){
    	$str = str_replace('&', 'et', $str);
    	if($str !== mb_convert_encoding(mb_convert_encoding($str,'UTF-32','UTF-8'),'UTF-8','UTF-32')) $str = mb_convert_encoding($str,'UTF-8');
    	$str = htmlentities($str, ENT_NOQUOTES ,'UTF-8');
    	$str = preg_replace('`&([a-z]{1,2})(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i','$1',$str);
    	$str = preg_replace(array('`[^a-z0-9]`i','`[-]+`'),'-',$str);
    	return strtolower(trim($str,'-'));
    }
	
    public static function isEmail($email){
    	if(preg_match("/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,4}$/", $email)) return true;
    	return false;
    }

    public static function sendEmail($from, $reply, $to, $subject, $msg){
    	$headers = "From: ".$from."\r\n";
    	$headers.= "Reply-To: ".$reply."\r\n";
    	$headers.= "X-Mailer: PHP/".phpversion()."\r\n";
    	$headers.= 'Content-Type: text/plain; charset="utf-8"'."\r\n";
    	$headers.= 'Content-Transfer-Encoding: 8bit';
    	if(@mail($to, $subject, $msg, $headers)) return true;
    	return false;
    } 

    public static function getFileExtension($file){
        return substr(strtolower(strrchr(basename($file), ".")), 1);
    }

    public static function scanDir($folder, $not = array()){
    	$data['dir'] = array();
    	$data['file'] = array();
    	foreach(scandir($folder) as $file){
    		if($file[0] != '.' && !in_array($file, $not)){
    			if(is_file($folder.$file)) $data['file'][] = $file;
    			elseif(is_dir($folder.$file)) $data['dir'][] = $file;
    		}
    	}
    	return $data;
    }

    public static function writeJsonFile($file, $data){
        if(@file_put_contents($file, json_encode($data), LOCK_EX)) return true; 
    	return false;
    }

    public static function readJsonFile($file, $assoc = true){
    	return json_decode(@file_get_contents($file), $assoc);
    }

    public static function uploadFile($k, $dir, $name, $validations = array()){
    	if(isset($_FILES[$k]) && $_FILES[$k]['name'] != ''){
    		$extension = mb_strtolower(util::getFileExtension($_FILES[$k]['name']));
    		if(isset($validations['extensions']) && !in_array($extension, $validations['extensions'])) return 'extension error';
    		$size = filesize($_FILES[$k]['tmp_name']);
    		if(isset($validations['size']) && $size > $validations['size']) return 'size error';
    		if(move_uploaded_file($_FILES[$k]['tmp_name'], $dir.$name.'.'.$extension)) return 'success';
    		else return 'upload error';
    	}
    	return 'undefined';
    }

    public static function formatDate($date, $langFrom = 'en', $langTo = 'en'){
    	$date = substr($date, 0, 10);
    	$temp = preg_split('#[-_;\. \/]#', $date);
    	if($langFrom == 'en'){
    		$year = $temp[0];
    		$month = $temp[1];
    		$day = $temp[2];
    	}
    	elseif($langFrom == 'fr'){
    		$year = $temp[2];
    		$month = $temp[1];
    		$day = $temp[0];
    	}
    	if($langTo == 'en') $data = $year.'-'.$month.'-'.$day;
    	elseif($langTo == 'fr') $data = $day.'/'.$month.'/'.$year;
    	return $data;
    }
    
}
?>
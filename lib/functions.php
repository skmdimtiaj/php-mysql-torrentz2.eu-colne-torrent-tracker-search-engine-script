<?php 
/*
Developer: Sk Md Imtiaj
Website: https://www.boysofts.com/
Email: info@boysofts.com
*/

//Fetch external urls GET request
function fetch_url($url, $ref, $user_agent=false) {
   if($user_agent) $user_agent = $user_agent;
   else $user_agent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1';
	//try to use curl first. to send reffrer and browser user agent properly.
	if(function_exists('curl_init')) {
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_REFERER, $ref);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
	        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
	        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);  //use curl_redir_exec when open_basedir is set
	        curl_setopt($ch, CURLOPT_MAXREDIRS,10);
	        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
	        curl_setopt($ch, CURLOPT_HTTPGET, 0);
	        $file = curl_exec($ch);
			curl_close($ch);
	}
	else {
        if(ini_get('allow_url_fopen') == 1 || strtolower(ini_get('allow_url_fopen')) == 'on') {
		$file = @file_get_contents($url);
		if($file == false) {
			$handle = @fopen($url, 'r');
			$file = @fread($handle, 4096);
			@fclose($handle);
			}
	    }	
	}
	if($file != false && $file != '') return $file;
}

/*social network crawler detect*/
function smart_ip_detect_crawler() {
  // User lowercase string for comparison.
  $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
  // A list of some common words used only for bots and crawlers.
  $bot_identifiers = array(
    'telegrambot',
    'facebook',
    'whatsapp',
    'linkedinbot',
	'googlebot'
  );
  // See if one of the identifiers is in the UA string.
  foreach ($bot_identifiers as $identifier) {
    if (strpos($user_agent, $identifier) !== FALSE) {
      return TRUE;
    }
  }
  return FALSE;
}

function get_age($current_timestamp, $db_titmestamp){
	$date1 = new DateTime($db_titmestamp);
	#$date2 = new DateTime();
	$date2 = new DateTime($current_timestamp);
    $interval = $date1->diff($date2);
	
	if($interval->y > 1) { return $interval->y . " years"; }	
	elseif($interval->y == 1) { return $interval->y . " year"; }
	
	elseif($interval->m > 1) { return $interval->m . " months"; }
	elseif($interval->m == 1) { return $interval->m . " month"; }
	
	elseif($interval->d > 1) { return $interval->d . " days"; }
	elseif($interval->d == 1) { return $interval->d . " day"; }
	
	elseif($interval->h > 1) { return $interval->h . " hours"; }
	elseif($interval->h == 1) { return $interval->h . " hour"; }
	
	elseif($interval->i > 1) { return $interval->i . " mins"; }
	elseif($interval->i == 1) { return $interval->i . " min"; }
	
	elseif($interval->i < 1) { return $interval->s . " Sec"; }
}

//get self url.
function selfURL() { 
$s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : ""; 
$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s; 
$port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]); 
return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI']; 
} 

function strleft($s1, $s2) { return substr($s1, 0, strpos($s1, $s2)); }

function random_color_part() {
    return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
}

function random_color() {
    $rand_color = random_color_part() . random_color_part() . random_color_part();
	$rand_color = "#$rand_color;";
	return $rand_color;
}

//taken from wordpress
function utf8_uri_encode( $utf8_string, $length = 0 ) {
    $unicode = '';
    $values = array();
    $num_octets = 1;
    $unicode_length = 0;

    $string_length = strlen( $utf8_string );
    for ($i = 0; $i < $string_length; $i++ ) {

        $value = ord( $utf8_string[ $i ] );

        if ( $value < 128 ) {
            if ( $length && ( $unicode_length >= $length ) )
                break;
            $unicode .= chr($value);
            $unicode_length++;
        } else {
            if ( count( $values ) == 0 ) $num_octets = ( $value < 224 ) ? 2 : 3;

            $values[] = $value;

            if ( $length && ( $unicode_length + ($num_octets * 3) ) > $length )
                break;
            if ( count( $values ) == $num_octets ) {
                if ($num_octets == 3) {
                    $unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]) . '%' . dechex($values[2]);
                    $unicode_length += 9;
                } else {
                    $unicode .= '%' . dechex($values[0]) . '%' . dechex($values[1]);
                    $unicode_length += 6;
                }

                $values = array();
                $num_octets = 1;
            }
        }
    }

    return $unicode;
}

//taken from wordpress
function seems_utf8($str) {
    $length = strlen($str);
    for ($i=0; $i < $length; $i++) {
        $c = ord($str[$i]);
        if ($c < 0x80) $n = 0; # 0bbbbbbb
        elseif (($c & 0xE0) == 0xC0) $n=1; # 110bbbbb
        elseif (($c & 0xF0) == 0xE0) $n=2; # 1110bbbb
        elseif (($c & 0xF8) == 0xF0) $n=3; # 11110bbb
        elseif (($c & 0xFC) == 0xF8) $n=4; # 111110bb
        elseif (($c & 0xFE) == 0xFC) $n=5; # 1111110b
        else return false; # Does not match any model
        for ($j=0; $j<$n; $j++) { # n bytes matching 10bbbbbb follow ?
            if ((++$i == $length) || ((ord($str[$i]) & 0xC0) != 0x80))
                return false;
        }
    }
    return true;
}

//function sanitize_title_with_dashes taken from wordpress
function sanitize($title) {
    $title = strip_tags($title);
    // Preserve escaped octets.
    $title = preg_replace('|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title);
    // Remove percent signs that are not part of an octet.
    $title = str_replace('%', '', $title);
    // Restore octets.
    $title = preg_replace('|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title);

    if (seems_utf8($title)) {
        if (function_exists('mb_strtolower')) {
            $title = mb_strtolower($title, 'UTF-8');
        }
        $title = utf8_uri_encode($title, 200);
    }

    $title = strtolower($title);
    $title = preg_replace('/&.+?;/', '', $title); // kill entities
    $title = str_replace('.', '-', $title);
    $title = preg_replace('/[^%a-z0-9 _-]/', '', $title);
    $title = preg_replace('/\s+/', '-', $title);
    $title = preg_replace('|-+|', '-', $title);
    $title = trim($title, '-');

    return $title;
}

function get_include_contents($filename) {
    if (is_file($filename)) {
        ob_start();
        include $filename;
        return ob_get_clean();
    }
    return false;
}


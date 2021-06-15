<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Change empty fields of an array to NULL
 * This work is to prepare data to insert or to update the database without error of invalid format data
 */
function empty_fields_to_null(&$data) {
	try {
		if(is_array($data)) {
			foreach($data as &$item) {
				if(trim($item) == '') {
					$item = NULL;	
				}	
			}
		} else {
			if(trim($data) == '') {
				$data = NULL;	
			}
		}
	}
	catch(Exception $e) {}
}

/**
 * Remove empty element from an array
 * This work is to prepare data to insert or to update the database without error of invalid format data
 *
 */
function remove_empty_fields($array, $fields = array()){
	try {
		if(is_array($array) && count($array) > 0) {
			if(is_array($fields) && count($fields) > 0) {
				foreach($fields as $field) {
					if($array[$field] == NULL || trim($array[$field]) == '') {
						unset($array[$field]);	
					}	
				}	
			} else {
				foreach($array as $key => $value)	{
					if(trim($value) == '') {
						unset($array[$key]);	
					}	
				}
			}
		} else {
			$array = array();	
		}
	}
	catch(Exception $e) {
		$array = array();	
	}
	return $array;
}

/**
 * Change date format
 *
 */
function change_date_format(&$dateString, $oldFormat = 'd/m/Y', $newFormat = 'Y-m-d') {
	try {
		if($dateString) {
			$myDateTime = DateTime::createFromFormat($oldFormat, $dateString);
			$dateString = $myDateTime->format($newFormat);	
		}
	}
	catch(Exception $e) {
			
	}
}

/**
 * Upload file
 *
 */
function upload_file($name, $oldName,$path) {
	try {
		$fileName = $_FILES[$name]['name'];
		if($fileName == '' && $oldName != ''){
			$fileName = $oldName;
		}
		else{
			$rand = rand(100000000,999999999);
			$fileName = prepare_filename_text($rand . $fileName);
			$path = $path . $fileName;
			$upload = upload($name, $path);
		}
		if($upload) {
			return $fileName; 
		} else {
			return FALSE;
		}
	}
	catch(Exception $e) {
		return FALSE;	
	}
}

/**
 * Upload file
 *
 */
function upload($fileName, $path){
	try {
		if(copy($_FILES[$fileName]['tmp_name'], $path)) {
			return TRUE;
		}
		if(move_uploaded_file($_FILES[$fileName]['tmp_name'], $path)) {
			return TRUE;	
		}
		return FALSE;
	}
	catch(Exception $e) {
		return FALSE;	
	}
}

/**
 * Prepare file name
 *
 */
function prepare_filename_text($string){
	// remove all characters that aren't a-z, 0-9, dash, underscore or space
	$NOT_acceptable_characters_regex = '#[^-a-zA-Z0-9_.]#';
	$string = preg_replace($NOT_acceptable_characters_regex, '', $string);
	// remove all leading and trailing spaces
	$string = trim($string); 
	// change all dashes, underscores and spaces to dashes
	$string = preg_replace('#[-_ ]+#', '-', $string); 
	// return the modified string
	return $string;
}

/**
 * Get POST, GET values
 *
 */
function get_var($var){
	if(isset($_POST[$var])) {
		if(is_array($_POST[$var])) {
			return $_POST[$var];	
		}	else {
			return trim($_POST[$var]);	
		}
	}	else if(isset($_GET[$var])) {
		if(is_array($_GET[$var])) {
			return $_GET[$var];	
		} else {
			return trim($_GET[$var]);	
		}
	}	else {
		return '';	
	};
}

/**
 * JSON response for AJAX request
 *
 */
function json_response($data){
	if(is_array($data) && !empty($data)) {
		echo json_encode($data);	
	}	else {
		echo json_encode(array('resultCode' => 'error', 'message' => 'Response error'));	
	}
	exit();
}

/**
 * Canculate distance by latitude and longitude
 *
 */
function distance($lat1, $lng1, $lat2, $lng2, $miles = FALSE) {
	$pi80 = M_PI / 180;
	$lat1 *= $pi80;
	$lng1 *= $pi80;
	$lat2 *= $pi80;
	$lng2 *= $pi80;
	 
	$r = 6372.797; // mean radius of Earth in km
	$dlat = $lat2 - $lat1;
	$dlng = $lng2 - $lng1;
	$a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) * cos($lat2) * sin($dlng / 2) * sin($dlng / 2);
	$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
	$km = $r * $c;
	 
	return ($miles ? ($km * 0.621371192) : $km);
}

/**
 * Redirect
 *
 */
function fn_redirect($url) {
	if (headers_sent()) {
		echo "<script>document.location.href='$url';</script>\n";
	}
	else {
		session_write_close();
		header( "Location: ". $url );
	}
	exit();
}

/**
 * Soap request
 *
 */
function soap_request($sendUrl, $function, $params) {
	$client = new SoapClient($sendUrl);
	$result = $client->$function($params);
	return $result;
}

/**
 * Get random string
 *
 */
function get_random_string($length = 30) {
	$code = md5(uniqid(rand(), TRUE));
	return substr($code, 0, $length);
}

/**
 * Check required fields
 *
 */
function check_required_fields($data = array(), $fields = array()) {
	if(is_array($data) && count($data) > 0) {
		if(is_array($fields) && count($fields) > 0) {
			foreach($fields as $field) {
				if(!isset($data[$field]) || trim($data[$field]) == '') {
					return FALSE;	
				}
			}
			return TRUE;
		} else {
			return TRUE;	
		}	
	} else {
		return FALSE;	
	}
}

/**
 * Get all months
 *
 */
function get_all_months(){
	return array(
		'1' => 'January',
		'2' => 'February',
		'3' => 'March',
		'4' => 'April',
		'5' => 'May',
		'6' => 'June',
		'7' => 'July',
		'8' => 'August',
		'9' => 'September',
		'10' => 'October',
		'11' => 'November',
		'12' => 'December'
	);	
}

/**
 * Get all years
 *
 */
function get_years() {
	$arr = array();
	for($i = 2011; $i <= 2030; $i ++) {
		$arr[$i] = $i;
	}
	return $arr;
}

/**
 * Get all days
 *
 */
function get_all_days() {
	$arr = array();
	for($i = 1; $i <= 31; $i ++) {
		$arr[$i] = $i;	
	}
	return $arr;
}

/**
 * Generate dropdown list
 *
 */
function get_select_object($arr, $selected = '', $k = '', $v = ''){
	$str = '';
	$cnt = 0;
	if($k == '' && $v == '') {
		foreach($arr as $key => $value) {
			if($selected == $key)
				$slt = ' selected="selected" ';
			else $slt = '';
			$str .= '<option value="' . $key . '" ' . $slt . '>' . $value . '</option>';
		}
	}	else {
		$cnt = count($arr);
		for($i=0; $i<$cnt; $i++) {
			$row = $arr[$i];
			if($selected == $row[$k])
				$slt = ' selected="selected" ';
			else $slt = '';
			$str .= '<option value="' . $row[$k] . '" ' . $slt .'>' . $row[$v] . '</option>';
		}
	}
	return $str;
}

/**
 * Prepare text for searching
 *
 */
function prepare_search_text($str) 
{
	if(!$str) {
		return '';
	}
	
	$utf8 = array(
		'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
		'd'=>'đ|Đ',
		'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
		'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
		'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
		'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
		'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
	);
	
	foreach ($utf8 as $ascii => $uni) {
		$str = preg_replace("/($uni)/i",$ascii,$str);
	}
	
	return trim(strtolower($str));
}

/**
 * Set value to fields in the form
 *
 */
function field_value($data, $field, $default = '') {
	$value = trim($default);
	
	if (is_array($data) && isset($data[$field])) {
		$value = $data[$field];	
	} else if (is_object($data) && isset($data->$field)) {
		$value = $data->$field;	
	}
	
	echo $value;
}

/**
 * Get value of an element in array
 *
 */
function get_value($data, $field, $default = '') {
	$value = trim($default);
	
	if (is_array($data) && isset($data[$field])) {
		$value = $data[$field];	
	} else if (is_object($data) && isset($data->$field)) {
		$value = $data->$field;	
	}
	
	return $value;
}

/**
 * Echo value of an element in array
 *
 */
function set_value($data, $field, $default = '') {
	$value = trim($default);
	
	if (is_array($data) && isset($data[$field])) {
		$value = $data[$field];	
	} else if (is_object($data) && isset($data->$field)) {
		$value = $data->$field;	
	}
	
	echo $value;
}

/**
 * Check if an variable is not NULL and blank
 * @param string $var The variable to check
 * @return boolean
 */
function has_value($var) {
	if ($var === '' || $var === NULL) {
		return FALSE;
	} else {
		return TRUE;
	}
}

/**
 * Get pairs of fields to use in select box
 *
 */
function get_pairs($data, $value, $text) 
{
	$return = array();
	
	if (!is_array($data) || count($data) < 1) {
		return array();	
	} else {
		foreach ($data as $item) {
			if (is_array($item) && count($item) > 0) {
				if (isset($item[$value]) && isset($item[$text])) {
					$return[$item[$value]] = $item[$text];	
				}
			} else if (is_object($item) && count($item) > 0) {
				if (isset($item->$value) && isset($item->$text)) {
					$return[$item->$value] = $item->$text;	
				}
			} else {
				return array();	
			}
		}
		
		return $return;	
	}
}

/**
 * Get a part of unicode text by limit number
 *
 */
function process_long_text(&$text, $limit = 20) {
	if (mb_strlen($text, 'UTF-8') > $limit) {
		$text = mb_substr($text, 0, $limit, 'UTF-8') . '...';
	}
}

/**
 * Process textarea content. Keep the break line
 *
 */
function process_textarea_content(&$text) {
	$text = str_replace("\r\n", '<br>', $text);
	$text = str_replace("\r", '<br>', $text);
	$text = str_replace("\n", '<br>', $text);
}

/**
 * Change the date value to VN date format
 *
 */
function format_date_as_vn(&$date) {
	$date = date('d-m-Y', strtotime($date));
}

/**
 * Fully merge arrays. Using for indexed arrays
 *
 */
function full_merge_arrays($arr1, $arr2) {
	if (!is_array($arr1) || !is_array($arr2)) {
		return FALSE;	
	} elseif (count($arr1) < 1 || count($arr2) < 1) {
		return FALSE;
	} else {
		foreach ($arr2 as $value)	{
			array_push($arr1, $value);	
		}
	}
	return $arr1;
}

/**
 * Strip all PHP, XML, HTML tags of input text
 *
 */
function strip_tags_text(&$data, $keys = array()) {
	if (!is_array($data)) {
		$data = strip_tags($data);	
	} elseif ($keys == 'all') {
		if (count($data) > 0) {
			foreach ($data as &$value) {
				$value = strip_tags($value);	
			}	
		}
	} else {
		if (is_array($keys) && count($keys) > 0) {
			foreach ($keys as $key) {
				if (isset($data[$key])) {
					$data[$key] = strip_tags($data[$key]);	
				}	
			}	
		}	
	}
}

/**
 * Get elements in an array as an array
 * @param
 * @return array
 */
function get_elements_as_array($data, $field, $acceptEmpty = FALSE) {
	$return = array();
	if (is_array($data) && count($data) > 0) {
		foreach ($data as $row) {
			$value = get_value($row, $field);
			if (!$acceptEmpty) {
				if (has_value($value)) {
					$return[] = $value;
				}
			} else {
				$return[] = $value;
			}
		}
	}
	return $return;
}

<?php 
class Regex_model extends CI_Model {

	#function to see if passwords has at least 1 letter, number and special character
	function password_regex($str){
		return preg_match("/^(?=.*[\d])(?=.*[!@#$%^&*])(?=.*[a-zA-Z])[\w!@#$%^&*]{8,72}$/", $str ) == 0 ? FALSE : TRUE;
	}
}
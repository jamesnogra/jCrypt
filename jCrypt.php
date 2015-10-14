<?php

	/**
	 * jCrypt is a simple encryption - decryption for PHP strings
	 * Custom keys passed during initialization must be at maximum 32 characters
	 * Encrypted strings are base64_encoded thus can be safely stored
	 * Base64 option is also ON by default but can be turned off during class initialization
	 * isMatch(str1, str2) is provided to compare a plain string and encrypted string
	 * Uses PHP mcrypt
	 */

	class jCrypt {
		
		private $_salt = "nZA29p0UbKDarCgW0WV4afbUYsNujuT5";
		private $_base_64;
		
		public function __construct($new_salt = null, $base_64 = true) {
			if (isset($new_salt)) {
				if (strlen($new_salt) <= 32) {
					$this->_salt = $new_salt;
				} 
			}
			$this->_base_64 = $base_64;
		}
		
		/**
		 * Checks if a encrypted string is the same as the plain text
		 * Param: Encrypted String and a Plain String (positions interchangeable)
		 * Return: Boolean
		 */
		public function isMatch($str1, $str2) {
			if ($this->jDecrypt($str1) == $str2) { return true; }
			if ($this->jDecrypt($str2) == $str1) { return true; }
			return false;
		}
		
		function jEncrypt($str) {
			$temp_enc = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->_salt, $str, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND));
			if ($this->_base_64) {
				return base64_encode($temp_enc);
			}
			return $temp_enc;
		}
		
		function jDecrypt($str) {
			if ($this->_base_64) {
				$str = base64_decode($str);
			}
			return mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->_salt, $str, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND));
		}
		
	}

?>
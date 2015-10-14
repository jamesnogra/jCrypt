# jCrypt
jCrypt is a simple PHP string encryption - decryption algorithm.

Usage 1: Using the default salt with base64 encoding
$p1 = new jCrypt();
$plain_text = "123mypassword";
$encrypted_text = $p1->jEncrypt($plain_text);
$decrpted_text = $p1->jDecrypt($encrypted_text);
//$encrypted_text is the encrpted version of $plain_text and $decrypted_text
//$decrpted_text is just the same with $plain_text but was encrpted first then decrypted back
$p1->isMatch($encrypted_text, $decrpted_text); //returns true
$p1->isMatch($decrpted_text, $encrypted_text); //returns true
$p1->isMatch($decrpted_text, $plain_text); //returns false

Usage 2: Using the default salt but without base64 encoding
$p2 = new jCrypt(null, false);
//usage is still the same but the encrypted results are not base64 encoded

Usage 3: Using your own salt but with base64 encoding
$p3 = new jCrypt("this-is-my-own-salt-123");
//salt must be less than or equal to 32 characters in length
//usage is still the same

Usage 4: Using your own salt without base64 encoding
$p4 = new jCrypt("MEOW-salt-123", false);
//usage is still the same but the encrypted results are not base64 encoded

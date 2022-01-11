<?php 
//Database IP server
define("DB_HOST","localhost");

//Database name
define("DB_NAME", "database");

//Database user
define("DB_USERNAME", "root");

//Database user's password
define("DB_PASSWORD", "");

//Character encoding
define("DB_ENCODE","utf8");

//Project Name
define("PROJECT_NAME", "");

/* APP SETUP */
define('APP_LANGUAGE', 'en');

/*Email SMTP data*/
define("EMAIL_ACCOUNT","user@test.com");

define("EMAIL_HOST","smtp.gmail.com");

define("EMAIL_PASSWORD","");

//IS DEVELOPMENT ENVIROMENT

define('DEV_ENV', true);

//Encryption key
define("ENCRYPT_KEY", '');

define("DIRECTORY", $_SERVER['DOCUMENT_ROOT']);
//Check if current server has server ssl activated
$isSecure = false;
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $isSecure = true;
}
$protocol = $isSecure ? 'https://' : 'http://';
define('IS_SECURE', $isSecure);
define('REQUEST_PROTOCOL', $protocol);
define('SITE_URL', REQUEST_PROTOCOL . $_SERVER['HTTP_HOST']);
?>
<?php
    
if (!ini_get('date.timezone')) {
    ini_set('date.timezone', 'UTC');
}
require '../icons/vendor/autoload.php';
$argv = array(
    '--configuration', '../icons/phpunit.xml'
);
$_SERVER['argv'] = $argv;


PHPUnit_TextUI_Command::main(false);

$homeDir = '/var/www/';
// Set these to what you require

// Path to PHPUnit_Html or null if include path 
$config['phpunit_html'] = $homeDir.'public/test/';

// Path to PHPUnit or null if include path (ie. /usr/local/php/PEAR/PHPUnit/)
$config['phpunit'] =  $homeDir.'/icons/vendor/autoload.php';
$config['configuration'] = $homeDir.'/icons/phpunit.xml';
//require($config['phpunit_html'].'html/src/main.php');


?>


<?php

//Username and password for authentication
$username = 'rock';
$password = 'roll';

if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) || ($_SERVER['PHP_AUTH_USER'] != $username) || ($_SERVER['PHP_AUTH_PW'] != $password) ) {
  //The username or password are incorrect so send the authentication headers
  header('HTTP/1.1 401 Unauthorized');
  header('WWW-Authenticate:Basic realm="Guitar Wars"');
  exit('<h2>Guitar Wars</h2><p>Sorry you must enter a username and password to access this page.');
}

?>
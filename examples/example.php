<?php
/* Inclue PostRequest class */
require_once('../src/post_request.php');

/* Create PostRequest instance */
$postRequest = new PostRequest();

/* Set data to be sent */
$postRequest->setData(array(
	'username'	=> 'johndoe',
	'message'	=> 'hello world!'
));

/* Send POST request to endpoint */
$response = $postRequest->send('http://risanbagja.com');
var_dump($response);

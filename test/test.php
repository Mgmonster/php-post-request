<?php
/* Include PostRequest class */
require_once('../src/post_request.php');

/* 
 * Create PostRequest object without any argument.
 * It should be valid since our constructor allow it
 */
$postRequest = new PostRequest();

/* 
 * Call setData method with an invalid argument.
 * It should be thrown an exception since setData() method only accept
 * an array.
 */
try {
	$postRequest->setData('invalid');
} catch(Exception $e) {
	print($e->getMessage());
}

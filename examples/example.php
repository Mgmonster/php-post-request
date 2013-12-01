<?php
/* Inclue PostRequest class */
require_once('../src/post_request.php');

/* Create PostRequest object without any argument */
$postRequest = new PostRequest();

/* Call setData method with an invalid argument */
$postRequest->setData('invalid');

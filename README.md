# PostRequest Class

### A simple PHP class to send HTTP POST request programmatically

Rather than using a quite complicated PHP cURL extention, this class shows how to combine `file_get_contents()` and `stream_context_create()` functions to send HTTP POST request.

How To

```php
/* Inclue PostRequest class */
require_once('path/to/post_request.php');

/* Create PostRequest instance */
$postRequest = new PostRequest();

/* Set data to be sent */
$postRequest->setData(array(
	'username'	=> 'johndoe',
	'password'	=> 'foobar'
));

/* Send POST request to endpoint */
$response = $postRequest->send('http://yoururl.com');
var_dump($response);
```

***

Get in touch with me:

- [My Twitter Account @risanbagja](https://twitter.com/risanbagja)
- [Hire me on oDesk!](https://www.odesk.com/users/~01b5bcf5e8e7b05df5)

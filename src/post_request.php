<?php
/**
 * PostRequest is a simple class to send HTTP POST request
 *
 * Rather than using a quite complicated PHP CURL extention, this class shows
 * how to combine file_get_contents() and stream_context_create() functions
 * to send HTTP POST request.
 *
 * @author Risan Bagja Pradana <risanbagja@yahoo.com>
 */
class PostRequest
{
    /* Declare constants for error messages and its code number */
    const E_DATA_NOT_SET_ID = 0;
    const E_DATA_NOT_SET_MSG = "'data' parameter is not set.";
    const E_DATA_NOT_ARRAY_ID = 1;
    const E_DATA_NOT_ARRAY_MSG = "'data' parameter should be an array.";
    const E_DATA_ZERO_LENGTH_ARRAY_ID = 2;
    const E_DATA_ZERO_LENGTH_ARRAY_MSG = "'data' parameter should at least contains one item.";
    const E_DATA_NON_ASSOC_ARRAY_ID = 3;
    const E_DATA_NON_ASSOC_ARRAY_MSG = "'data' parameter should be an associative array.";
    const E_URL_NOT_VALID_ID = 4;
    const E_URL_NOT_VALID_MSG = "The given 'url' parameter is invalid.";
    const E_URL_WITHOUT_PROTOCOL_ID = 5;
    const E_URL_WITHOUT_PROTOCOL_MSG = "The given 'url' parameter has not protocol defined.";


    /* HTTP header constants declaration */
    const HTTP_METHOD = 'POST';
    const HTTP_HEADER = "Content-type: application/x-www-form-urlencoded\r\n";


    /**
     * Array which contain data to be sent in POST request
     *
     * @var array
     * @access private
     */
    private $data = null;


    /**
     * Class constructor
     * 
     * @param mixed
     *
     * @return object An object of PostRequest class
     *
     * @access public
     */
    public function __construct($data = null)
    {
        /*
         * If the argument being passed is not null, assume that this is an 
         * array that contains the data to be sent in POST request
         */
        if (!is_null($data)) $this->setData($data);
    }


    /**
     * Set the data which would be sent along with POST request
     *
     * @param array $data An array which contain data to be sent along in POST
     *                    request. Note that the array should be associative 
     *                    array.
     *
     * @return void Simply set private $data class attribute
     *
     * @access public 
     */
    public function setData($data)
    {
        $this->validateData($data);
        $this->data = $data;
    }


    /**
     * Send POST request to specified URL
     *
     * @param string $url A valid URL where we are send HTTP POST request to
     *
     * @return mixed
     *
     * @access public 
     */
    public function send($url)
    {
        /* If data is still null, we assume it is not set */
        if (is_null($this->data)) {
            throw new Exception(self::E_DATA_NOT_SET_MSG,
                self::E_DATA_NOT_SET_ID);
        }

        /* If given URL is invalid */
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            throw new Exception(self::E_URL_NOT_VALID_MSG,
                self::E_URL_NOT_VALID_ID);
        }

        /* Prepare HTTP header */
        $options = array(
            'http'  => array(
                'header'    => self::HTTP_HEADER,
                'method'    => self::HTTP_METHOD,
                'content'   => http_build_query($this->data)
            )
        );

        /* Create stream context resource */
        $context = stream_context_create($options);

        /* Finaly send request */
        return @file_get_contents($url, false, $context);
    }


    /**
     * Validate whether user has set a valid data
     *
     * @param array $data An array which contain data to be sent along in POST
     *                    request. Note that the array should be associative 
     *                    array.
     *
     * @return void
     *
     * @access public 
     */
    private function validateData($data)
    {
        /* If data being passed is not an array, it will thrown an exception */
        if (!is_array($data)) {
            throw new Exception(self::E_DATA_NOT_ARRAY_MSG, 
                self::E_DATA_NOT_ARRAY_ID);
        }

        /* If data being passed is has no items, it will thrown an exception */
        if (count($data) <= 0) {
            throw new Exception(self::E_DATA_ZERO_LENGTH_ARRAY_MSG, 
                self::E_DATA_ZERO_LENGTH_ARRAY_ID);
        }

        /* 
         * If data being passed is a non-associative array, it will thrown an 
         * exception 
         */
        if (count(array_filter(array_keys($data), 'is_string')) != count($data)) {
            throw new Exception(self::E_DATA_NON_ASSOC_ARRAY_MSG, 
                self::E_DATA_NON_ASSOC_ARRAY_ID);
        }
    }
}
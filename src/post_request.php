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
    /**
     * Array which contain data to be sent in POST request
     *
     * @var array
     * @access private
     */
    private $data;

    /**
     * Class constructor
     * 
     * @param mixed
     *
     * @return object An object of PostRequest class
     *
     * @access public
     */
    public function __construct($data)
    {
        /*
         * If there is an argument passed, assume that this is an array that 
         * contains the data to be sent in POST request
         */
        if (isset($data)) $this->setData($data);
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
        $this->data = $data;
    }
}
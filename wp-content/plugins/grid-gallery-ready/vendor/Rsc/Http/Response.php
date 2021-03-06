<?php

/**
 * Class Rsc_Http_Response
 * Controller's response
 *
 * @package Rsc\Http
 * @author Artur Kovalevsky
 * @copyright Copyright (c) 2014, ReadyShoppingCart
 * @link http://readyshoppingcart.com/
 */
class Rsc_Http_Response
{

    const AJAX = 'ajax';

    /**
     * @var string
     */
    public $content;

    /**
     * Creates the new response for chaining methods
     * @return Rsc_Http_Response
     */
    public static function create()
    {
        return new self;
    }

    /**
     * Sets the content of the response
     * @param string $content
     * @return Rsc_Http_Response
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * Returns the content of the response
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
} 
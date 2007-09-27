<?php
/**
 * File containing the ezcWebdavDisplayInformation struct.
 *
 * @package Webdav
 * @version //autogentag//
 * @copyright Copyright (C) 2005-2007 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 */
/**
 * Display information.
 *
 * Used by {@link ezcWebdavTransport} to transport information on displaying a
 * response to the browser.
 *
 * @version //autogentag//
 * @package Webdav
 * @copyright Copyright (C) 2005-2007 eZ systems as. All rights reserved.
 * @license http://ez.no/licenses/new_bsd New BSD License
 */
abstract class ezcWebdavDisplayInformation
{
    
    /**
     * Creates a new struct.
     * 
     * @param ezcWebdavResponse $response 
     * @param DOMDocument|string|null $body 
     * @return void
     */
    public function __construct( ezcWebdavResponse $response, $body )
    {
        $this->response = $response;
        $this->body     = $body;
    }

    /**
     * Response object to extract headers from.
     * 
     * @var ezcWebdavResponse
     */
    public $response;

    /**
     * Representation of the response body.
     * Contents overwritten in extending structs.
     * 
     * @var DOMDocument|sring|null
     */
    public $body;
}

?>

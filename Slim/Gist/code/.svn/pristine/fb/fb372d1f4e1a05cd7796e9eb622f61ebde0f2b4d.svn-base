<?php

namespace App\Controllers;

use Quill\Factories\ServiceFactory;

/**
 * Test Controller to be used for testiung purposes.
 * 
 * @package App\Controllers
 * @author Pankil Joshi <pankil@prologictechnologies.in>
 * @version 1.0
 * @uses Quill\Factories\ServiceFactory
 */
class TestController extends BaseController{

    function __construct($app) {
        
        parent::__construct($app);
        
        $this->services = ServiceFactory::boot(array('Apns'));
    }

}
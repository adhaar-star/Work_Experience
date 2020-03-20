<?php

namespace App\Controllers\Web;

use Quill\Factories\CoreFactory;
//use Quill\Factories\ServiceFactory;
use Quill\Factories\ModelFactory;

class AdminBaseController extends  \App\Controllers\BaseController{
    
    function __construct($app = NULL) {

        parent::__construct($app);
        
         \Quill\View::share(array(
            'app' => $this->app->config(),
            'data' => array(
                'base_url' => $this->app->config('base_url'),
                'base_admin_url' => $this->app->config('base_admin_url'),
                'base_assets_url' => $this->app->config('base_assets_url'),
                'base_assets_admin_url' => $this->app->config('base_assets_admin_url')
            )
        ));
        
        if(!isset($_SESSION['user_data']) && !isset($_SESSION['user_data']['id'])) {
            session_destroy();
            $this->slim->redirect($this->app->config('base_url') . 'admin/');
        }
        
    }    
}




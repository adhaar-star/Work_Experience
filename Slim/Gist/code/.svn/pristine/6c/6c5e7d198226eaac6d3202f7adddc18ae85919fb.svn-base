<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController as BaseController;
use Quill\Exceptions\BaseException;
use Quill\Factories\ModelFactory;

class WebBaseController extends BaseController {

    function __construct($app = NULL) {

        parent::__construct($app);

//        $this->models = ModelFactory::boot(array('Timezone', 'Countries'));

        // all the timezone list
//        $timezones = $this->models->timezone->getTimezone();

        // all the countries list with phone code
//        $countries = $this->models->countries->getCountries();

        \Quill\View::share(array(
            'app' => $this->app->config(),
            'data' => array(
                'base_url' => $this->app->config('base_url'),
                'base_admin_url' => $this->app->config('base_admin_url'),
                'base_assets_url' => $this->app->config('base_assets_url'),
                'base_assets_admin_url' => $this->app->config('base_assets_admin_url'),
//                'timezones' => $timezones,
//                'countries' => $countries
            )
        ));
    }

}

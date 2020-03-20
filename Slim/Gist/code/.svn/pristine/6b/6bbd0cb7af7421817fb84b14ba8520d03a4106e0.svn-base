<?php

namespace App\Controllers\Web;

use Quill\Factories\CoreFactory;
use Quill\Factories\ModelFactory;

class CandidateController extends \App\Controllers\Web\PublicBaseController {

    function __construct($app = NULL) {

        parent::__construct($app);

        $this->models = ModelFactory::boot(array('User','Candidate'));
        $this->core = CoreFactory::boot(array('Response', 'Http', 'View'));
        $this->services = ServiceFactory::boot(array('Jwt'));
    }
    public function register() {
    $request = $this->jsonRequest;
    print_r($request);die;
    }

   } 
<?php

namespace App\Controllers\Web;

use Quill\Factories\ModelFactory;
use Quill\Exceptions\BaseException;

use Quill\MysqlPdo as MysqlPdo;

class AccountBaseController extends \App\Controllers\Web\WebBaseController {

    function __construct($app = NULL) {

        parent::__construct($app);

        $this->models = ModelFactory::boot(array('User'));
        
        $objDB = new MysqlPdo();
                                
        $this->models->user->setPDOConnection($objDB);
       
        if (empty($_COOKIE['token'])) {
            
            $path = $app->slim->request()->getPathInfo();
            $this->slim->redirect($this->app->config('base_url') . 'candidate/login?redirect=' . substr($path, 1));
        } else {

            $token = $_COOKIE['token'];
            
            $signer = new \Lcobucci\JWT\Signer\Rsa\Sha256();

            $token = (new \Lcobucci\JWT\Parser())->parse((string) $token); // Parses from a string

            $_SERVER['HTTP_TOKEN'] = '';

            $publicKey = new \Lcobucci\JWT\Signer\Key($this->app->config('public_key_path'));

            if ($token->verify($signer, $publicKey)) {

                $data = new \Lcobucci\JWT\ValidationData(); // It will use the current time to validate (iat, nbf and exp)\

                $data->setIssuer($this->app->config('token_issuer'));
                $data->setAudience($this->app->config('token_audience'));
                $data->setId('mobile');

                if ($token->validate($data)) {

                    $user = $token->getClaim('user');

                    $this->app->user = $this->models->user->geUserDetailById($user->id);
                           //   print_r($this->app->user); die;
                    if ($this->app->user['Status'] !== 'Active') {

                        $this->app->slim->redirect($this->app->config('base_url'));
                    }

                    \Quill\View::share(array('user' => $this->app->user));
                } else {

                    throw new BaseException('Token validation failed.');
                }
            } else {

                throw new BaseException('Token verification failed.');
            }
        }
    }

}
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Services;

use Quill\Exceptions\BaseException;

/**
 * Description of OpenTok
 *
 * @author harinder
 */
class OpenTok {

    private $opentok, $session, $config;

    public function __construct() {

        $this->config = load_config_one('opentok');
        $this->opentok = new \OpenTok\OpenTok($this->config['opentok_api_key'], $this->config['opentok_api_secret']);
    }

    public function createSession() {

        $this->session = $this->opentok->createSession(array('mediaMode' => \OpenTok\MediaMode::ROUTED));
    }

    public function genrateToken($data = '') {

        if (!empty($this->session)) {

            return $this->session->generateToken(array(
                        'role' => \OpenTok\Role::MODERATOR,
                        'expireTime' => time() + (24 * 60 * 60), // in one day
                        'data' => $data
            ));
        } else {

            throw new BaseException('Session not created');
        }
    }

//    public function getTokenBySessionId($session_id) {
//        if(!empty($session_id)) {
//            
//            return $this->opentok->generateToken($session_id);          
//            
//        } else {
//            
//            throw new BaseException('Session id can not be empty');
//            
//        }
//        
//    }

    public function getTokenBySessionId($session_id, $data = '') {

        if (!empty($session_id)) {

            $options = array(
                'role' => \OpenTok\Role::MODERATOR,
                'expireTime' => time() + (24 * 60 * 60), // in one day
                'data' => $data
            );

            return $this->opentok->generateToken($session_id, $options);
        } else {

            throw new BaseException('Session id can not be empty');
        }
    }

    public function getSessionId() {

        if (!empty($this->session)) {

            return $this->session->getSessionId();
        } else {

            throw new BaseException('Session not created');
        }
    }

    public function getApiKey() {

        return $this->config['opentok_api_key'];
    }

    public function start($sessionId) {
        try {
            // Create an archive using custom options
            $archiveOptions = array(
                'name' => 'Important Presentation', // default: null
                'hasAudio' => true, // default: true
                'hasVideo' => true, // default: true
                'outputMode' => \OpenTok\OutputMode::COMPOSED  // default: OutputMode::COMPOSED
            );

            $archive = $this->opentok->startArchive($sessionId, $archiveOptions);
            // Store this archiveId in the database for later use
            return $archive->id;
            
        } catch (Exception $ex) {
//            throw new BaseException('Some error :' . $ex->message());
        }
    }

    public function stop($archiveId) {

        //return $archiveId; exit();
        try {
            return $this->opentok->stopArchive($archiveId);
            
        } catch (Exception $ex) {
//            throw new BaseException('Some error :' . $ex->message());
        }
    }

    public function getArchive($archiveId) {

        return $this->opentok->getArchive($archiveId)->toArray();
    }

}

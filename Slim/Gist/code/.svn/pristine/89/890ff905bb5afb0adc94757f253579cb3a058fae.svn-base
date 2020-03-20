<?php

/*
 * Whitelist routes, which don't need to be authenticated.
 */
$app->slim->add(new App\Middlewares\AuthenticationMiddleware(array(
    '/api/mobile/user/login/',
    '/api/mobile/user/resetPassword/',
    '/api/mobile/user/regeneratePassword/',
    '/api/mobile/user/logout/',
    '/api/mobile/user/adminAutoLogin/',
    '/api/mobile/user/adminLogin/',
    '/api/mobile/candidate/register/',
    '/api/mobile/candidate/candidatecheck/',
    '/api/mobile/employer/register/',
)));

/*
 * Route group for Web methods start here
 */

/*
 * Home page.  
 */
$app->slim->get('/', function () use ($app) {

    $home = new App\Controllers\Web\IndexController($app);
    $home->index();
});

/*
 * Home page.  
 */
$app->slim->get('/home/', function () use ($app) {

    $home = new App\Controllers\Web\IndexController($app);
    $home->index();
});


/*
 * account activation page.  
 */
$app->slim->get('/accountActivation/:token/', function ($token) use ($app) {

    $home = new App\Controllers\Web\IndexController($app);
    $home->accountActivation($token);
});

/*
 * regenerate password page. 
 */
$app->slim->get('/generatePassword/:token/', function ($token) use ($app) {

    $home = new App\Controllers\Web\IndexController($app);
    $home->generatePassword($token);
});

/*
 * Logout user
 */
$app->slim->get('/logout/', function () use ($app) {

    $user = new App\Controllers\Web\UserController($app);
    $user->logout();
});

/*
 * Forgot Password Page.  
 */
$app->slim->get('/forgotPassword/', function () use ($app) {

    $home = new App\Controllers\Web\IndexController($app);
    $home->forgotPassword();
});


$app->slim->get('/user/:user', function ($id) use ($app) {

        $home = new App\Controllers\Web\UserController($app);
        $home->profile($id);
    });

/*
 * Route group for Candidate Web methods start here
 */
$app->slim->group('/candidate/', function () use ($app) {

$app->slim->get('signup', function () use ($app) {

        $home = new App\Controllers\Web\IndexController($app);
        $home->signup();
    });

$app->slim->get('login', function () use ($app) {

        $home = new App\Controllers\Web\IndexController($app);
        $home->login();
    });

$app->slim->get('logout', function () use ($app) {

        $home = new App\Controllers\Web\UserController($app);
        $home->logout();
    });

 $app->slim->get('profile/edit', function () use ($app) {

             $home = new App\Controllers\Web\UserController($app);
             $home->candidateedit();
            });

 $app->slim->get('gist/edit', function () use ($app) {

             $home = new App\Controllers\Web\UserController($app);
             $home->candidategistedit();
            });

 $app->slim->get('dashboard', function () use ($app) {

             $home = new App\Controllers\Web\UserController($app);
             $home->candidatedashboard();
            });

$app->slim->post('saveVideo/', function () use ($app) {

    $home = new App\Controllers\Web\IndexController($app);
    $home->saveVideo();
});

$app->slim->post('changeVideo/', function () use ($app) {

    $home = new App\Controllers\Web\UserController($app);
    $home->changeVideo();
});

});


$app->slim->group('/employer/', function () use ($app) {

$app->slim->get('register', function () use ($app) {

             $home = new App\Controllers\Web\IndexController($app);
             $home->employerRegister();
            });
 $app->slim->get('dashboard', function () use ($app) {

             $home = new App\Controllers\Web\UserController($app);
             $home->employerdashboard();
            });

    });

/*
 * Route group for Admin Web methods start here
 */
$app->slim->group('/admin/', function () use ($app) {

    $app->slim->get('', function () use ($app) {

        $home = new App\Controllers\Web\IndexController($app);
        $home->adminLogin();
    });

    $app->slim->get('dashboard/', function () use ($app) {

        $home = new App\Controllers\Web\AdminController($app);
        $home->dashboard();
    });

    $app->slim->get('users/', function () use ($app) {

        $home = new App\Controllers\Web\AdminController($app);
        $home->users();
    });

    $app->slim->get('createGroup/', function () use ($app) {

        $home = new App\Controllers\Web\AdminController($app);
        $home->createGroup();
    });

    $app->slim->get('manageSupportGroups/', function () use ($app) {

        $home = new App\Controllers\Web\AdminController($app);
        $home->regionList();
    });

    $app->slim->get('participantList/:id/', function ($id) use ($app) {

        $home = new App\Controllers\Web\AdminController($app);
        $home->viewParticipants($id);
    });

    $app->slim->get('missedParticipantList/:id/', function ($id) use ($app) {

        $home = new App\Controllers\Web\AdminController($app);
        $home->viewMissedParticipants($id);
    });

    $app->slim->get('createSession/', function () use ($app) {

        $home = new App\Controllers\Web\AdminController($app);
        $home->createSession();
    });

    $app->slim->get('upcomingSession/', function () use ($app) {

        $home = new App\Controllers\Web\AdminController($app);
        $home->upcomingSessions();
    });

    $app->slim->get('completeSession/', function () use ($app) {

        $home = new App\Controllers\Web\AdminController($app);
        $home->completeSessions();
    });
    $app->slim->get('session/:id', function ($id) use ($app) {

        $home = new App\Controllers\Web\AdminController($app);
        $home->session($id);
    });
    $app->slim->get('missedSession/', function () use ($app) {

        $home = new App\Controllers\Web\AdminController($app);
        $home->missedSessions();
    });

    $app->slim->get('reports/', function () use ($app) {

        $home = new App\Controllers\Web\AdminController($app);
        $home->report();
    });

    $app->slim->get('viewReport/:id/', function ($id) use ($app) {

        $home = new App\Controllers\Web\AdminController($app);
        $home->viewReport($id);
    });

    $app->slim->get('logs/', function () use ($app) {

        $home = new App\Controllers\Web\AdminController($app);
        $home->logs();
    });

    /*
     * logged out user
     */
    $app->slim->get('logout/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->logout();
    });

    /*
     * create or update session 
     */

    $app->slim->post('createUpdateSession/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->createUpdateSession();
    });

    /*
     * get participants details
     */

    $app->slim->get('participantDetail/:id', function ($id) use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->participantsDetail($id);
    });

    /*
     * create group
     */

    $app->slim->post('createGroup/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->createGroup();
    });

    /*
     * get group detail
     */

    $app->slim->post('detailOfGroup/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->detailOfGroup();
    });

    /*
     * delete group
     */

    $app->slim->post('delGroup/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->delGroup();
    });
    
     /*
     * create region
     */

    $app->slim->post('createRegion/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->createRegion();
    });
    
    /*
     * get region detail
     */

    $app->slim->post('detailOfRegion/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->detailOfRegion();
    });
    
    /*
     * delete region
     */

    $app->slim->post('delRegion/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->delRegion();
    });

    /*
     * get upcoming session Detail;
     */

    $app->slim->get('upcomingSessionDetail/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->upcomingSessionDetail();
    });


    /*
     * get complete session Detail;
     */

    $app->slim->get('completeSessionDetail/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->completeSessionDetail();
    });

    /*
     * get missed session Detail;
     */

    $app->slim->get('missedSessionDetail/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->missedSessionDetail();
    });

    /*
     * save new user to db
     */
    $app->slim->post('userCreated/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->userCreated();
    });

    /*
     * save new user to db
     */
    $app->slim->post('userCreated/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->userCreated();
    });

    /*
     * delete user record from participant table or set the user moderator
     */
    $app->slim->post('delAndSetModeratorUser/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->delAndSetModeratorUser();
    });

    /*
     * get all avialable user detail
     */
    $app->slim->get('userDetail/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->userDetail();
    });

    /*
     * get session logs room
     */
    $app->slim->get('vesselDetailForLogs/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->vesselDetailForLogs();
    });

    /*
     * get all avialable vessel detail
     */
    $app->slim->get('vesselDetail/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->vesselDetail();
    });

    /*
     * get all avialable reports detail
     */
    $app->slim->get('reportsDetail/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->reportsDetail();
    });

    /*
     * delete available user or update status of user
     */
    $app->slim->post('delAndSetStatusOfUser/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->delAndSetStatusOfUser();
    });

    /*
     * delete available 
     */
    $app->slim->post('delSession/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->delSession();
    });

    /*
     * get available user
     */
    $app->slim->post('getSessionDetail/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->getSessionDetail();
    });

    /*
     * get available vessel
     */
    $app->slim->post('getVesselDetail/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->getVesselDetail();
    });


    /*
     * check availability
     */
    $app->slim->post('checkAvailability/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->checkAvailability();
    });

    /*
     * Get current date time of selected timezone
     */
    $app->slim->post('getCurrentDateTimeByTimezoneId/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->getCurrentDateTimeByTimezoneId();
    });

    /*
     * Get user list
     */
    $app->slim->post('getUserList/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->getUserList();
    });
    
    /*
     * Add user to session
     */
    $app->slim->post('addUsersToSesson/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->addUsersToSesson();
    });
    
    /*
     * Delete user from session
     */
    $app->slim->post('deleteUserFromSesson/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->deleteUserFromSesson();
    });
    
    /*
     * Approve or unapprove user as moderator
     */
    $app->slim->post('userApproveUnapproveModerator/', function () use ($app) {

        $home = new App\Controllers\Api\Mobile\AdminUserController($app);
        $home->userApproveUnapproveModerator();
    });
    
});

/*
 * Route group for API methods start here
 */

$app->slim->group('/api/', function () use ($app) {

    /*
     * Route group for Mobile App API methods.
     */

    $app->slim->group('mobile/', function () use ($app) {
         /*
         * Route group for all app under candidate
         */

        $app->slim->group('candidate/', function () use ($app) {

        $app->slim->post('register/', function () use ($app) {

             $home = new App\Controllers\Api\Mobile\CandidateController($app);
             $home->register();
            });
        $app->slim->post('update/', function () use ($app) {

             $home = new App\Controllers\Api\Mobile\CandidateController($app);
             $home->update();
            });

        $app->slim->post('AutoApply/', function () use ($app) {

             $home = new App\Controllers\Api\Mobile\CandidateController($app);
             $home->AutoApply();
            });

        $app->slim->post('candidateChangeQuestion/', function() use ($app) {
            $home = new App\Controllers\Api\Mobile\CandidateController($app);
            $home->candidateChangeQuestion();
        });

         $app->slim->post('candidatecheck/', function () use ($app) {

             $home = new App\Controllers\Api\Mobile\UserController($app);
             $home->check();
            });
   
             });

         $app->slim->group('employer/', function () use ($app) {

         $app->slim->post('register/', function () use ($app) {

             $home = new App\Controllers\Api\Mobile\EmployerController($app);
             $home->register();
            });
          $app->slim->post('filterCandidates/', function () use ($app) {

             $home = new App\Controllers\Api\Mobile\EmployerController($app);
             $home->filterCandidates();
            });

          $app->slim->post('updateViews/', function () use ($app) {

             $home = new App\Controllers\Api\Mobile\EmployerController($app);
             $home->updateViews();
            });
            
            $app->slim->post('updateSaves/', function () use ($app) {

             $home = new App\Controllers\Api\Mobile\EmployerController($app);
             $home->updateSaves();
            });
            
            $app->slim->post('updateShares/', function () use ($app) {

             $home = new App\Controllers\Api\Mobile\EmployerController($app);
             $home->updateShares();
            });

            $app->slim->post('createResumePdf/', function () use ($app) {

             $home = new App\Controllers\Api\Mobile\EmployerController($app);
             $home->createResumePdf();
            });

         });
        /*
         * Route group for all app under user
         */
        $app->slim->group('user/', function () use ($app) {

            $app->slim->post('', function () use ($app) {

                $home = new App\Controllers\Api\Mobile\UserController($app);
                $home->getUsers();
            });


            /*
             * Login api
             */
            
            $app->slim->post('login/', function () use ($app) {

                $home = new App\Controllers\Api\Mobile\UserController($app);
                $home->login();
            });

            /*
             * Logout api
             */
            $app->slim->post('logout/', function () use ($app) {

                $home = new App\Controllers\Api\Mobile\UserController($app);
                $home->logout();
            });

            /*
             * forgot password api
             */
            $app->slim->post('regeneratePassword/', function () use ($app) {

                $home = new App\Controllers\Api\Mobile\UserController($app);
                $home->regeneratePassword();
            });

            /*
             * set new password
             */
            $app->slim->post('resetPassword/', function () use ($app) {

                $home = new App\Controllers\Api\Mobile\UserController($app);
                $home->resetPassword();
            });

            /*
             * change the password
             */
            $app->slim->post('changePassword/', function () use ($app) {

                $home = new App\Controllers\Api\Mobile\UserController($app);
                $home->changePassword();
            });
            
            /*
             * Auto login to admin in website 
             */
            $app->slim->post('adminAutoLogin/', function () use ($app) {

                $home = new App\Controllers\Api\Mobile\UserController($app);
                $home->adminAutoLogin();
            });

            /*
             * Admin Login api
             */
            $app->slim->post('adminLogin/', function () use ($app) {

                $home = new App\Controllers\Api\Mobile\UserController($app);
                $home->adminLogin();
            });
        });
    });
});

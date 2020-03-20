<?php

namespace App\Controllers\Api\Mobile;

use Quill\Factories\CoreFactory;
use Quill\Factories\ServiceFactory;
use Quill\Factories\ModelFactory;
use Quill\Factories\RepositoryFactory;
use Quill\Exceptions\BaseException;
use Quill\Exceptions\ValidationException;

/**
 * Admin Controller, contains all methods related to superadmin.
 * $2y$10$WCZ5H2Mj7dJCedscfT38J.UFt7PcCvA32QvBCEb8O.5WoVH3Hudte
 * @package App\Controllers\Api\Mobile
 * @author Pankil Joshi <pankil@prologictechnologies.in>
 * @version 1.0
 * @uses Quill\Factories\CoreFactory
 * @uses Quill\Factories\ServiceFactory
 * @uses Quill\Factories\ModelFactory
 * @uses Quill\Exceptions\BaseException
 * @uses Quill\Factories\RepositoryFactory;
 * @extend \App\Controllers\Web\Admin\AdminBaseController
 */
class AdminUserController extends \App\Controllers\Web\AdminBaseController {

    /**
     * Constructor
     * @param object contains app core.
     */
    function __construct($app = NULL) {

        // Call to parent class constructer.
        parent::__construct($app);

        $app->slim->config('debug', false);

        // Instantiate models.
        $this->models = ModelFactory::boot(array('User', 'Countries', 'Timezone'));

        // Instantiate core classes.
        $this->core = CoreFactory::boot(array('Response', 'Http', 'View'));

        // Instantiate services.
        $this->services = ServiceFactory::boot(array('Jwt'));

        $this->app->slim->config('debug', false);
        $app = $this->app;
        $this->request = $this->app->slim->request;
        if ($this->request->isPost()) {

            $this->jsonRequest = json_decode($this->request->getBody(), TRUE);

            if ($this->request->headers->get('CONTENT_TYPE') == 'application/json') {

                if (!$this->jsonRequest) {

                    throw new BaseException('Invalid request format.');
                }
            }
        }

        $this->app->slim->error(function (\Exception $exception) use ($app) {
            $this->app->slim->render('jsonException.php', array('exception' => $exception));
        });
    }

    /**
     * @api {get} /admin/logout/ logout user.
     * @apiName logout
     * @apiGroup admin
     * @apiDescription Use this api endpoint to logout.
     * @apiSuccessExample {json} Success-Response:
     * redirect the user to login page
     */
    public function logout() {
        if (isset($_SESSION)) { // user login then logout
            session_destroy();
            $this->slim->redirect($this->app->config('base_admin_url'));
        }
    }

    /**
     * @api {get} /admin/userDetail/ get all the user details.
     * @apiName userDetail
     * @apiGroup userDetail
     * @date 11 jan,2018
     * @author Loveleen
     * @apiDescription get all the user details.
     * @apiSuccessExample {json} Success-Response:
     * get all the user details.
     */
    public function userDetail() {

        $aColumns = array('users.user_id', 'users.first_name', 'users.last_name', 'users.username', 'users.user_type', 'users.country', 'users.email', 'countries.country_name', 'users.phone_code', 'users.phone_number', 'users.diagnosis', 'users.status', 'users.created_at', 'users.is_moderator', 'users.moderator_reason', 'users.moderator_approval');

        /* Indexed column (used for fast and accurate table cardinality) */
        $sIndexColumn = "users.user_id";

        //Paging
        $sLimit = "";

        if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') { // for paging
            $sLimit = "LIMIT " . $_GET['iDisplayStart'] . ", " .
                    $_GET['iDisplayLength'];
        }

        //Ordering
        $OrderColumns = array('users.user_id', 'users.first_name', 'users.username', 'users.user_type', 'users.is_moderator', 'users.moderator_reason', 'users.email', 'countries.country_name', 'users.phone_number', 'users.diagnosis', 'users.status', 'users.created_at');

        if (isset($_GET['iSortCol_0'])) { // for ordering
            $sOrder = "ORDER BY  ";
            for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
                if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
                    $sOrder .= $OrderColumns[intval($_GET['iSortCol_' . $i])] . " " . $_GET['sSortDir_' . $i] . ", ";
                }
            }

            $sOrder = substr_replace($sOrder, "", -2);
            if ($sOrder == "ORDER BY") { // how to order by
                $sOrder .= " created_at DESC";
            }
        }

        // Filtering
        $filter_arr = array('users.user_id', 'users.first_name', 'users.username', 'users.user_type', 'users.is_moderator', 'users.moderator_reason', 'users.email', 'countries.country_name', 'users.phone_number', 'countries.country_name', 'users.status', 'users.created_at', 'users.moderator_search');
        $cond = "users.is_deleted = '0' AND users.user_id != 1";
        $sWhere = "";
        if ($_GET['sSearch'] != "") { // for filtering
            $sWhere = "WHERE (";
            for ($i = 0; $i < count($filter_arr); $i++) {
                if ($filter_arr[$i] != "" && $filter_arr[$i] != " ") { // for filtering
                    $sWhere .= $filter_arr[$i] . " LIKE '%" . $_GET['sSearch'] . "%' OR ";
                }
            }

            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
            $sWhere = $sWhere . " and " . $cond;
        } else {
            $sWhere = " where " . $cond;
        }


        $rResult = $this->models->user->getUserForDb($aColumns, $sLimit, $sOrder, $sWhere);

        // Data set length after filtering
        $rResultFilterTotal = $this->models->user->getFilterCount();
        $iFilteredTotal = $rResultFilterTotal[0]['total'];

        // Total data set length
        $aResultTotal = $this->models->user->getDataSetLenght($sIndexColumn);
        $iTotal = $aResultTotal[0]['count'];

        //OUTPUT
        $output = array(
            "sEcho" => intval($_GET['sEcho']),
            "iTotalRecords" => $iTotal,
            "iTotalDisplayRecords" => $iFilteredTotal,
            "aaData" => array()
        );

        foreach ($rResult as $aRow) {
            $approval_text = '';
            $mod_text = '';
            if ($aRow['is_moderator'] == '1') {
                if ($aRow['moderator_approval'] == '0') {
                    $approval_text = 'Approval Pending';
                } else if ($aRow['moderator_approval'] == '1') {
                    $approval_text = 'Approved';
                    $mod_text = ' (Moderator)';
                } else {
                    $approval_text = 'Un-Approved';
                }
            }

            $moderator_reason = strlen($aRow['moderator_reason']) > 200 ? substr($aRow['moderator_reason'], 0, 200) . '...' : $aRow['moderator_reason'];
            $diagnosis = strlen($aRow['diagnosis']) > 200 ? substr($aRow['diagnosis'], 0, 200) . '...' : $aRow['diagnosis'];

            $row = array();
            $row[] = $aRow['user_id'];
            $row[] = $aRow['first_name'] . ' ' . $aRow['last_name'];
            $row[] = $aRow['username'];
            $row[] = ucwords($aRow['user_type']) . $mod_text;
            $row[] = $aRow['is_moderator'] == '1' ? $approval_text : '';
            $row[] = '<p data-placement="top" data-toggle="tooltip" title="' . $aRow['moderator_reason'] . '">' . $moderator_reason . '</p>';
            $row[] = $aRow['email'];
            $row[] = $aRow['country_name'];
            // get country name by country id
            $country_data = $this->models->countries->getCountryNameById($aRow['phone_code']);
            $row[] = '+' . $country_data['phone_code'] . '-' . $aRow['phone_number'];
            $row[] = '<p data-placement="top" data-toggle="tooltip" title="' . $aRow['diagnosis'] . '">' . $diagnosis . '</p>';
            if ($aRow['status'] == '0') { // if usr is inactive
                $row[] = 'Inactive';
            } else if ($aRow['status'] == '1') { // user is active
                $row[] = 'Active';
            }

            $action = "";
            if ($aRow['is_moderator'] == '1') {
                if ($aRow['moderator_approval'] == '0') {

                    $action = '<p class="button_para" data-placement="top" data-toggle="tooltip" title="Click to Approve Moderator"><button class="btn btn-warning btn-xs bttn_xss approval_moderator" data-user_id="' . $aRow['user_id'] . '"  data-title="Click to Approve"><span class="glyphicon glyphicon-ok glyphicon_buttonss"></span></button></p><p  class="button_para" data-placement="top" data-toggle="tooltip" title="Click to Un-approve Moderator"><button class="btn btn-danger btn-xs bttn_xss unapproval_moderator" data-user_id="' . $aRow['user_id'] . '" data-title="Click to Un-approve"><span class="glyphicon glyphicon-remove glyphicon_buttonss gylo_buttnn"></span></button></p>';

                } else if ($aRow['moderator_approval'] == '1') {

                    $action = '<p class="button_para" data-placement="top" data-toggle="tooltip" title="Click to Un-approve Moderator"><button class="btn btn-warning btn-xs bttn_xss unapproval_moderator" data-user_id="' . $aRow['user_id'] . '" data-title="Click to Un-approve"><span class="glyphicon glyphicon-remove glyphicon_buttonss"></span></button></p>';

                }
            }

            if ($aRow['status'] == '0') {  // if user is inactive
                $row[] = $action . '<p class="button_para" data-placement="top" data-toggle="tooltip" title="Click to activate"><button class="btn btn-primary btn-xs bttn_xss active_deactive" id="' . $aRow['user_id'] . '" data-title="Click to activate"><span class="glyphicon glyphicon-remove glyphicon_buttons"></span></button></p>'
                        . '<p  class="button_para" data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs bttn_xss delete" id="' . $aRow['user_id'] . '" data-title="Delete"><span class="glyphicon glyphicon-trash glyphicon_buttons glyphicon_del"></span></button></p>';
            } else if ($aRow['status'] == '1') { // if user is active
                $row[] = $action . '<p class="button_para" data-placement="top" data-toggle="tooltip" title="Click to deactivate"><button class="btn btn-primary btn-xs bttn_xss active_deactive" id="' . $aRow['user_id'] . '" data-title="Click to deactivate"><span class="glyphicon glyphicon-ok glyphicon_buttons"></span></button></p>'
                        . '<p class="button_para" data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs bttn_xss delete" id="' . $aRow['user_id'] . '" data-title="Delete"><span class="glyphicon glyphicon-trash glyphicon_buttons glyphicon_del"></span></button></p>';
            }

            $output['aaData'][] = $row;
        }
        exit(json_encode($output));
    }
}

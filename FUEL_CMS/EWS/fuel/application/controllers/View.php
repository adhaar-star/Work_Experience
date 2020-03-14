<?php
/*require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class View extends Fuel_base_controller {
function __construct()
{
parent::__construct();

$slug = uri_segment(2);
if (!empty($slug))
{
    $jobs_item = fuel_model('jobs', array('find' => 'one', 'where' => array('slug' => $slug)));
    if (empty($jobs_item)) show_404();
}
else
{
    $jobs = fuel_model('jobs');
}

}
function index()
{


$this->fuel->admin->render('view',$slug);
}
}*/
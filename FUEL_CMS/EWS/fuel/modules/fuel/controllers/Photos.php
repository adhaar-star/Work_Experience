<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Photos extends Fuel_base_controller {
function __construct()
{
parent::__construct();



}
function index()
{

 




$this->fuel->admin->render('photos');
}
}
<?php 
/*
|--------------------------------------------------------------------------
| MY Custom Modules
|--------------------------------------------------------------------------
|
| Specifies the module controller (key) and the name (value) for fuel
*/


/*********************** EXAMPLE ***********************************

$config['modules']['quotes'] = array(
	'preview_path' => 'about/what-they-say',
);

$config['modules']['projects'] = array(
	'preview_path' => 'showcase/project/{slug}',
	'sanitize_images' => FALSE // to prevent false positives with xss_clean image sanitation
);

*********************** /EXAMPLE ***********************************/

$config['modules']['clients'] = array(
	'module_name' => 'Clients',
	'model_location' => 'fuel',
	'model_name' => 'fuel_clients_model',
	'table_actions' =>  array('EDIT'=>array('url'=>'clients/edit/{id}'),'DELETE')
);

$config['modules']['jobs_statuses'] = array(
	'module_name' => 'Status',
	'model_location' => 'fuel',
	'model_name' => 'fuel_status_model',
);

$config['modules']['jobs'] = array(
	'module_name' => 'Jobs',
	'model_location' => 'fuel',
	'model_name' => 'fuel_jobs_model',
	'preview_path' => 'fuel/jobs/view/{id}',
	'js'=>array(
                            FUEL_FOLDER => array(
                                'myjavascript/my_js',
                               
                            )),
	

  

	
);


$config['modules']['contractors'] = array(
	'module_name' => 'Teams',
	'model_location' => 'fuel',
	'model_name' => 'fuel_contractors_model',
);
/*********************** OVERWRITES ************************************/

$config['module_overwrites']['categories']['hidden'] = TRUE; // change to FALSE if you want to use the generic categories module
$config['module_overwrites']['tags']['hidden'] = TRUE; // change to FALSE if you want to use the generic tags module

/*********************** /OVERWRITES ************************************/

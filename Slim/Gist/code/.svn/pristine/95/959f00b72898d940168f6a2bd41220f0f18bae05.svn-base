<?php

namespace App\Models;

use Quill\Database as Database;

class Countries extends Database {

    protected $tableName = 'countries';
    protected $primarykey = 'country_id';

    /*
     *  get all the avaiable countries
     */

    public function getCountries() {

        return $this->table()->select()->orderBy('phone_code','ASC')->all();
    }
    
    
    /*
     * get country name by country_id
     * @author Loveleen 
     * @date 11 Jan, 2018
     */
    public function getCountryNameById($country_id) {

        return $this->table()->select()->where(array('country_id' => $country_id))->one();
    }
    
}
?>
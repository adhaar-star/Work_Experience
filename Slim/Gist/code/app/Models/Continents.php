<?php

namespace App\Models;

use Quill\Database as Database;

class Continents extends Database {

    protected $tableName = 'continents';
    protected $primarykey = 'continent_id';

    /*
     *  get all the continent
     */

    public function getContinents() {

        return $this->table()->select()->orderBy('continent_order','ASC')->all();
    }
    
}
?>
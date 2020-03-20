<?php

namespace App\Models;

use Quill\Database as Database;

class Timezone extends Database {

    protected $tableName = 'timezones';
    protected $primarykey = 'timezone_id';

    /*
     *  get all the timezones
     */

    public function getTimezone() {
        $result = $this->rawQuery("SELECT timezone_id,timezone_name,TIME_FORMAT(timezone, '%H:%i') as timezone_format,abbrevation FROM timezones ORDER BY timezone ")->fetchAll();
        return $result;
    }

    /*
     * Convert datetime from one timezone to another timezone by mysql CONVERT_TZ function
     */

    public function convertTimezoneByMysql($dateTime, $from_tz = 'UTC', $to_tz = 'UTC') {
        $result = $this->rawQuery("SELECT CONVERT_TZ('" . $dateTime . "','" . $from_tz . "','" . $to_tz . "') as dateTime")->fetch();
        return $result['dateTime'];
    }

    /*
     * get time zone details on the basis of abbrevation
     */

    public function getTimeZoneDetailByAbbrevation($abbrevation) {
        return $this->table()->select()->where(array('abbrevation' => $abbrevation))->one();
    }

    /*
     * get time zone details on the basis of timezone_id
     */

    public function getTimeZoneAbbrevationbyId($timezone_id) {
        return $this->table()->select('abbrevation,timezone_name')->where(array('timezone_id' => $timezone_id))->one();
    }

}

?>
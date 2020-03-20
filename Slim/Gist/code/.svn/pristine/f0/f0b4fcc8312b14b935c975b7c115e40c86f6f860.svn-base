<?php

/**
 * Application helper functions.
 * 
 * @author Pankil Joshi <pankil@prologictechnologies.in>
 * @version 1.0
 */

/**
 * Convert stings seprated by given delimier into 'snake_case'.
 * 
 * @param string $string String to be converted.
 * @param type $delimiter Delimeter used to seprate given string string, eg. space etc.
 * @return string Snake cased string.
 * @uses strtolower()
 * @uses str_replace()
 */
function snake_case($string, $delimiter = ' ') {

    $lower_cased = strtolower($string);

    $snake_cased = str_replace($delimiter, '_', $lower_cased);

    return $snake_cased;
}

/**
 * Load specified cofiguration file.
 * 
 * @param string $file Name of the configuration file to be loaded, without '.php' extention.
 * @param string $defaultConfigDIrectory Set root configuration directory, from where configuration file to be loaded.
 * @param array $require Required configuration variables for specified configuration file.
 * @return array Array of configuration variables.
 * @uses Quill\Config->loadOne() 
 */
function load_config_one($file, $require = array(), $configDirectory = '') {

    $config = new Quill\Config($configDirectory);

    $config = $config->loadOne($file, $require);

    return $config;
}

/**
 * Load specified cofiguration file.
 * 
 * @param string $file Name of the configuration file to be loaded, without '.php' extention.
 * @param string $defaultConfigDIrectory Set root configuration directory, from where configuration file to be loaded.
 * @param array $require Required configuration variables for specified configuration file.
 * @return array Array of configuration variables.
 * @uses Quill\Config->loadOne() 
 */
function load_config_multi($file, $configDirectory = '') {

    $config = new Quill\Config($configDirectory);

    $config = $config->loadMulti($file);

    return $config;
}

/**
 * Convert string to multidimentional array.
 * 
 * @param array $arr array by refrence
 * @param string $path
 * @param mixed $value
 * @param string $separator
 */
function assign_array_by_path(&$arr, $path, $value, $separator = '.') {

    $keys = explode($separator, $path);

    foreach ($keys as $key) {
        $arr = &$arr[$key];
    }

    $arr = $value;
}

/**
 * DateTime remaining from specific datetime
 * 
 * @param string current date time
 * @param string $timer end date time
 * @param string $separator
 */
function dateTimeRemaining($currentDate, $end, $out_in_array = false) {

    $intervalo = date_diff(date_create($currentDate), date_create($end));
    $out = $intervalo->format("years:%Y,months:%M,days:%d,hours:%H,minutes:%i,seconds:%s");
    if (!$out_in_array)
        return $out;
    $a_out = array();
    @array_walk((explode(',', $out)), function($val, $key) use(&$a_out) {
                $v = explode(':', $val);
                $a_out[$v[0]] = $v[1];
            });
    return $a_out;
}

function mime_type($file) {

    // there's a bug that doesn't properly detect
    // the mime type of css files
    // https://bugs.php.net/bug.php?id=53035
    // so the following is used, instead
    // src: http://www.freeformatter.com/mime-types-list.html#mime-types-list

    $mime_type = array(
        "3dml" => "text/vnd.in3d.3dml",
        "3g2" => "video/3gpp2",
        "3gp" => "video/3gpp",
        "7z" => "application/x-7z-compressed",
        "aab" => "application/x-authorware-bin",
        "aac" => "audio/x-aac",
        "aam" => "application/x-authorware-map",
        "aas" => "application/x-authorware-seg",
        "abw" => "application/x-abiword",
        "ac" => "application/pkix-attr-cert",
        "acc" => "application/vnd.americandynamics.acc",
        "ace" => "application/x-ace-compressed",
        "acu" => "application/vnd.acucobol",
        "adp" => "audio/adpcm",
        "aep" => "application/vnd.audiograph",
        "afp" => "application/vnd.ibm.modcap",
        "ahead" => "application/vnd.ahead.space",
        "ai" => "application/postscript",
        "aif" => "audio/x-aiff",
        "air" => "application/vnd.adobe.air-application-installer-package+zip",
        "ait" => "application/vnd.dvb.ait",
        "ami" => "application/vnd.amiga.ami",
        "apk" => "application/vnd.android.package-archive",
        "application" => "application/x-ms-application",
        "png" => "image/png",
        "jpg" => "image/jpeg",
        "jpeg" => "image/jpeg",
        "pdf" => "application/pdf"
            // etc...
            // truncated due to Stack Overflow's character limit in posts
    );

    $extension = \strtolower(\pathinfo($file, \PATHINFO_EXTENSION));
    $extension = strtolower($extension);
    if (isset($mime_type[$extension])) {
        return $mime_type[$extension];
    } else {
        throw new \Exception("Unknown file type");
    }
}

if (!function_exists('_s')) {

    function _s($string) {

        return htmlspecialchars(trim($string));
    }

}

function pagination($total, $paginate_by, $active) {

    $pagination = '';

    if ($total > $paginate_by) {

        $page_count = ceil($total / $paginate_by);

        $pagination = '<ul class="page_nation pagination-container"><li><a href="#" data-page="0">First</a></li><li>page</li>';

        if ($active >= 9) {

            if (($active + 10 ) > $page_count) {

                $counter = $page_count - 10;
            } else {

                $counter = $active - 5;
            }
        } else {

            $counter = 0;
        }
        $batch = 1;
        for ($counter; $counter < $page_count; $counter++) {

            $pagination .= '<li><a class="';
            $pagination .= ($active == $counter) ? 'active' : '';
            $pagination .= '" href="#" data-page="' . $counter . '">' . ($counter + 1) . '</a></li>';

            if ($batch == 10) {

                $batch = 1;
                break;
            } else {

                $batch++;
            }
        }

        $pagination .= '<li><a href="#" data-page="' . ($page_count - 1) . '">Last</a></li></ul>';
    }

    return $pagination;
}

function getOS() {

    $user_agent = $_SERVER['HTTP_USER_AGENT'];

    $os_platform = "Unknown OS Platform";

    $os_array = array(
        '/windows nt 10/i' => 'Windows 10',
        '/windows nt 6.3/i' => 'Windows 8.1',
        '/windows nt 6.2/i' => 'Windows 8',
        '/windows nt 6.1/i' => 'Windows 7',
        '/windows nt 6.0/i' => 'Windows Vista',
        '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
        '/windows nt 5.1/i' => 'Windows XP',
        '/windows xp/i' => 'Windows XP',
        '/windows nt 5.0/i' => 'Windows 2000',
        '/windows me/i' => 'Windows ME',
        '/win98/i' => 'Windows 98',
        '/win95/i' => 'Windows 95',
        '/win16/i' => 'Windows 3.11',
        '/macintosh|mac os x/i' => 'Mac OS X',
        '/mac_powerpc/i' => 'Mac OS 9',
        '/linux/i' => 'Linux',
        '/ubuntu/i' => 'Ubuntu',
        '/iphone/i' => 'iOS',
        '/ipod/i' => 'iOS',
        '/ipad/i' => 'iOS',
        '/android/i' => 'Android',
        '/blackberry/i' => 'BlackBerry',
        '/webos/i' => 'Mobile'
    );

    foreach ($os_array as $regex => $value) {

        if (preg_match($regex, $user_agent)) {
            $os_platform = $value;
        }
    }

    return $os_platform;
}

function convert_datetime($datetime, $to_timezone, $fromat = 'Y-m-d H:i:s', $from_timezone = 'UTC') {

    $to_timezone = (is_valid_timezone($to_timezone)) ? $to_timezone : 'Europe/London';

    // create a $dt object with the UTC timezone
    $dt = new DateTime($datetime, new DateTimeZone($from_timezone));

    // change the timezone of the object without changing it's time
    $dt->setTimezone(new DateTimeZone($to_timezone));

    // format the datetime
    return $dt->format($fromat);
}

function get_timezone_offset_from_name($abberivation) {

    $time = new \DateTime('now', new DateTimeZone($abberivation));

    return $time->format('P');
}

function toAscii($str, $replace = array(), $delimiter = '-') {
    if (!empty($replace)) {
        $str = str_replace((array) $replace, ' ', $str);
    }

    $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
    $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
    $clean = strtolower(trim($clean, '-'));
    $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

    return $clean;
}

function output_file($file_path) {

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file_path));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file_path));
    ob_clean();
    flush();
    readfile($file_path);
    exit;
}

function is_valid_timezone($timezone) {

    if (in_array($timezone, DateTimeZone::listIdentifiers())) {

        return true;
    } else {

        echo false;
    }
}

function find_active_url($string) {

    return substr($_SERVER['REQUEST_URI'], -strlen($string)) == $string ? true : false;
}

function jwt_authentication() {

    $config = load_config_one('jwt', array('url', 'path'));
    $token = (!empty($_COOKIE['token'])) ? $_COOKIE['token'] : '';

    if (!empty($token)) {

        $signer = new \Lcobucci\JWT\Signer\Rsa\Sha256();
        $token = (new \Lcobucci\JWT\Parser())->parse((string) $token); // Parses from a string

        $_SERVER['HTTP_TOKEN'] = '';

        $publicKey = new \Lcobucci\JWT\Signer\Key($config['public_key_path']);

        try {

            if ($token->verify($signer, $publicKey)) {

                $data = new \Lcobucci\JWT\ValidationData(); // It will use the current time to validate (iat, nbf and exp)

                $data->setIssuer($config['token_issuer']);
                $data->setAudience($config['token_audience']);
                $data->setId('mobile');

                if ($token->validate($data)) {

                    $user = $token->getClaim('user');

                    return array('user' => array('id' => $user->id));
                } else {

                    return false;
                }
            } else {

                return false;
            }
        } catch (\Exception $ex) {

            return false;
        }
    }
}

// date time format function
function date_time_format($date) {
    $date = date('M jS Y', strtotime($date)) . ', ' . date('h:i A', strtotime($date));
    return $date;
}

//function to detect browser
function getBrowser() {
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version = "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif (preg_match('/Firefox/i', $u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif (preg_match('/Chrome/i', $u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif (preg_match('/Safari/i', $u_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif (preg_match('/Opera/i', $u_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    } elseif (preg_match('/Netscape/i', $u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    } elseif (preg_match('/Trident/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "Trident";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
            $version = $matches['version'][0];
        } else {
            $version = $matches['version'][1];
        }
    } else {
        $version = $matches['version'][0];
    }

    // check if we have a number
    if ($version == null || $version == "") {
        $version = "?";
    }
    if ($ub == 'MSIE' || $ub == 'Trident') {
        $ub = 'Internet Explorer';
    }

    return array(
        // 'userAgent' => $u_agent,
        //'name'      => $bname,
        'name' => $ub,
        'version' => $version,
        'platform'  => $platform,
            // 'pattern'    => $pattern
    );
}

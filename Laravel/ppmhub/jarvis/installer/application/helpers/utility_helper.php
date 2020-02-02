<?php

// little dashboard helper for displaying some useful data
// version 1.0
//array_key exists recursive
function array_key_exists_r($needle, $haystack)
{
    $result = array_key_exists($needle, $haystack);
    if ($result) {
        return $result;
    }
    foreach ($haystack as $v) {
        if (is_array($v)) {
            $result = array_key_exists_r($needle, $v);
        }
        if ($result) {
            return $result;
        }
    }

    return $result;
}

// get recursive directory size
function recursive_directory_size($directory, $format = false)
{
    $size = 0;
    if (substr($directory, -1) == '/') {
        $directory = substr($directory, 0, -1);
    }
    if (!file_exists($directory) || !is_dir($directory) || !is_readable($directory)) {
        return -1;
    }
    if ($handle = opendir($directory)) {
        while (($file = readdir($handle)) !== false) {
            $path = $directory . '/' . $file;
            if ($file != '.' && $file != '..') {
                if (is_file($path)) {
                    $size += filesize($path);
                } elseif (is_dir($path)) {
                    $handlesize = recursive_directory_size($path);
                    if ($handlesize >= 0) {
                        $size += $handlesize;
                    } else {
                        return -1;
                    }
                }
            }
        }
        closedir($handle);
    }
    if ($format == true) {
        return formatfilesize($size);
    } else {
        return $size;
    }
}

// format size for humans ;)
function format_file_size($size)
{
    // bytes
    if ($size < 1024) {
        return $size . " bytes";
    } // kilobytes
    elseif ($size < (1024 * 1024)) {
        return round(($size / 1024), 1) . " KB";
    } // megabytes
    elseif ($size < (1024 * 1024 * 1024)) {
        return round(($size / (1024 * 1024)), 1) . " MB";
    } // gigabytes
    else {
        return round(($size / (1024 * 1024 * 1024)), 1) . " GB";
    }
}

/**
 *  check if file exit
 * if not so return the no image path
 * @param string $file_path
 */
function display_image_path($file_path = '')
{
    if ($file_path == '') {
        $file_path = config_item('no_image_thumb');
    }

    return $file_path;
}

/**
 *
 * @param string $param1
 * @param string $param2
 * @param string $result1
 * @param string $result2
 */
function short_if($param1 = '', $param2 = '', $result1 = '', $result2 = '')
{
    return ($param1 == $param2) ? $result1 : $result2;
}

/**
 * @param $ptime time stamp format
 * @return string THE ELAPSED TIME STRING
 */
function time_elapsed_string($ptime)
{
    $etime = time() - $ptime;

    if ($etime < 1) {
        return '0 seconds';
    }

    $a = array(
        365 * 24 * 60 * 60 => 'year',
        30 * 24 * 60 * 60 => 'month',
        24 * 60 * 60 => 'day',
        60 * 60 => 'hour',
        60 => 'minute',
        1 => 'second'
    );
    $a_plural = array(
        'year' => 'years',
        'month' => 'months',
        'day' => 'days',
        'hour' => 'hours',
        'minute' => 'minutes',
        'second' => 'seconds'
    );

    foreach ($a as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);

            return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
        }
    }
}

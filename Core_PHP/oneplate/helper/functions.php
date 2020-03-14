<?php

/**
 * @return boolean
 */
function is_loggedin() {
    return (bool) (isset($_SESSION['id']) && !empty($_SESSION['id']) &&
            isset($_SESSION['user_details']) && !empty($_SESSION['user_details']) && is_array($_SESSION['user_details']) &&
            isset($_SESSION['user_type']) && !empty($_SESSION['user_type']));
}

/**
 * @param string $uri
 */
function redirect($uri = '') {
    if (!empty($uri)) {
        header('Location: ' . BASE_URL . $uri);
        exit;
    }
    header('Location: ' . BASE_URL);
    exit;
}

/**
 * Valid Email
 *
 * @param	string
 * @return	bool
 */
function valid_email($str) {
    if (function_exists('idn_to_ascii') && $atpos = strpos($str, '@')) {
        $str = substr($str, 0, ++$atpos) . idn_to_ascii(substr($str, $atpos));
    }
    return (bool) filter_var($str, FILTER_VALIDATE_EMAIL);
}

/**
 * @param       $alerts - arra('error-type' => array('message'))
 */
function set_alerts($alerts = array()) {
    if (!empty($alerts)) {
        foreach ($alerts as $type => $list) {
			if(is_array($list)) {
				foreach ($list as $key => $message) {
                	$_SESSION['alerts'][$type][] = $message;
            	}
			} else {
				$_SESSION['alerts'][$type][] = $list;
			}
        }
    }
}

/*
 * return all alerts as an array
 */

function get_alerts() {
    if (isset($_SESSION['alerts']) && !empty($_SESSION['alerts'])) {
        /* @var $_SESSION['alerts'] array of bootstrap-alerts
         * possible values of $type are [danger, success, warning, info] 
         */
        foreach ($_SESSION['alerts'] as $type => $list) {
            $response[$type] = $list;
        }
        return $response;
    }
    return false;
}

/**
 * prints alerts
 */
function display_alerts($print = true) {
	$data = '';
    if (isset($_SESSION['alerts']) && !empty($_SESSION['alerts'])) {
        foreach ($_SESSION['alerts'] as $type => $list) {
            echo '<div class="alert alert-', $type, ' alert-dismissible fade in" role="alert">
                    <button type="button" class="close-alert" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
            /* @var $list array */
            /* all messages of one type */
            foreach ($list as $key => $message) {
                if (is_array($message)) {
                   if($print) {
				   		echo '<h4 class="h4">', $message['head'], '</h4><p>', $message['body'], '</p>';
				   } else {
						$data .= '<h4 class="h4">'. $message['head']. '</h4><p>'. $message['body']. '</p>';
				   }
                } else {
					if($print) {
                    	echo '<p>', $message, '</p>';
					} else {
						$data .= '<p>'. $message. '</p>';
					}
                }
            }
            echo '</div>';
            unset($_SESSION['alerts'][$type]);
        }
        unset($_SESSION['alerts']);
    }
}

/**
 * @param array||string $options Create anchor or print as a string
 */
function anchor($options = array(), $not_print = FALSE) {
    if (is_array($options)) {
        $anchor = '<a';
        $anchor .= ' href="' . BASE_URL . $options['href'] . '"';
        if (isset($options['attr'])) {
            /* @var $options['attr'] collection of anchor attributes="values" pairs */
            foreach ($options['attr'] as $attr => $val) {
                $anchor .= ' ' . $attr . '="' . $val . '"';
            }
        }
        $anchor .= '>' . $options['text'] . '</a>';
        if ($not_print) {
            return $anchor;
        } else {
            echo $anchor;
        }
    } else {
        if ($not_print) {
            return $options;
        } else {
            echo $options;
        }
    }
}

/**
 * @param string $current set current page name
 */
function set_active_nav($current) {
    $_SESSION['active_nav'] = '';
    if (!empty($current)) {
        $_SESSION['active_nav'] = $current;
    }
}

function set_active_sub_nav($current) {
    $_SESSION['active_sub_nav'] = '';
    if (!empty($current)) {
        $_SESSION['active_sub_nav'] = $current;
    }
}

/**
 * @param string $current current page name
 */
function get_active_nav($current, $other_classes = '') {
    if ($_SESSION['active_nav'] == $current) {
        if($other_classes != '') {
            return 'class="active '.$other_classes.'"';
        } else {
            return 'class="active"';
        }
    }
}

function get_active_sub_nav($current, $other_classes = '') {
    if ($_SESSION['active_sub_nav'] == $current) {
        if($other_classes != '') {
            return 'class="active '.$other_classes.'"';
        } else {
            return 'class="active"';
        }
    }
}

/**
 * 
 * @param string $current current page name
 */
function active_nav_sr_only($current) {
    if ($_SESSION['active_nav'] == $current) {
        $_SESSION['active_nav'] = '';
        return '<span class="sr-only">(current)</span>';
    }
    if ($_SESSION['active_sub_nav'] == $current) {
        $_SESSION['active_nav'] = '';
        return '<span class="sr-only">(current)</span>';
    }
}

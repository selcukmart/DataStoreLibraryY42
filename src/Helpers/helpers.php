<?php
/**
 * @author selcukmart
 * 1.02.2022
 * 16:29
 */


if (!function_exists('mb_ucfirst')) {
    function mb_ucfirst($string, $encoding = null): string
    {
        if (is_null($encoding)) {
            $encoding = 'UTF-8';
        }
        $strlen = mb_strlen($string, $encoding);
        $firstChar = mb_substr($string, 0, 1, $encoding);
        $then = mb_substr($string, 1, $strlen - 1, $encoding);
        return mb_strtoupper($firstChar, $encoding) . $then;
    }
}

if ((!function_exists('mb_str_replace')) &&
    (function_exists('mb_substr')) && (function_exists('mb_strlen')) && (function_exists('mb_strpos'))) {
    function mb_str_replace($search, $replace, $subject)
    {
        if (is_array($subject)) {
            $ret = [];
            foreach ($subject as $key => $val) {
                $ret[$key] = mb_str_replace($search, $replace, $val);
            }
            return $ret;
        }

        foreach ((array)$search as $key => $s) {
            if ($s == '' && $s !== 0) {
                continue;
            }
            $r = !is_array($replace) ? $replace : (array_key_exists($key, $replace) ? $replace[$key] : '');
            $pos = mb_strpos($subject, $s, 0, 'UTF-8');
            while ($pos !== false) {
                $subject = mb_substr($subject, 0, $pos, 'UTF-8') . $r . mb_substr($subject, $pos + mb_strlen($s, 'UTF-8'), 65535, 'UTF-8');
                $pos = mb_strpos($subject, $s, $pos + mb_strlen($r, 'UTF-8'), 'UTF-8');
            }
        }
        return $subject;
    }
}
if(!function_exists('c')){
    function c($v, $return = false)
    {
        if ($return) {
            $output = '<pre>';
        } else {
            echo '<pre>';
        }
        if (is_array($v) || is_object($v)) {
            if ($return) {
                $output .= print_r($v, true);
            } else {
                print_r($v);
            }
        } elseif ($return) {
            $output .= $v;
        } elseif (is_bool($v)) {
            var_dump($v);
        } else {
            echo $v;
        }
        if ($return) {
            $output .= '</pre>';
            return $output;
        }

        echo '</pre>';
    }
}

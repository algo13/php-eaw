<?php
/**
 * mb_eaw_strwidth.function.php
 *
 * Copyright (c) 2015 algo13
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
 if (!function_exists('mb_eaw_names')) {
     require_once dirname(__FILE__).'/mb_eaw_names.function.php';
 }
// array mb_eaw_strwidth_array(string $string, array $table = null, string $encoding = mb_internal_encoding())
function mb_eaw_strwidth_array($string, array $table = null, $encoding = null)
{
    static $n2w = array('N' => 1, 'A' => 2, 'H' => 1, 'W' => 2, 'F' => 2, 'Na' => 1);
    $names = (func_num_args() < 3)
        ? mb_eaw_names($string)
        : mb_eaw_names($string, $encoding);
    if ($names === false) {
        return false;
    }
    if (is_null($table)) {
        $table = $n2w;
    } else {
        $table = array_merge($n2w, $table);
    }
    $retval = array();
    foreach ($names as $value) {
        $retval[] = $table[$value];
    }
    return $retval;
}
// int mb_eaw_strwidth(string $string, array $table = null, string $encoding = mb_internal_encoding())
function mb_eaw_strwidth($string, array $table = null, $encoding = null)
{
    $eaw_array = (func_num_args() < 3)
        ? mb_eaw_strwidth_array($string, $table)
        : mb_eaw_strwidth_array($string, $table, $encoding);
    if ($eaw_array === false) {
        return false;
    }
    return array_sum($eaw_array);
}

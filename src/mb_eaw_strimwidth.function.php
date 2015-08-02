<?php
/**
 * mb_eaw_strimwidth.function.php
 *
 * Copyright (c) 2015 algo13
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
if (!function_exists('mb_eaw_strwidth')) {
    require_once dirname(__FILE__).'/mb_eaw_strwidth.function.php';
}
// string mb_eaw_strimwidth(string $str, int $start, int $width, string $trimmarker = '', array $table = null, string $encoding = mb_internal_encoding())
function mb_eaw_strimwidth($str, $start, $width, $trimmarker = '', array $table = null, $encoding = null)
{
    if ($width < 0) {
        trigger_error('Width is negative value', E_USER_WARNING);
        return false;
    }
    if (func_num_args() < 6) {
        $encoding = mb_internal_encoding();
    }
    $strLen = mb_strlen($str, $encoding);
    if ($strLen === false) {
        return false;
    }
    if ($start < 0 || $start > $strLen) {
        trigger_error('Start position is out of range', E_USER_WARNING);
        return false;
    }
    $str = mb_substr($str, $start, $strLen, $encoding);
    if ($str === false) {
        return false;
    }
    $strLen -= $start;
    $eawa = mb_eaw_strwidth_array($str, $table, $encoding);
    if ($eawa === false) {
        return false;
    }
    if (array_sum($eawa) <= $width) {
        return $str;
    }
    $eawa_marker = mb_eaw_strwidth($trimmarker, $table, $encoding);
    if ($eawa_marker === false) {
        return false;
    }
    if ($eawa_marker > $width) {
        trigger_error('Trimmarker is out of range', E_USER_WARNING);
        return false;
    }
    $width -= $eawa_marker;
    $charLen = 0;
    for ($start = 0; $start < $strLen; ++$start) {
        if (($width - $eawa[$start]) < 0) {
            break;
        }
        ++$charLen;
        $width -= $eawa[$start];
    }
    return mb_substr($str, 0, $charLen, $encoding) . $trimmarker;
}

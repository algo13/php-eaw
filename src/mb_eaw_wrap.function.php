<?php
/**
 * mb_eaw_wrap.function.php
 *
 * Copyright (c) 2015 algo13
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
 if (!function_exists('mb_eaw_strwidth')) {
     require_once dirname(__FILE__).'/mb_eaw_strwidth.function.php';
 }
// string mb_wrap( string $str, int $width = 75, string $break = "\n", string $encoding = mb_internal_encoding())
function mb_eaw_wrap($string, $width = 75, $break = "\n", $table = null, $encoding = null)
{
    if (func_num_args() < 5) {
        $encoding = mb_internal_encoding();
    }
    $len = mb_strlen($string, $encoding);
    if ($len === false) {
        return false;
    }
    $line = '';
    $lineLen = 0;
    $retval = '';
    for ($start = 0; $start < $len; ++$start) {
        $char = mb_substr($string, $start, 1, $encoding);
        $charwidth = mb_eaw_strwidth($char, $table, $encoding);
        if (($lineLen + $charwidth) <= $width) {
            $line .= $char;
            $lineLen += $charwidth;
        } else {
            $retval .= $line.$break;
            $line = $char;
            $lineLen = $charwidth;
        }
    }
    if ($line !== '') {
        return $retval.$line.$break;
    }
    return $retval;
}

<?php
/**
 * mb_str_split.function.php
 *
 * Copyright (c) 2015 algo13
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
// array mb_str_split(string $string, int $split_length = 1, string $encoding = mb_internal_encoding())
function mb_str_split($string, $split_length = 1, $encoding = null)
{
    if ($split_length <= 0) {
      trigger_error('The length of each segment must be greater than zero', E_USER_WARNING);
      return false;
    }
    if (func_num_args() < 3) {
        $encoding = mb_internal_encoding();
    }
    $len = mb_strlen($string, $encoding);
    if ($len === false) {
        return false;
    }
    $retval = array();
    for ($start = 0; $start < $len; $start += $split_length) {
        $retval[] = mb_substr($string, $start, $split_length, $encoding);
    }
    return $retval;
}

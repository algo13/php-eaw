<?php
/**
 * mb_str_pad_eaw.inc.php
 *
 * Copyright (c) 2015 algo13
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
if (!function_exists('mb_east_asian_width')) {
    require_once 'mb_east_asian_width.php';
}
// string mb_str_pad_eaw(string $input, int $pad_length, string $pad_string = ' ', int $pad_type = STR_PAD_RIGHT, $encoding = mb_internal_encoding(), $table = null))
function mb_str_pad_eaw($mbstring, $pad_length, $pad_sbstring = ' ', $pad_type = STR_PAD_RIGHT, $encoding = null, $table = null)
{
    $eaw = (func_num_args() < 6)
        ? ((func_num_args() < 5)
            ? mb_east_asian_width($mbstring)
            : mb_east_asian_width($mbstring, $encoding)
          )
        : mb_east_asian_width($mbstring, $encoding, $table)
    ;
    return str_pad($mbstring, $pad_length + ((strlen(bin2hex($mbstring)) / 2) - $eaw), $pad_sbstring, $pad_type);
}

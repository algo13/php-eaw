<?php
/**
 * mb_eaw_str_pad.function.php
 *
 * Copyright (c) 2015 algo13
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
if (!function_exists('mb_eaw_strwidth')) {
    require_once dirname(__FILE__).'/mb_eaw_strwidth.function.php';
}
// string mb_eaw_str_pad(string $mbstring, int $pad_length, string $pad_sbstring = ' ', int $pad_type = STR_PAD_RIGHT, array $table = null), string $encoding = mb_internal_encoding())
function mb_eaw_str_pad($mbstring, $pad_length, $pad_sbstring = ' ', $pad_type = STR_PAD_RIGHT, array $table = null, $encoding = null)
{
    $eaw = (func_num_args() < 6)
        ? mb_eaw_strwidth($mbstring, $table)
        : mb_eaw_strwidth($mbstring, $table, $encoding);
    return str_pad($mbstring, $pad_length + ((strlen(bin2hex($mbstring)) / 2) - $eaw), $pad_sbstring, $pad_type);
}

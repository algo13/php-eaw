<?php
/**
 * mb_str_pad.function.php
 *
 * Copyright (c) 2015 algo13
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
// string mb_str_pad(string $input, int $pad_length, string $pad_string = ' ', int $pad_type = STR_PAD_RIGHT, string $encoding = mb_internal_encoding())
function mb_str_pad($mbstring, $pad_length, $pad_sbstring = ' ', $pad_type = STR_PAD_RIGHT, $encoding = null)
{
    $strwidth = (func_num_args() < 5)
        ? mb_strwidth($mbstring)
        : mb_strwidth($mbstring, $encoding);
    $pad_length += ((strlen(bin2hex($mbstring)) / 2) - $strwidth);
    return str_pad($mbstring, $pad_length, $pad_sbstring, $pad_type);
}

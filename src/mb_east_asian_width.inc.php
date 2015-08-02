<?php
/**
 * mb_east_asian_width.inc.php
 *
 * Copyright (c) 2015 algo13
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
 if (!function_exists('mb_eaw_names')) {
     require_once dirname(__FILE__).'/mb_eaw_names.function.php';
 }
 if (!function_exists('mb_eaw_strwidth')) {
     require_once dirname(__FILE__).'/mb_eaw_strwidth.function.php';
 }
 if (!function_exists('mb_eaw_strimwidth')) {
     require_once dirname(__FILE__).'/mb_eaw_strimwidth.function.php';
 }
 if (!function_exists('mb_eaw_str_pad')) {
     require_once dirname(__FILE__).'/mb_eaw_str_pad.function.php';
 }
 if (!function_exists('mb_eaw_wrap')) {
     require_once dirname(__FILE__).'/mb_eaw_wrap.function.php';
 }

<?php
/**
 * std2table.php
 *
 * Copyright (c) 2015 algo13
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
/*
Open http://www.unicode.org/Public/UCD/latest/ucd/EastAsianWidth.txt
Output range_raw.txt: range data.
Output range_opt.txt: optimize range data.
Output range_table_raw.php: hex table for PHP source code.
Output range_table.php: 36 decimal table for PHP source code.
*/
$fileName = 'EastAsianWidth.txt';
if (!file_exists($fileName)) {
    $fileName = 'http://www.unicode.org/Public/UCD/latest/ucd/EastAsianWidth.txt';
}
echo 'Open '.$fileName.PHP_EOL;
$fileSTD = file($fileName, FILE_SKIP_EMPTY_LINES);
if ($fileSTD === false) {
    echo $fileName.' file open error.'.PHP_EOL;
    exit(1);
}
if (!file_exists('EastAsianWidth.txt')) {
    file_put_contents('EastAsianWidth.txt', $fileSTD);
}
// standard to range data.
$rangeSTD = array();
foreach ($fileSTD as $line) {
    if ($line[0] !== '#') {
        $posSemicolon = strpos($line, ';');
        if ($posSemicolon !== false) {
            $name = substr($line, $posSemicolon + 1, strpos($line, ' ', $posSemicolon + 1) - ($posSemicolon + 1));
            $posDot = strpos($line, '..');
            if ($posDot === false) {
                $hex = substr($line, 0, $posSemicolon);
                $rangeSTD[] = array('f' => $hex, 'l' => $hex, 'n' => $name);
            } else {
                $posDotAfter = $posDot + strlen('..');
                $rangeSTD[] = array(
                    'f' => substr($line, 0, $posDot),
                    'l' => substr($line, $posDotAfter, $posSemicolon - $posDotAfter),
                    'n' => $name
                );
            }
        }
    }
}
// range data optimize.
$range = array('raw' => '', 'opt' => '');
$optimize = array();
$current = null;
foreach ($rangeSTD as $value) {
    $range['raw'] .= $value['f'].'..'.$value['l'].';'.$value['n'].PHP_EOL;
    if ($current === null) {
        $current = $value;
    } else if (
        $current['n'] === $value['n'] &&
        intval($current['l'], 16) + 1 === intval($value['f'], 16)
    ) {
        $current['l'] = $value['l'];
    } else {
        $range['opt'] .= $current['f'].'..'.$current['l'].';'.$current['n'].PHP_EOL;
        $optimize[] = $current;
        $current = $value;
    }
}
$range['opt'] .= $current['f'].'..'.$current['l'].';'.$current['n'].PHP_EOL;
$optimize[] = $current;
// output range data.
file_put_contents('range_raw.txt', $range['raw']);
echo 'Output range_raw.txt'.PHP_EOL;
file_put_contents('range_opt.txt', $range['opt']);
echo 'Output range_opt.txt'.PHP_EOL;

// for PHP Source code.
$result = array(
    'raw_assoc' => array(),
    'raw_range' => array(),
    'opt_assoc_key' => array(),
    'opt_assoc_value' => array(),
    'opt_range' => array()
);
$eaw_names = array_flip(array('N', 'A', 'H', 'W', 'F', 'Na'));
foreach ($optimize as $value) {
    if (!ctype_xdigit($value['f']) || !ctype_xdigit($value['l'])) {
        throw new RuntimeException();
    }
    $value['f'] = base_convert(intval($value['f'], 16), 10, 16); //< zero suppress
    $value['l'] = base_convert(intval($value['l'], 16), 10, 16); //< zero suppress
    $raw['l'] = '0x'.$value['l'];
    $raw['f'] = '0x'.$value['f'];
    $raw['n'] = '\''.$value['n'].'\'';
    $opt['f'] = base_convert($value['f'], 16, 36);
    $opt['l'] = base_convert($value['l'], 16, 36);
    if (array_key_exists($value['n'], $eaw_names)) {
        $opt['n'] = $eaw_names[$value['n']];
    } else {
        throw new RuntimeException();
    }
    if ($value['f'] === $value['l']) {
        $result['raw_assoc'][] = $raw['f'].' => '.$raw['n'];
        $result['opt_assoc_key'][] = $opt['f'];
        $result['opt_assoc_value'][] = $opt['n'];
    } else {
        $result['raw_range']['f'][] = $raw['f'];
        $result['raw_range']['l'][] = $raw['l'];
        $result['raw_range']['n'][] = $raw['n'];
        $result['opt_range']['f'][] = $opt['f'];
        $result['opt_range']['l'][] = $opt['l'];
        $result['opt_range']['n'][] = $opt['n'];
    }
}
file_put_contents('range_table_raw.php',
    '$assoc = array('.implode(',', $result['raw_assoc']).');'.PHP_EOL.
    '$range = array('.PHP_EOL.
    '    array('.implode(', ', $result['raw_range']['f']).'),'.PHP_EOL.
    '    array('.implode(', ', $result['raw_range']['l']).'),'.PHP_EOL.
    '    array('.implode(', ', $result['raw_range']['n']).')'.PHP_EOL.
    ');'.PHP_EOL
);
echo 'Output range_table_raw.php'.PHP_EOL;
file_put_contents('range_table.php',
    '$assoc_keys = \''.implode(',', $result['opt_assoc_key']).'\';'.PHP_EOL.
    '$assoc_values = \''.implode('', $result['opt_assoc_value']).'\';'.PHP_EOL.
    '$range = array('.PHP_EOL.
    '    \''.implode(',', $result['opt_range']['f']).'\','.PHP_EOL.
    '    \''.implode(',', $result['opt_range']['l']).'\','.PHP_EOL.
    '    \''.implode('', $result['opt_range']['n']).'\''.PHP_EOL.
    ');'.PHP_EOL
);
echo 'Output range_table.php'.PHP_EOL;

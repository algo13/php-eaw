# php-eaw
East Asian Width for PHP 5.2 or above.


The width of the `East Asian Ambiguous` of `mb_strwidth()` function is 1.

The default width of the `East Asian Ambiguous` of `mb_eaw_strwidth()` function is 2.


The following returns the same result.
```
  mb_strwidth($string, $encoding) === mb_eaw_strwidth($string, array('A' => 1), $encoding))
```



## Features(East Asian Width functions)

| basic          | mbstring             | East Asian Width functions              |
| -------------- | -------------------- | --------------------------------------- |
| ---            | ---                  | mb_eaw_names                            |
| ---            | [mb_strwidth][3]     | mb_eaw_strwidth (mb_eaw_strwidth_array) |
| ---            | [mb_strimwidth][4]   | mb_eaw_strimwidth                       |
| [str_pad][1]   | mb_str_pad (Bonus)   | mb_eaw_str_pad                          |
| ---            | mb_wrap (Bonus)      | mb_eaw_wrap                             |
| [str_split][2] | mb_str_split (Bonus) | ---                                     |

[1]: http://php.net/manual/function.str-pad.php
[2]: http://php.net/manual/function.str-split.php
[3]: http://php.net/manual/function.mb-strwidth.php
[4]: http://php.net/manual/function.mb-strimwidth.php


* `src/mb_east_asian_width.inc.php`
  all inclue eaw library.

* `src/mb_eaw_names.function.php`
  ```
  array mb_eaw_names(string $string, string $encoding = mb_internal_encoding())
  ```

* `src/mb_eaw_strwidth.function.php`
  ```
  array mb_eaw_strwidth_array(string $string, array $table = null, string $encoding = mb_internal_encoding())
  int mb_eaw_strwidth(string $string, array $table = null, string $encoding = mb_internal_encoding())
  ```

* `src/mb_eaw_strimwidth.function.php`
  ```
  string mb_eaw_strimwidth(string $str, int $start, int $width, string $trimmarker = '', array $table = null, string $encoding = mb_internal_encoding())
  ```

* `src/mb_eaw_str_pad.function.php`
  ```
  string mb_eaw_str_pad(string $mbstring, int $pad_length, string $pad_sbstring = ' ', int $pad_type = STR_PAD_RIGHT, array $table = null), string $encoding = mb_internal_encoding())
  ```

* `src/mb_eaw_wrap.function.php`
  ```
  string mb_wrap( string $str, int $width = 75, string $break = "\n", string $encoding = mb_internal_encoding())
  ```

## Features(Bonus functions)

* `src/mb_str_pad.function.php`
  ```
  string mb_str_pad(string $input, int $pad_length, string $pad_string = ' ', int $pad_type = STR_PAD_RIGHT, string $encoding = mb_internal_encoding())
  ```

* `src/mb_wrap.function.php`
  ```
  string mb_wrap( string $str, int $width = 75, string $break = "\n", string $encoding = mb_internal_encoding())
  ```

* `src/mb_str_split.function.php`
  ```
  array mb_str_split(string $string, int $split_length = 1, string $encoding = mb_internal_encoding())
  ```


## Getting Started
```php
mb_internal_encoding('UTF-8');
if (PHP_OS === 'WIN32' || PHP_OS === 'WINNT') {
    function output_callback($buffer){ return mb_convert_encoding($buffer, 'CP932', 'UTF-8'); }
    ob_start('output_callback');
}
require_once 'php-eaw/src/mb_east_asian_width.inc.php';

$string = '☆★※○●◎';

echo 'mb_eaw_strwidth.function.php'.PHP_EOL;
echo mb_eaw_strwidth($string).PHP_EOL;

echo 'mb_eaw_str_pad.function.php'.PHP_EOL;
echo mb_eaw_str_pad($string, 10, '@').PHP_EOL;

echo 'mb_eaw_strimwidth.function.php'.PHP_EOL;
echo mb_eaw_strimwidth($string, 0, 10, ' ..').PHP_EOL;
```

Result

```
>php sample.php
mb_eaw_strwidth.function.php
12
mb_eaw_str_pad.function.php
☆★※○●◎
mb_eaw_strimwidth.function.php
☆★※ ..

>
```

## See Also
* [EAST ASIAN WIDTH](http://www.unicode.org/reports/tr11/)
* [EastAsianWidth.txt](http://www.unicode.org/Public/UCD/latest/ucd/EastAsianWidth.txt)


## License
php-eaw is licensed under the MIT license.

# php-eaw
East Asian Width for PHP 5.2 or above.


The width of the `East Asian Ambiguous` of `mb_strwidth()` function is 1.

The default width of the `East Asian Ambiguous` of `mb_east_asian_width()` function is 2.

## Features(East Asian Width functions)

| basic      | mbstring       | eaw                                    |
| ---------- | -------------- | -------------------------------------- |
| ---        | ---            | mb_eaw_names                           |
| ---        | mb_strwidth*   | mb_eaw_strwidth(mb_eaw_strwidth_array) |
| ---        | mb_strimwidth* | mb_eaw_strimwidth                      |
| str_pad*   | mb_str_pad     | mb_eaw_str_pad                         |
| ---        | mb_wrap        | mb_eaw_wrap                            |
| str_split* | mb_str_split   | ---                                    |


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
require_once 'php-eaw/src/mb_east_asian_width.inc.php';

$string = '☆★※○●◎';

// mb_eaw_names.function.php
print_r(mb_eaw_names($string)).PHP_EOL;

// mb_eaw_strwidth.function.php
print_r(mb_eaw_strwidth_array($string));
echo mb_eaw_strwidth($string).PHP_EOL;

// mb_eaw_str_pad.function.php
echo mb_eaw_str_pad($string, 10, '@').PHP_EOL;

// mb_eaw_strimwidth.function.php
echo mb_eaw_strimwidth($string, 0, 10, ' ..').PHP_EOL;
```


## See Also
* [EAST ASIAN WIDTH](http://www.unicode.org/reports/tr11/)
* [EastAsianWidth.txt](http://www.unicode.org/Public/UCD/latest/ucd/EastAsianWidth.txt)


## License
php-eaw is licensed under the MIT license.

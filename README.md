# php-eaw
East Asian Width for PHP 5.3 or above.


The width of the East Asian Ambiguous of `mb_strwidth()` function is 1.
The default width of the East Asian Ambiguous of `mb_east_asian_width()` function is 2.

## Features
* `src/mb_east_asian_width.inc.php`
  ```
  array mb_east_asian_width_names(string $string, string $encoding = mb_internal_encoding())
  array mb_east_asian_width_array(string $string, string $encoding = mb_internal_encoding(), array $table = null)
  int mb_east_asian_width(string $string, string $encoding = mb_internal_encoding(), array $table = null)
  ```

* `src/mb_str_pad_eaw.inc.php` (require `src/mb_east_asian_width.inc.php`)
  ```
   string mb_str_pad_eaw(string $input, int $pad_length, string $pad_string = ' ', int $pad_type = STR_PAD_RIGHT, $encoding = mb_internal_encoding(), $table = null))
  ```

## Getting Started
```
require_once 'php-eaw/src/mb_east_asian_width.php';
```

## License
php-eaw is licensed under the MIT license.

# make-library
Convert `PHP` code to `C/C++` header file

## Edit `__init__.php`

Edit the `__init__.php` file in the source code directory, the `make-library` script will read this file to configuration.

```php
# file: __init__.php
<?php
return [
    'name' => 'swoole',  // Library name
    'checkFileChange' => false, // Check if there are uncommitted changes in the git repository
    'output' => '/your/c_header_file_path', // Generated C/C++ header file path
    'stripComments' => true, // Whether to keep comments
    /* Notice: Sort by dependency */
    'files' => [
        # <basic> #
        'constants.php',
        # <std> #
        'std/exec.php',
        # <core> #
        'core/Constant.php',
        # ... more files #
    ]
];
```

## Make header file
```
composer require swoole/make-library
vendor/bin/make-library.php ./src
```

The first parameter is the source code path, there must exist `__init__.php` in this directory.

## Loader library in php extension
```c
#include "php_{$libaryName}_library.h"

// execute in RINIT function
php_{$libaryName}_load_library();
```

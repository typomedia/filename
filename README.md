# filename-normalizer

A string normalizer for filesystem name.

[![Build Status](https://travis-ci.org/glensc/php-filename-normalizer.png?branch=master)](https://travis-ci.org/glensc/php-filename-normalizer)

## Install

    $ composer require glen/filename-normalizer


## Usage

```php
<?php

use glen\FilenameNormalizer\Normalizer;

echo Normalizer::normalize("foo?bar/baz?qux.txt");  // replace to "foo-bar-baz-qux.txt"
```


## Api

### Normalizer::normalize($name, $replacement = "-");

Replace characters cannot be used in a filename.


## See also

* [File names and file name extensions: frequently asked questions (Windows)](http://windows.microsoft.com/en-us/windows/file-names-extensions-faq)
* [OS X: Cross-platform filename best practices and conventions (OSX)](https://support.apple.com/en-us/HT202808)



## License

Licensed under the MIT License.

Copyright (c) 2015 Yosuke Kumakura
Copyright (c) 2018 Elan Ruusamäe

Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.

# clue/hexdump

This is most commonly used to view binary data from streams
or sockets while debugging, but can be used to view any string
with non-viewable characters.

## Usage

```php

$dumper = new Clue\Hexdump\Hexdump();
echo $dumper->dump("this string \x12\x15\x16 contains \x00 binary \x04 data");

```

## License

All credits go to Aidan Lister. This library is based off his work
https://github.com/aidanlister/code/blob/master/function.hexdump.php
which has been released as public domain.

This library merely a standalone version that can easily be installed via
composer. It's released under the terms of the permisse MIT license.


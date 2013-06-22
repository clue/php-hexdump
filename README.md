# clue/hexdump

View any (binary) string as a hexdump

This is most commonly used to view binary data from streams
or sockets while debugging, but can be used to view any string
with non-viewable characters.

## Usage

Once [installed](#install), using this library is as simple as running:

```php
$dumper = new Clue\Hexdump\Hexdump();
echo $dumper->dump("this string \x12\x15\x16 contains \x00 binary \x04 data");
```

Its output will look something like this:

<pre>
0000  74 68 69 73 20 73 74 72  69 6e 67 20 12 15 16 20   this str ing ... 
0010  63 6f 6e 74 61 69 6e 73  20 00 20 62 69 6e 61 72   contains  . binar
0020  79 20 04 20 64 61 74 61                            y . data
</pre>

## Install

The recommended way to install this library is [through composer](http://getcomposer.org). [New to composer?](http://getcomposer.org/doc/00-intro.md)

```JSON
{
    "require": {
        "clue/hexdump": "0.1.*"
    }
}
```

## License

All credits go to Aidan Lister. This library is based on
[his work](https://github.com/aidanlister/code/blob/master/function.hexdump.php)
which has been released as public domain.

This library is merely a standalone version that can be easily installed via
composer. It's released under the terms of the permissive MIT license.


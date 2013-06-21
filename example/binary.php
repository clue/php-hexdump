<?php

require __DIR__ . '/../vendor/autoload.php';

$dumper = new Clue\Hexdump\Hexdump();
echo $dumper->dump("this string \x12\x15\x16 contains \x00 binary \x04 data");

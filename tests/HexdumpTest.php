<?php

use Clue\Hexdump\Hexdump;

require __DIR__ . '/../vendor/autoload.php';

class HexdumpTest extends PHPUnit_Framework_TestCase
{
    public function testEmptyString()
    {
        $dumper = new Hexdump();

        $this->assertEquals("\n", $dumper->dump(''));
        $this->assertEquals("<pre>\n</pre>\n", $dumper->dumpHtml(''));
    }

    public function testSingleCharacter()
    {
        $dumper = new Hexdump();

        $expected = <<<EOT
0000  61                                                 a

EOT;

        $this->assertEquals($expected, $dumper->dump('a'));

        $expectedHtml = <<<EOT
<pre>
0000  61                                                 a
</pre>

EOT;

        $this->assertEquals($expectedHtml, $dumper->dumpHtml('a'));
    }

    public function testTenCharactersFitInSingleLine()
    {
        $dumper = new Hexdump();

        $expected = "0000  61 62 63 64 65 66 67 68  69 6a                     abcdefgh ij\n";

        $this->assertEquals($expected, $dumper->dump('abcdefghij'));
    }

    public function testSixtenCharactersFitInSingleLine()
    {
        $dumper = new Hexdump();

        $expected = "0000  61 62 63 64 65 66 67 68  69 6a 6b 6c 6d 6e 6f 70   abcdefgh ijklmnop\n";

        $this->assertEquals($expected, $dumper->dump('abcdefghijklmnop'));
    }

    public function testHtmlShouldBeEscaped()
    {
        $dumper = new Hexdump();

        $expected = <<<EOT
0000  3c 73 63 72 69 70 74 20  74 79 70 65 3d 22 74 65   <script  type="te
0010  78 74 2f 6a 61 76 61 73  63 72 69 70 74 22 3e      xt/javas cript">

EOT;

        $this->assertEquals($expected, $dumper->dump('<script type="text/javascript">'));

        $expectedHtml = <<<EOT
<pre>
0000  3c 73 63 72 69 70 74 20  74 79 70 65 3d 22 74 65   &lt;script  type="te
0010  78 74 2f 6a 61 76 61 73  63 72 69 70 74 22 3e      xt/javas cript"&gt;
</pre>

EOT;

        $this->assertEquals($expectedHtml, $dumper->dumpHtml('<script type="text/javascript">'));
    }

    public function testBinaryMixedString()
    {
        $dumper = new Hexdump();

        $expected = <<<EOT
0000  74 68 69 73 0a 0d 63 6f  6e 74 61 69 6e 73 00 01   this..co ntains..
0010  02 03 62 69 6e 61 72 79                            ..binary

EOT;

        $this->assertEquals($expected, $dumper->dump("this\n\rcontains\x00\x01\x02\x03binary"));

        $expectedHtml = <<<EOT
<pre>
0000  74 68 69 73 0a 0d 63 6f  6e 74 61 69 6e 73 00 01   this..co ntains..
0010  02 03 62 69 6e 61 72 79                            ..binary
</pre>

EOT;

        $this->assertEquals($expectedHtml, $dumper->dumpHtml("this\n\rcontains\x00\x01\x02\x03binary"));
    }
}

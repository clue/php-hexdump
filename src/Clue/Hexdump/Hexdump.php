<?php

namespace Clue\Hexdump;

/**
 * View any string as a hexdump
 *
 * This is most commonly used to view binary data from streams
 * or sockets while debugging, but can be used to view any string
 * with non-viewable characters.
 */
class Hexdump
{
    /**
     * @var bool Set to true for uppercase hex
     */
    private $uppercase = false;

    /**
     * @var bool Set to false for non-HTML output
     */
    private $htmloutput = false;

    /**
     * View any string as a hexdump.
     *
     * @version     1.3.2
     * @author      Aidan Lister <aidan@php.net>
     * @author      Peter Waller <iridum@php.net>
     * @link        http://aidanlister.com/2004/04/viewing-binary-data-as-a-hexdump-in-php/
     * @param       string  $data        The string to be dumped
     */
    function dump ($data)
    {
        // Init
        $hexi   = '';
        $ascii  = '';
        $dump   = ($this->htmloutput === true) ? '<pre>' : '';
        $offset = 0;
        $len    = strlen($data);

        // Upper or lower case hexadecimal
        $x = ($this->uppercase === false) ? 'x' : 'X';

        // Iterate string
        for ($i = $j = 0; $i < $len; $i++)
        {
            // Convert to hexidecimal
            $hexi .= sprintf("%02$x ", ord($data[$i]));

            // Replace non-viewable bytes with '.'
            if (ord($data[$i]) >= 32) {
                $ascii .= ($this->htmloutput === true) ?
                    htmlentities($data[$i]) :
                    $data[$i];
            } else {
                $ascii .= '.';
            }

            // Add extra column spacing
            if ($j === 7) {
                $hexi  .= ' ';
                $ascii .= ' ';
            }

            // Add row
            if (++$j === 16 || $i === $len - 1) {
                // Join the hexi / ascii output
                $dump .= sprintf("%04$x  %-49s  %s", $offset, $hexi, $ascii);

                // Reset vars
                $hexi   = $ascii = '';
                $offset += 16;
                $j      = 0;

                // Add newline
                if ($i !== $len - 1) {
                    $dump .= "\n";
                }
            }
        }

        // Finish dump
        $dump .= $this->htmloutput === true ?
                '</pre>' :
                '';
        $dump .= "\n";

        return $dump;
    }
}

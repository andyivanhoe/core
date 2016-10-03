<?php

namespace Freesewing;

/**
 * Freesewing\SvgBlock class.
 *
 * @author Joost De Cock <joost@decock.org>
 * @copyright 2016 Joost De Cock
 * @license http://opensource.org/licenses/GPL-3.0 GNU General Public License, Version 3
 */
abstract class SvgBlock
{
    abstract public function load();

    private $data;

    public function __toString()
    {
        $data = '';
        if(is_array($this->data)) {
            foreach ($this->data as $origin) {
                $data .= implode("\n    ", $origin);
            }
        }

        return $data;
    }

    public function add($data)
    {
        $caller = debug_backtrace()[0]['file'];
        if (!@is_array($this->data[$caller])) {
            $this->data[$caller] = array();
        }
        foreach (explode("\n", $data) as $line) {
            array_push($this->data[$caller], $line);
        }
    }
}
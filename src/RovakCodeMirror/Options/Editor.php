<?php

namespace RovakCodeMirror\Options;

use Zend\Stdlib\AbstractOptions;

class Editor extends AbstractOptions
{
    protected $modes = array();
    protected $libPath;

    public function getModes()
    {
        return $this->modes;
    }

    public function setModes(array $modes)
    {
        $this->modes = $modes;
    }

    /**
     * Return a single mode
     * 
     * @param string $mode
     * @return array
     */
    public function getMode($mode)
    {
        if (!array_key_exists($mode, $this->modes)) {
            return null;
        }

        return $this->modes[$mode];
    }

    public function getLibPath()
    {
        return $this->libPath;
    }

    public function setLibPath($libPath)
    {
        $this->libPath = $libPath;
    }

}
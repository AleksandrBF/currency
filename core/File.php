<?php

class File
{
    protected $pathFile;

    public function __construct($path)
    {
        $this->pathFile = $path;
    }

    public function getFile()
    {
        if (file_exists($this->pathFile)) {
            return file_get_contents($this->pathFile);
        }
        return false;
    }

    public function setFile($value)
    {
        return file_put_contents($this->pathFile, $value);
    }

}
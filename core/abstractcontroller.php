<?php

abstract class AbstractController
{
    protected $view;
    protected $settings;

    public function __construct($view)
    {
        $this->view = $view;
        if (empty($this->settings)){
            $this->settings = new Settings(SETTINGSFILE);
        }
    }

    public function error()
    {
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
    }

    abstract protected function render ($str);
}
<?php


class View
{
    private $dir_template;

    public function __construct($dir_template)
    {
        $this->dir_template = $dir_template;
    }

    public function render ($file, $params, $return = false)
    {
        $template = $this->dir_template.$file.'.tpl';
        if (file_exists($template)) {
            extract($params);
            ob_start();
            include ($template);
            if ($return) return ob_get_clean();
            echo ob_get_clean();
        } else {
            return false;
        }
    }


}
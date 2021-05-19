<?php

class Settings
{
    private $actualSettings = ['itemPage', 'currencies'];
    private $file;
    private $settings = [
        'itemPage' => 5,
        'currencies' => [
            'UAH' => 'Гривня'
        ]
    ];

    public function __construct($path)
    {
        $this->file = new File($path);
        $this->init();
    }

    private function init()
    {
        $settings = $this->file->getFile();
        if ($settings) {
            $settings = json_decode($settings, true);

            $this->settings['currencies'] = array_merge($this->settings['currencies'], $settings['currencies']);
            $this->settings = $settings;
        }
    }

    public function getSettings()
    {
        return $this->settings;
    }

    public function setSettings($name, $value)
    {
        if (in_array($name, $this->actualSettings)){
            if ($name === 'currencies'){
                $value = array_merge(['UAH' => 'Гривня'], $value);
            }
            $this->settings[$name] = $value;
            return true;
        }
        return false;
    }

    public function save()
    {
        return $this->file->setFile(json_encode($this->settings));
    }
}
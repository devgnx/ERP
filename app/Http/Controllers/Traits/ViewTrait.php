<?php

namespace App\Http\Controllers\Traits;

trait ViewTrait
{
    public function __construct()
    {
        $this->setViewFolder($this->viewFolder);
    }

    public function getViewFolder()
    {
        return $this->viewFolder;
    }

    public function setViewFolder($viewFolder)
    {
        return $this->fixViewFolder($viewFolder);
    }

    private function fixViewFolder($viewFolder)
    {

        if (strpos($this->viewFolder, -1) != '.') {
            $this->viewFolder = $viewFolder . '.';
        } else {
            $this->viewFolder = $viewFolder;
        }

        return $this;
    }
}
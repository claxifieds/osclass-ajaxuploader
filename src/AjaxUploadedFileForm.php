<?php

class AjaxUploadedFileForm
{
    private $_file;

    function __construct()
    {
        $this->_file = Params::getFiles('qqfile');
    }

    public function save($path)
    {
        return move_uploaded_file($this->_file['tmp_name'], $path);
    }

    public function getOriginalName()
    {
        return $this->_file['name'];
    }

    public function getSize()
    {
        return $this->_file['size'];
    }
}

<?php

class AjaxUploadedFileXhr
{
    function __construct()
    {
    }

    public function save($path)
    {
        $input = fopen("php://input", "r");
        $temp = tmpfile();
        $realSize = stream_copy_to_stream($input, $temp);
        fclose($input);
        if ($realSize != $this->getSize()) {
            return false;
        }
        $target = fopen($path, "w");
        fseek($temp, 0, SEEK_SET);
        stream_copy_to_stream($temp, $target);
        fclose($target);
        return true;
    }

    public function getOriginalName()
    {
        return Params::getParam('qqfile');
    }

    public function getSize()
    {
        if (Params::existServerParam("CONTENT_LENGTH")) {
            return (int)Params::getServerParam("CONTENT_LENGTH");
        } else {
            throw new Exception(__('Getting content length is not supported.'));
        }
    }
}

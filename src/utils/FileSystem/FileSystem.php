<?php
namespace Util\FileSystem;

class FileSystem
{
    static public function mkdir($dir = '', $mode = 0777)
    {
        if(!is_dir($dir))
            mkdir($dir, $mode, TRUE);
    }

    static public function read_file($path = '')
    {
        return is_file($path) ? file_get_contents($path) : FALSE;
    }
}

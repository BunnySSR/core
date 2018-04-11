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

    static public function retrieve_file($paths = [])
    {
        foreach($paths as $path) {
            $file = self::read_file($path);

            if($file !== FALSE)
                return $file;
        }

        return FALSE;
    }
}

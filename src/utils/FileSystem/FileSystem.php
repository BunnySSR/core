<?php
namespace Util\FileSystem;

class FileSystem
{
    static public function mkdir($dir = '', $mode = 0777)
    {
        if(!is_dir($dir))
            mkdir($dir, $mode, TRUE);
    }
}

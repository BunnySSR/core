<?php
namespace Util\Loader;

use Util\Json\Parser as JsonParser;

class Config
{
    private $root = '';

    public $config = [];

    public function __construct($dir = '')
    {
        $this->set_root($dir);
    }

    public function set_root($dir = '')
    {
        $this->root = realpath($dir);
    }

    public function init()
    {
        $this->config = [];
    }

    public function get($path = '')
    {
        $this->init();

        $path = preg_replace('/(.+)\.json/iu', '$1', $path);
        $path = $this->root . DIRECTORY_SEPARATOR . $path . '.json';

        $content = is_file($path) ? file_get_contents($path) : FALSE;
        $content = JsonParser::parse($content);

        $this->config = $content;

        return $content;
    }
}

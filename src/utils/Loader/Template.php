<?php
namespace Util\Loader;

class Template
{
    private $root         = '';
    private $compile_root = '';
    private $engine_name  = [];

    public $template = '';
    public $filepath = '';
    public $filename = '';
    public $engine   = '';

    public function __construct($dir = '')
    {
        $this->set_root($dir);
    }

    public function set_root($dir = '')
    {
        $this->root = realpath($dir);
    }

    public function set_compile_root($dir = '')
    {
        $this->compile_root = realpath($dir);
    }

    public function set_engine($engine_name = [])
    {
        if(!empty($engine_name) && is_array($engine_name))
            $this->engine_name = $engine_name;
        else
            $this->engine_name = [];
    }

    public function init()
    {
        $this->template = '';
        $this->filepath = '';
        $this->filename = '';
        $this->engine   = '';
    }

    public function get($name = '')
    {
        $this->init();

        $filename = preg_replace('/(.+)\.(' . implode('|', $this->engine_name) . ')\.tpl/iu', '$1', $name);

        // Find for templates
        foreach($this->engine_name as $engine) {
            $filepath = $this->root . DIRECTORY_SEPARATOR . "{$filename}.{$engine}.tpl";
            $content  = is_file($filepath) ? file_get_contents($filepath) : FALSE;

            if($content !== FALSE && is_string($content)) {
                $this->template = empty($content) ? '' : (string)$content;
                $this->filepath = $filepath;
                $this->filename = $filename;
                $this->engine   = $engine;
                break;
            }
        }

        return $this->template;
    }

    public function render($data = [])
    {
        // echo $this->filepath;
        switch($this->engine) {
            case 'smarty':
                $template = new \Smarty();
                $template->setCompileDir($this->compile_root);
                $template->assign('data', $data);
                $template->assign('get', $_GET);
                $template->assign('post', $_POST);
                $template->display($this->filepath);
                exit;
            default:
                exit;
        }
    }
}

<?php
namespace Util\Loader;

class Template
{
    private $root = '';

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

        $filename = preg_replace('/(.+)\.(twig|smarty).tpl/iu', '$1', $name);
        $finder = [
            'smarty' => $filename . '.smarty.tpl'
        ];

        foreach($finder as $engine => $path) {
            $filepath = $this->root . DIRECTORY_SEPARATOR . $path;
            $content  = is_file($filepath) ? file_get_contents($filepath) : '';

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

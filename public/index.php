<?php
define('APP_ROOT', dirname(__DIR__));

require APP_ROOT . '/vendor/autoload.php';

use Util\Api\Getter      as ApiGetter;
use Util\Loader\Config   as ConfigLoader;
use Util\Loader\Template as TemplateLoader;

$service = empty($_GET['service']) ? '' : $_GET['service'];
unset($_GET['service']);

$api      = new ApiGetter();
$config   = new ConfigLoader();
$template = new TemplateLoader();
$setting  = new ConfigLoader();

# Global Settings
$setting->set_root(APP_ROOT . '/setting/');
$engine_name = $setting->get('engine_name');

# API Config
$config->set_root(APP_ROOT . '/src/config/');
$options = $config->get($service);

# Template
$template->set_root(APP_ROOT . '/src/pages/');
$template->set_engine($engine_name);
$page = $template->get($service);

# Render Template
$data = $api->load($options);
$template->render($data);

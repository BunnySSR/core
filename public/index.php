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

$template->set_root(APP_ROOT . '/src/pages/');
$config->set_root(APP_ROOT . '/src/config/');

$options = $config->get($service);
$page    = $template->get($service);
$data    = $api->load($options);

$template->render($data);

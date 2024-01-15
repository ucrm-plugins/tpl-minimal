<?php /** @noinspection DuplicatedCode, PhpUnused, PhpUnhandledExceptionInspection */
declare(strict_types=1);

use DI\ContainerBuilder;
use SpaethTech\UCRM\SDK\Plugin;

require_once __DIR__."/vendor/autoload.php";

$builder = new ContainerBuilder();
$builder->addDefinitions("config.php");
$container = $builder->build();

$plugin = new Plugin($container);
$logger = $plugin->getLogger();

$logger->warning("Manual/Scheduled execution of this Plugin currently does nothing!");

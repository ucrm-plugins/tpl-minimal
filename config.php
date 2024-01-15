<?php /** @noinspection DuplicatedCode, PhpUnused, PhpMultipleClassDeclarationsInspection */
declare(strict_types=1);

use GuzzleHttp\Client;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Http\Client\ClientInterface;
use Psr\Log\LoggerInterface;
use SpaethTech\UCRM\SDK\Plugin;
use SpaethTech\UCRM\SDK\PluginUcrm;
use SpaethTech\UCRM\SDK\Support\UrlWrapper;

$ucrm = new PluginUcrm();

return [
    "plugin.root" => __DIR__,

    LoggerInterface::class => DI\create(Logger::class)
        ->constructor("plugin")
        ->method("pushHandler", new StreamHandler("data/plugin.log")),

    ClientInterface::class => DI\create(Client::class)
        ->constructor([
            // Use the local UCRM API URL as the base for requests.
            "base_uri" => (string)($url = new UrlWrapper(
                sprintf("%s/api/v1.0/", rtrim($ucrm->get("ucrmLocalUrl"), "/")))),

            // If the URL is localhost over HTTPS, do not verify SSL certificate.
            "verify" => !$url->isSecureLocalhost(),

            // Disable Exceptions on non 2XX codes, we'll handle them ourselves.
            //"http_errors" => false,

            // Include the App Key, even if it may not be needed in all requests.
            "headers" => [
                "x-auth-app-key" => $ucrm->get("pluginAppKey"),
            ],
        ])



    // ...
];

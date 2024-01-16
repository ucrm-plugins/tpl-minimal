<?php
declare(strict_types=1);

const DEFAULT_JSON_OPTIONS = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES;

$name = $argv[1];

// composer.json replacements...
if(file_exists($file = "composer.json"))
{
    $json = json_decode(file_get_contents($file), TRUE);
    $json["name"] = "ucrm-plugins/ext-$name";
    file_put_contents($file, json_encode($json, DEFAULT_JSON_OPTIONS));
}

// manifest.json replacements...
if(file_exists($file = "manifest.json"))
{
    $json = json_decode(file_get_contents($file), TRUE);
    $json["information"]["name"] = $name;
    file_put_contents($file, json_encode($json, DEFAULT_JSON_OPTIONS));
}

// Remove this template.php script!
unlink("template.php");

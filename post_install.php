<?php

$template = <<<JSON
{ 
  "disabled": [],
  "hooks": {
    "pre-commit": [
      "composer run-script ecs:check"
    ],
    "pre-push": [
      "composer run-script test"
    ]
  }
}
JSON;
    
$filename = __DIR__ . '/whisky.json';

if (!file_exists($filename)) {
    echo "whisky.json file not found. Creating...\n";

    echo "Ejecutando instalación de whisky...\n";
    system(__DIR__ . '/vendor/bin/whisky install');
    echo "whisky.json file created.\n";

    echo "Coping template into whisky.json file...\n";
    print_r(json_encode($template, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
    file_put_contents($filename, $template);

    system(__DIR__ . '/vendor/bin/whisky update');
}

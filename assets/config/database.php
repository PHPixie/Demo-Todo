<?php

$root = realpath(__DIR__.'/../../');

return array(
    'default' => array(
        'driver' => 'pdo',
        'connection' => "sqlite:$root/database.sqlite"
    )
);
<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 18.08.2017 14:18
 */

use GuzzleHttp\Client;
use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;

require '../vendor/autoload.php';
$config = require_once 'config.php';
$app = new DropboxApp($config['client'], $config['secret'], $config['token']);

$dropbox = new Dropbox($app, [
    'http_client_handler' => new Client([
        'curl' => [
            CURLOPT_SSL_VERIFYPEER => false
        ]
    ])
]);

$list = $dropbox->listFolder('/')->getItems();

require 'template/table.php';
<?php
/**
 * @author Pavel Tsydzik <xagero@gmail.com>
 * @date 18.08.2017 15:08
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

$list = $_POST['download'];

if (empty($list)) {
    die('Файлы не выбраны');
}

$filename = "./download.zip";
if (file_exists($filename)) unlink($filename);
$zip = new ZipArchive();
if ($zip->open($filename, ZipArchive::CREATE) !== TRUE) {
    exit("Невозможно открыть <$filename>\n");
}

if ($list) foreach ($list as $link) {
    $local = '/data' . $link;
    $file = $dropbox->download($link, $local);
    $zip->addFile($local, mb_substr($local, 5));
}

$zip->close();

header('Cache-control: private');
header('Content-Type: application/octet-stream');
header('Content-Length: '.filesize($filename));
header('Content-Disposition: filename=download.zip');

flush();
$file = fopen($filename, "r");
while(!feof($file)) {
    // send the current file part to the browser
    print fread($file, round(1024));
    // flush the content to the browser
    flush();
}
fclose($file);

if (file_exists($filename)) unlink($filename);

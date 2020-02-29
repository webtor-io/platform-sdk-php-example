<?php
require __DIR__ . '/vendor/autoload.php';

$torrentUrl = 'https://github.com/webtorrent/webtorrent.io/blob/master/static/torrents/sintel.torrent?raw=true';
$data = file_get_contents($torrentUrl);

$sdk = new Webtor\SDK([
    'apiUrl'           => 'https://api.webtor.io',
    // 'grpcAddr'         => '127.0.0.1:50051',
    'grpcAddr'         => 'grpc.webtor.io:443',
    'apiKey'           => 'your_api_key',
    'secret'           => 'your_secret',
    'grpcCredentials'  => \Grpc\ChannelCredentials::createSsl(),
]);

$infoHash = $sdk->torrent()->push($data);
$url = $sdk->seeder($infoHash)->url('/Sintel/Sintel.mp4');
echo($url);
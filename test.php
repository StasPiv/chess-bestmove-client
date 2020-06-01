<?php

use GuzzleHttp\Client;

require_once 'vendor/autoload.php';

$client = new \StasPiv\ChessBestMoveClient\Client(
    new Client([
        'base_uri' => 'http://127.0.0.1:8001'
    ])
);

$move = $client->getBestMoveFromFen('rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR w KQkq - 0 1');
echo $move . PHP_EOL . $move->getScore();
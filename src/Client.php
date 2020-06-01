<?php

namespace StasPiv\ChessBestMoveClient;

use GuzzleHttp\Client as WebClient;
use JMS\Serializer\SerializerBuilder;

class Client
{
    /**
     * @var WebClient
     */
    private WebClient $webClient;

    /**
     * Client constructor.
     *
     * @param WebClient $webClient
     */
    public function __construct(WebClient $webClient)
    {
        $this->webClient = $webClient;
    }

    /**
     * @param string $fen
     * @param int    $moveTime
     *
     * @return Move
     */
    public function getBestMoveFromFen(string $fen, int $moveTime = 3000): Move
    {
        $response = $this->webClient->get('bestmove', [
            'query' => [
                'fen'      => $fen,
                'movetime' => $moveTime
            ]
        ])->getBody();

        $move = SerializerBuilder::create()->build()
            ->deserialize($response, Move::class, 'json');

        if (!$move instanceof Move) {
            return new Move();
        }

        return $move;
    }
}
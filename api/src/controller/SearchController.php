<?php

namespace Controllers; 
use Psr\Http\Message\ResponseInterface ;
use Psr\Http\Message\ServerRequestInterface;

final class SearchController{

    public function gets(ServerRequestInterface $request, ResponseInterface $response){
        try {
            $service = new \Services\SearchService; 
            $result =  $service->infoRequest();
            $response->getBody()->write($result);
            return $response->withHeader('Content-Type','application/json')->withStatus(200);

        } catch (\Throwable $error) {
            throw $error;
        }
    }
}
    
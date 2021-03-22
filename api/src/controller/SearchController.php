<?php

namespace Controllers; 
use Psr\Http\Message\ResponseInterface ;
use Psr\Http\Message\ServerRequestInterface;

final class SearchController{
    
    public function info(ServerRequestInterface $request, ResponseInterface $response){
        try {
            $service = new \Services\SearchService; 
            $result =  $service->requiredInfo();
            if($result === []){
                $data = array('Msg' => 'No se encontraron resultados', 'Status' => 404);
                $response->getBody()->write(json_encode($data));
                return $response->withStatus(404)->withHeader('Content-Type', 'application/json');
            }
            $response->getBody()->write($result);
            $response->withStatus(200);
            return $response->withHeader('Content-Type','application/json');

        } catch (\Throwable $error) {
            throw $error;
        }
    }
}
    
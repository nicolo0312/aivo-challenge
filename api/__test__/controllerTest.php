<?php

namespace Test;

final class SearchControllerTest extends \PHPUnit\Framework\TestCase{
    
    public function testGet(){
        $controller = \Controllers\SearchController;
        $get        =  $controller->get();
        
    }
}
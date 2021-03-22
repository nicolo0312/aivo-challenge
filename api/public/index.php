<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Psr\Container\ContainerInterface;
use DI\ContainerBuilder;

require __DIR__ . '/../vendor/autoload.php';

/**
 * Instantiate App
 *
 * In order for the factory to work you need to ensure you have installed
 * a supported PSR-7 implementation of your choice e.g.: Slim PSR-7 and a supported
 * ServerRequest creator (included with Slim PSR-7)
 */



 
$containerBuilder = new ContainerBuilder();
AppFactory::setContainer($containerBuilder->build());
$app = AppFactory::create();


// ...

$container = $app->getContainer();

$container->set('SearchController', function (ContainerInterface $container) {    
    return new \Controllers\SearchController;
});

// Add Routing Middleware
$app->addRoutingMiddleware();
$app->addBodyParsingMiddleware();

/**
 * Add Error Handling Middleware
 *
 * @param bool $displayErrorDetails -> Should be set to false in production
 * @param bool $logErrors -> Parameter is passed to the default ErrorHandler
 * @param bool $logErrorDetails -> Display error details in error log
 * which can be replaced by a callable of your choice.
 
 * Note: This middleware should be added last. It will not handle any exceptions/errors
 * for middleware added after it.
 */
$errorMiddleware = $app->addErrorMiddleware(true, true, true);

// Define app routes

$app->get('/youtube', \SearchController::class . ':info');



// Run app
$app->run();
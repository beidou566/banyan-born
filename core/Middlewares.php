<?php

declare(strict_types=1);

use Slim\App;

return static function (App $app): void {
    $path = $_SERVER['SLIM_BASE_PATH'] ?? '';
    $app->setBasePath($path);
    $app->addRoutingMiddleware();
    $app->addBodyParsingMiddleware();
    $displayError = filter_var(
        $_SERVER['DISPLAY_ERROR_DETAILS'] ?? false,
        FILTER_VALIDATE_BOOLEAN
    );

    $errorMiddleware = $app->addErrorMiddleware($displayError, true, true);
    $customErrorHandler = require __DIR__ . '/ErrorHandler.php';
    $errorMiddleware->setDefaultErrorHandler($customErrorHandler);
};

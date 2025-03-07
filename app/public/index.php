<?php

/**
 * Setup
 */

// require autoload file to autoload vendor libraries
require_once __DIR__ . '/../vendor/autoload.php';

// require local classes
use App\Services\EnvService;
use App\Services\ErrorReportingService;
use App\Services\ResponseService;
use App\Controllers\ArticleController;
use App\Controllers\AuthController;

// require vendor libraries
use Steampixel\Route;

// initialize global environment variables
EnvService::Init();

// initialize error reporting (on in local env)
ErrorReportingService::Init();

// set CORS headers
ResponseService::SetCorsHeaders();

/**
 * Main application routes
 */
// top level fail-safe try/catch
try {
    /**
     * Auth routes
     */
    Route::add('/auth/register', function () {
        $authController = new AuthController();
        $authController->register();
    }, ["post"]);

    Route::add('/auth/login', function () {
        $authController = new AuthController();
        $authController->login();
    }, ["post"]);

    Route::add('/auth/me', function () {
        $authController = new AuthController();
        $authController->me();
    }, ["get"]);

    // update article by id
    Route::add('/auth/is-me/([0-9]*)', function ($id) {
        $authController = new AuthController();
        $authController->isMe($id);
    }, 'get');

    /**
     * Article routes
     */
    // paginated get all articles route: /articles?page=1
    Route::add('/articles', function () {
        $articleController = new ArticleController();
        $articleController->getAll();
    });
    // get article by id
    Route::add('/articles/([a-z-0-9-]*)', function ($id) {
        $articleController = new ArticleController();
        $articleController->get($id);
    });
    // create article route
    Route::add('/articles', function () {
        $articleController = new ArticleController();
        $articleController->create($_POST);
    }, ["post"]);
    // update article by id
    Route::add('/articles/([0-9]*)', function ($id) {
        sleep(3); // adding a timeout to demonstrate UI loading state
        $articleController = new ArticleController();
        $articleController->update($id);
    }, 'put');
    // delete article by id
    Route::add('/articles/([0-9]*)', function ($id) {
        $articleController = new ArticleController();
        $articleController->delete($id);
    }, 'delete');
    // generate qr code for article
    Route::add('/articles/qr-code/([a-z-0-9-]*)', function ($id) {
        $articleController = new ArticleController();
        $articleController->getQrCode($id);
    });

    /**
     * 404 route handler
     */
    Route::pathNotFound(function () {
        ResponseService::Error("route is not defined", 404);
    });
} catch (\Throwable $error) {
    if ($_ENV["environment" == "LOCAL"]) {
        var_dump($error);
    } else {
        error_log($error);
    }
    ResponseService::Error("A server error occurred");
}


Route::run();

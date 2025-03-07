<?php

// base controller, this is a good place to put shared functionality like authentication/authorization, validation, etc

namespace App\Controllers;

use App\Services\ResponseService;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Controller
{
    private $jwtKey;


    // ensures all expected fields are set in data object and sends a bad request response if not
    // used to make sure all expected $_POST fields are at least set, additional validation may still need to be set
    function validateInput($expectedFields, $data)
    {
        foreach ($expectedFields as $field) {
            if (!isset($data[$field])) {
                ResponseService::Send("Required field: $field, is missing", 400);
                exit();
            }
        }
    }

    // gets the post data and returns it as an array
    function decodePostData()
    {
        try {
            return json_decode(file_get_contents('php://input'), true);
        } catch (\Throwable $th) {
            ResponseService::Error("error decoding JSON in request body", 400);
        }
    }

    public function getAuthenticatedUser()
    {
        $headers = getallheaders();
        if (!isset($headers['Authorization'])) {
            ResponseService::Error('No token provided', 401);
        }

        // var_dump($headers['Authorization']);
        // var_dump($this->jwtKey);
        // die();

        $token = str_replace('Bearer ', '', $headers['Authorization']);
        $data = JWT::decode($token, new Key($_ENV["JWT_SECRET"], 'HS256'));
        return $data->user;

        try {
            return JWT::decode($token, new Key($_ENV["JWT_SECRET"], 'HS256'));
        } catch (\Exception $e) {
            ResponseService::Error('Invalid token', 401);
        }
    }
}

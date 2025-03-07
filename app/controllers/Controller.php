<?php

// base controller, this is a good place to put shared functionality like authentication/authorization, validation, etc

namespace App\Controllers;

use App\Services\ResponseService;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Controller
{

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
        // Get all HTTP headers from the request
        $headers = getallheaders();

        // Check if Authorization header exists in the request
        if (!isset($headers['Authorization'])) {
            ResponseService::Error('No token provided', 401);
        }

        // Remove 'Bearer ' prefix from the Authorization header to get the raw token
        $token = str_replace('Bearer ', '', $headers['Authorization']);

        try {
            // Verify and decode the JWT token using the secret key
            // If token is invalid or expired, this will throw an exception
            $token_data = JWT::decode($token, new Key($_ENV["JWT_SECRET"], 'HS256'));
            return $token_data->user;
        } catch (\Exception $e) {
            // Return 401 Unauthorized if token is invalid
            ResponseService::Error('Invalid token', 401);
        }
    }

    public function validateIsMe($id)
    {
        // Get the authenticated user from the JWT token
        $user = $this->getAuthenticatedUser();

        // Check if the authenticated user's ID matches the requested resource ID
        // Cast the requested ID to integer to ensure type-safe comparison
        if (empty($user) || $user->id !== (int)$id) {
            // Return 403 Forbidden if user tries to access another user's resource
            ResponseService::Error('You are not authorized to access this resource', 403);
            exit();
        }

        return $user;
    }
}

<?php

namespace App\Controllers;

use App\Models\User;
use App\Services\ResponseService;
use Firebase\JWT\JWT;

class AuthController extends Controller
{
    private $userModel;
    private $jwtKey;

    public function __construct()
    {
        $this->jwtKey = $_ENV["JWT_SECRET"];
        $this->userModel = new User();
    }

    public function register()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['email']) || !isset($data['password'])) {
            ResponseService::Error('Email and password are required', 400);
            return;
        }

        if ($this->userModel->findByEmail($data['email'])) {
            ResponseService::Error('Email already exists', 400);
            return;
        }

        try {
            $this->userModel->create($data['email'], $data['password']);
            return ResponseService::Send(['message' => 'User registered successfully']);
        } catch (\Exception $e) {
            ResponseService::Error('Registration failed', 500);
        }
    }

    public function login()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['email']) || !isset($data['password'])) {
            ResponseService::Error('Email and password are required', 400);
            return;
        }

        $user = $this->userModel->findByEmail($data['email']);

        if (!$user || !password_verify($data['password'], $user['password'])) {
            ResponseService::Error('Invalid credentials', 401);
            return;
        }

        $token = $this->generateJWT($user);
        ResponseService::Send(['token' => $token]);
    }

    public function me()
    {
        ResponseService::Send($this->getAuthenticatedUser());
    }

    private function generateJWT($user)
    {
        $issuedAt = time();
        $expire = $issuedAt + 3600 * 4; // 4 hours

        $payload = [
            'iat' => $issuedAt,
            'exp' => $expire,
            'user' => [
                'id' => $user['id'],
                'email' => $user['email']
            ]
        ];

        return JWT::encode($payload, $this->jwtKey, 'HS256');
    }
}

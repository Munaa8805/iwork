<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;
use Framework\Session;


class UserController
{
    protected $db;
    public function __construct()
    {
        $config = require basePath("config/_db.php");
        $this->db = new Database($config);
    }
    public function login()
    {

        loadView("auth/login");
    }

    public function create()
    {
        loadView("auth/create");
    }
    public function store()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $password = $_POST['password'];
        $password_confirmation = $_POST['password_confirmation'];
        $errors = [];
        // Validate name

        if (!Validation::email($email)) {
            $errors['email'] = "Invalid email address.";
        }
        if (!Validation::string($name, 2, 50)) {
            $errors['name'] = "Name must be between 2 and 50 characters.";
        }
        if (!Validation::string($city, 2, 50)) {
            $errors['name'] = "City must be between 2 and 50 characters.";
        }
        if (!Validation::string($state, 2, 50)) {
            $errors['name'] = "State must be between 2 and 50 characters.";
        }
        if (!Validation::string($password, 6, 50)) {
            $errors['name'] = "Password must be between 2 and 50 characters.";
        }
        if (!Validation::match($password, $password_confirmation)) {
            $errors['password'] = "Passwords do not match.";
        }

        if (!empty($errors)) {
            loadView("auth/create", [
                'errors' => $errors,
                "user" =>
                [
                    "name" => $name,
                    "email" => $email,
                    "city" => $city,
                    "state" => $state
                ]
            ]);
            exit;
        }

        //// Email exists
        $params = [
            'email' => $email,
        ];

        $existingUserEmail = $this->db->query("SELECT * FROM users WHERE email = :email", $params)->fetch();
        if ($existingUserEmail) {
            $errors['email'] = "Email already exists.";
            loadView("auth/create", [
                'errors' => $errors,
                "user" =>
                [
                    "name" => $name,
                    "email" => $email,
                    "city" => $city,
                    "state" => $state
                ]
            ]);
            exit;
        }
        //// Create user
        $params = [
            'name' => $name,
            'email' => $email,
            'city' => $city,
            'state' => $state,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ];
        $this->db->query("INSERT INTO users (name, email, city, state, password) VALUES (:name, :email, :city, :state, :password)", $params);


        //// Get new user id
        $userId = $this->db->conn->lastInsertId();
        Session::set('user', [
            'id' => $userId,
            'name' => $name,
            'email' => $email,
            'city' => $city,
            'state' => $state,
        ]);

        redirect('/auth/login');
    }
    public function logout()
    {
        Session::clear('user');
        Session::destroy();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain']);
        redirect('/');
    }

    public function authenticate()
    {
        // inspectAndDie("login");
        $email = $_POST['email'];
        $password = $_POST['password'];

        $errors = [];

        // Validation
        if (!Validation::email($email)) {
            $errors['email'] = 'Please enter a valid email';
        }

        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = 'Password must be at least 6 characters';
        }

        // Check for errors
        if (!empty($errors)) {
            loadView('auth/login', [
                'errors' => $errors
            ]);
            exit;
        }

        // Check for email
        $params = [
            'email' => $email
        ];

        $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

        if (!$user) {
            $errors['email'] = 'Incorrect credentials';
            loadView('auth/login', [
                'errors' => $errors
            ]);
            exit;
        }

        // Check if password is correct
        if (!password_verify($password, $user['password'])) {
            $errors['email'] = 'Incorrect credentials';
            loadView('auth/login', [
                'errors' => $errors
            ]);
            exit;
        }

        // Set user session
        Session::set('user', [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'city' => $user['city'],
            'state' => $user['state'],
        ]);

        redirect('/');
    }
}

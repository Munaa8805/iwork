<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Validation;


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


        redirect('/auth/login');

        inspectAndDie('store');
    }
}

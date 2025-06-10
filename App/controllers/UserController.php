<?php
/**
 * User Controller
 *
 * Provides the Register, Login and Logout capabilities
 * of the application
 *
 * Filename:        UserController.php
 * Location:        App/Controllers
 * Project:         XXX-SaaS-Vanilla-MVC-YYYY-SN
 * Date Created:    20/08/2024
 *
 * Author:          Adrian Gould <Adrian.Gould@nmtafe.wa.edu.au>
 *
 */

namespace App\Controllers;

use Framework\Database;
use Framework\Session;
use Framework\Validation;

class UserController
{

    /* Properties */

    /**
     * @var Database
     */
    protected $db;

    /**
     * UserController Constructor
     *
     * Instantiate the database connection for use in this class
     * storing the connection in the protected <code>$db</code>
     * property.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    /**
     * Show the login page
     *
     * @return void
     */
    public function login()
    {
        loadView('users/login');
    }

    /**
     * Show the register page
     *
     * @return void
     */
    public function create()
    {
        loadView('users/create');
    }

    /**
     * Store user in database
     *
     * @return void
     */
    public function store()
    {
        $givenName  = $_POST['given_name'] ?? '';
        $familyName = $_POST['family_name'] ?? '';
        $nickname   = $_POST['nickname'] ?? '';
        $email      = $_POST['email'] ?? '';
        $city       = $_POST['city'] ?? '';
        $state      = $_POST['state'] ?? '';
        $country    = $_POST['country'] ?? '';
        $password   = $_POST['password'] ?? '';
        $passwordConfirmation = $_POST['password_confirmation'] ?? '';

        $errors = [];

        // Validation
        if (!Validation::string($givenName, 1, 128)) {
            $errors['given_name'] = 'Given name must be a 1 ~ 128 character.';
        }

        if ($nickname === '') {
            $nickname = $givenName;
        }

        if (!Validation::string($nickname, 1, 32)) {
            $errors['nickname'] = 'Nickname은 must be 1 ~ 32 character.';
        }

        if (!Validation::email($email)) {
            $errors['email'] = 'Please enter a valid email address';
        }


        if (!Validation::string($password, 6, 50)) {
            $errors['password'] = 'Password must be at least 6 characters';
        }

        if (!Validation::match($password, $passwordConfirmation)) {
            $errors['password_confirmation'] = 'Passwords do not match';
        }

        if ($city === '') {
            $city = 'Unknown';
        }

        if ($state === '') {
            $state = 'Unknown';
        }

        if ($country === '') {
            $country = 'Australia';  //default
        }

        if (!empty($errors)) {
            loadView('users/create', [
                'errors' => $errors,
                'user' => [
                    'givenName' => $givenName,
                    'familyName' => $familyName,
                    'nickname' => $nickname,
                    'email' => $email,
                    'city' => $city,
                    'state' => $state,
                    'country' => $country
                ]
            ]);
            exit;
        }

        // Check if email exists
        $params = [
            'email' => $email
        ];

        $user = $this->db->query('SELECT * FROM users WHERE email = :email', $params)->fetch();

        if ($user) {
            $errors['email'] = 'That email already exists';
            loadView('users/create', [
                'errors' => $errors
            ]);
            exit;
        }

        // Create user account
        $params = [
            'given_name'  => $givenName,
            'family_name' => $familyName,
            'nickname'    => $nickname,
            'email' => $email,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];

        $this->db->query('INSERT INTO users (given_name, family_name, nickname, email, city, state, country, password) VALUES (:given_name, :family_name, :nickname, :email, :city, :state, :country, :password)', $params);

        // Get new user ID
        $userId = $this->db->conn->lastInsertId();

        // Set user session
        Session::set('user', [
            'id' => $userId,
            'given_name' => $givenName,
            'family_name' => $familyName,
            'nickname' => $nickname,
            'email' => $email,
            'city' => $city,
            'state' => $state,
            'country' => $country
        ]);

        redirect('/');
    }

    /**
     * Logout a user and kill session
     *
     * @return void
     */
    public function logout()
    {
        Session::clearAll();

        $params = session_get_cookie_params();
        setcookie('PHPSESSID', '', time() - 86400, $params['path'], $params['domain']);

        redirect('/');
    }

    /**
     * Authenticate a user with email and password
     *
     * @return void
     */
    public function authenticate()
    {
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
            loadView('users/login', [
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
            loadView('users/login', [
                'errors' => $errors
            ]);
            exit;
        }

        // Check if password is correct
        if (!password_verify($password, $user->password)) {
            $errors['email'] = 'Incorrect credentials';
            loadView('users/login', [
                'errors' => $errors
            ]);
            exit;
        }

        // Set user session
        Session::set('user', [
            'id' => $user->id,
            'given_name' => $user->given_name,
            'family_name' => $user->family_name,
            'nickname' => $user->nickname,
            'email' => $user->email,
            'city' => $user->city,
            'state' => $user->state,
            'country' => $user->country,
        ]);

        redirect('/');
    }

    public function edit()
    {
        $user = Session::get('user');

        if (!$user) {
            redirect('/auth/login');
        }

        loadView('users/edit', ['user' => $user]);
    }

    public function update()
    {
        $user = Session::get('user');
        if (!$user) {
            redirect('/auth/login');
        }

        $givenName = $_POST['given_name'] ?? '';
        $familyName = $_POST['family_name'] ?? '';
        $nickname = $_POST['nickname'] ?? '';
        $city = $_POST['city'] ?? '';
        $state = $_POST['state'] ?? '';
        $country = $_POST['country'] ?? '';

        $errors = [];

        if (!Validation::string($givenName, 1, 128)) {
            $errors['given_name'] = 'Given name must be 1 to 128 characters';
        }

        if (!Validation::string($nickname, 1, 32)) {
            $errors['nickname'] = 'Nickname must be 1 to 32 characters';
        }

        if (!empty($errors)) {
            loadView('users/edit', ['errors' => $errors, 'user' => $_POST]);
            exit;
        }

        $params = [
            'id' => $user['id'],
            'given_name' => $givenName,
            'family_name' => $familyName,
            'nickname' => $nickname,
            'city' => $city,
            'state' => $state,
            'country' => $country
        ];

        $this->db->query(
            'UPDATE users SET given_name = :given_name, family_name = :family_name, nickname = :nickname, city = :city, state = :state, country = :country WHERE id = :id',
            $params
        );

        Session::set('user', array_merge($user, $params));

        redirect('/dashboard');
    }

}
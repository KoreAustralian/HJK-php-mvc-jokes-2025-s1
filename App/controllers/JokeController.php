<?php
/**
 * JokeController.php
 *
 * Joke page
 *
 * Filename:        JokeController.php
 * Location:
 * Project:         HJK-SaaS-Vanilla-MVC-2025-S1
 * Date Created:    20/06/2024
 *
 * Author:          HongJaeKim <20115830@tafe.wa.edu.au>
 *
 */

namespace App\Controllers;


use App\Models\JokeModel;

class JokeController
{
    public static function index()
    {
        $query = $_GET['query'] ?? null;

        if ($query) {
            $jokes = JokeModel::searchByBody(db(), $query);
        } else {
            $jokes = JokeModel::all(db());
        }

        include basePath('App/views/jokes/index.view.php');
    }

    public static function show($params)
    {
        $joke = JokeModel::findWithCategoryAndAuthor(db(), $params['id']);

        if (!$joke) {
            $_SESSION['error'] = 'Joke not found.';
            redirect('/jokes');
        }

        include basePath('App/views/jokes/show.view.php');
    }

    public static function create()
    {
        $categories = ['Unknown Category', 'Classic', 'Pun', 'Dad Joke'];
        include basePath('App/views/jokes/create.view.php');
    }

    public static function store()
    {
        if (empty($_POST['title']) || empty($_POST['body']) || empty($_POST['category_id'])) {
            $_SESSION['error'] = 'Please fill out all required fields.';
            redirect('/jokes/create');
        }

        $author_id = $_SESSION['user']['id'] ?? 1;

        JokeModel::create(db(), [
            'title' => sanitize($_POST['title']),
            'body' => sanitize($_POST['body']),
            'category_id' => (int) $_POST['category_id'],
            'tags' => sanitize($_POST['tags']),
            'author_id' => $author_id
        ]);

        $_SESSION['success'] = 'Joke added successfully!';
        redirect('/jokes');
    }

    public static function edit($params)
    {
        $joke = JokeModel::findForEdit(db(), $params['id']);

        if (!$joke) {
            $_SESSION['error'] = 'Joke not found.';
            redirect('/jokes');
        }

        $categories = ['Unknown Category', 'Classic', 'Pun', 'Dad Joke'];

        include basePath('App/views/jokes/edit.view.php');
    }

    public static function update($params)
    {
        $id = $params['id'];

        if (empty($_POST['content']) || empty($_POST['category'])) {
            $_SESSION['error'] = 'All fields are required.';
            redirect("/jokes/edit/$id");
        }

        $data = [
            'content' => sanitize($_POST['content']),
            'category_id' => (int) $_POST['category'],
            'tags' => sanitize($_POST['tags'])
        ];

        JokeModel::update(db(), $id, $data);

        $_SESSION['success'] = "Joke ID $id updated successfully.";
        redirect('/jokes');
    }

    public static function destroy($params)
    {
        $id = $params['id'];
        JokeModel::delete(db(), $id);
        $_SESSION['success'] = "Joke deleted successfully.";
        redirect('/jokes');
    }
}
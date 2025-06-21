<?php
/**
 * Helper Functions
 *
 * Filename:        helpers.php
 * Location:        /
 * Project:         XXX-SaaS-Vanilla-MVC-YYYY-SN
 * Date Created:    13/03/2025
 *
 * Author:          Adrian Gould <Adrian.Gould@nmtafe.wa.edu.au>
 *
 */

use League\CommonMark\CommonMarkConverter;
use League\HTMLToMarkdown\HtmlConverter;

/**
 * Get the base path
 *
 * BasePath function to provide accurate paths to files
 *
 * @param string $path
 * @return string
 */
function basePath($path = '')
{
    return __DIR__ . '/' . $path;
}


/**
 * Load a view
 *
 * @param string $name
 * @return void
 */
function loadView($name, $data = [])
{
    $viewPath = basePath("App/views/{$name}.view.php");

    if (file_exists($viewPath)) {
        extract($data);
        require $viewPath;
    } else {
        echo "View '{$name} not found!'";
    }
}


/**
 * Load a partial
 *
 * @param string $name
 * @return string
 *
 */
function loadPartial($name, $data = [])
{
    $partialPath = basePath("App/views/partials/{$name}.view.php");

    if (file_exists($partialPath)) {
        extract($data);
        require $partialPath;
    } else {
        echo "Partial '{$name} not found!'";
    }
}


/**
 * Inspect a value(s)
 *
 * @param mixed $value
 * @return void
 */
function inspect($value)
{
    echo '<pre>';
    var_dump($value);
    /**
     * Inspect a value(s) and die
     *
     * @param mixed $value
     * @return void
     */
    function inspectAndDie($value)
    {
        inspect($value);
        die();
    }

    echo '</pre>';
}


/**
 * Dump the values of one or more variables, objects or similar.
 *
 * @return void
 */
function dump(): void
{
    echo "<pre class='bg-gray-100 color-black m-2 p-2 rounded shadow flex-grow text-sm'>";
    array_map(function ($x) {
        var_dump($x);
    }, func_get_args());
    echo "</pre>";
}


/**
 * Dump the values of one or more variables, objects or similar, then terminate the script.
 *
 * @return void
 */
function dd(): void
{
    echo "<pre class='bg-gray-100 color-black m-2 p-2 rounded shadow flex-grow text-sm'>";
    array_map(function ($x) {
        var_dump($x);
    }, func_get_args());
    echo "</pre>";
    die();
}


/**
 * Sanitize Data
 *
 * @param string $dirty
 * @return string
 */
function sanitize($dirty)
{
    return filter_var(trim($dirty), FILTER_SANITIZE_SPECIAL_CHARS);
}


/**
 * Redirect to a given url
 *
 * @param string $url
 * @return void
 */
function redirect($url)
{
    header("Location: {$url}");
    exit;
}


/**
 * Convert HTML to Markdown
 *
 * @param string $html HTML content to convert
 * @return string Markdown content
 */
if (!function_exists('htmlToMarkdown')) {
    function htmlToMarkdown($html) {
        $converter = new HtmlConverter([
            'header_style' => 'atx', // This ensures # style headers
            'strip_tags' => false,
            'remove_nodes' => 'script style',
        ]);
        return $converter->convert($html);
    }
}


/**
 * Convert Markdown to HTML
 *
 * @param string $markdown Markdown content to convert
 * @return string HTML content
 */
if (!function_exists('markdownToHtml')) {
    function markdownToHtml($markdown) {
        $config = [
            'html_input' => 'allow', // this ensures our font colours are displayed in the submissions view
            'allow_unsafe_links' => false,
        ];

        $converter = new GithubFlavoredMarkdownConverter($config);
        return $converter->convert($markdown);
    }
}

function db(): PDO
{
    static $pdo;

    if (!$pdo) {
        $config = require basePath('config/db.php');

        $dsn = "mysql:host={$config['host']};port={$config['port']};dbname={$config['dbname']};charset=utf8mb4";
        $pdo = new PDO($dsn, $config['username'], $config['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    return $pdo;
}


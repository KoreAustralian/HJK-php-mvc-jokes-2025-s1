<?php
/**
 * StaticPageController.php
 *
 * homw page with basic navigation and layout
 *
 * Filename:        StaticPageController.php
 * Location:
 * Project:         HJK-SaaS-Vanilla-MVC-2025-S1
 * Date Created:    20/06/2024
 *
 * Author:          HongJaeKim <20115830@tafe.wa.edu.au>
 *
 */

namespace App\Controllers;

class StaticPageController
{
    /**
     * Show the home page
     *
     * Displays a random joke if available, otherwise a placeholder message.
     *
     * @return void
     */
    public static function index()
    {
        include basePath('App/views/index.view.php');
    }

    public static function about()
    {
        include basePath('App/views/about.view.php');
    }
}
<?php
/**
 * core/Controller.php
 */

require_once ROOT . '/core/View.php';

class Controller
{
    protected View $view;

    public function __construct()
    {
        $this->view = new View();
    }
}

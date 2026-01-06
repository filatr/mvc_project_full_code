<?php

class AdminThemeController extends Controller
{
    public function index()
    {
        Auth::check();

        $themesDir = ROOT . '/themes';
        $themes = array_filter(scandir($themesDir), function ($dir) use ($themesDir) {
            return $dir[0] !== '.' && is_dir($themesDir . '/' . $dir);
        });

        $setting = new Setting();
        $currentTheme = $setting->get('theme');

        $this->view->set('themes', $themes);
        $this->view->set('currentTheme', $currentTheme);
        $this->view->render('admin/themes/index');
    }

    public function activate(string $theme)
    {
        Auth::check();

        $themesDir = ROOT . '/themes/' . $theme;

        if (!is_dir($themesDir)) {
            die('Theme not found');
        }

        $setting = new Setting();
        $setting->set('theme', $theme);

        header('Location: /admin/themes');
        exit;
    }
}

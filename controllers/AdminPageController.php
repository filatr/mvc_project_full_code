<?php

class AdminPageController extends Controller
{
    public function index()
    {
        Auth::check();

        $pages = (new Page())->all();
        $this->view->set('pages', $pages);
        $this->view->render('admin/pages/index');
    }

    public function create()
    {
        Auth::check();

        if ($_POST) {
            (new Page())->create($_POST);
            header('Location: /admin/pages');
            exit;
        }

        $this->view->render('admin/pages/create');
    }

    public function edit(int $id)
    {
        Auth::check();

        $model = new Page();

        if ($_POST) {
            $model->update($id, $_POST);
            header('Location: /admin/pages');
            exit;
        }

        $this->view->set('page', $model->find($id));
        $this->view->render('admin/pages/edit');
    }

    public function delete(int $id)
    {
        Auth::check();
        (new Page())->delete($id);
        header('Location: /admin/pages');
    }
}

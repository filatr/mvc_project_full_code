<?php

class AdminMediaController extends Controller
{
    public function index()
    {
        Auth::check();

        $media = (new Media())->all();
        $this->view->set('media', $media);
        $this->view->render('admin/media/index');
    }

    public function upload()
    {
        Auth::check();

        if (!empty($_FILES['file'])) {

            $file = $_FILES['file'];

            if ($file['error'] !== UPLOAD_ERR_OK) {
                die('Помилка завантаження');
            }

            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = uniqid() . '.' . $ext;

            $targetDir = ROOT . '/public/uploads/images/';
            $targetPath = $targetDir . $filename;

            if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
                die('Не вдалося зберегти файл');
            }

            (new Media())->create([
                'filename'       => $filename,
                'original_name'  => $file['name'],
                'mime'           => $file['type'],
                'size'           => $file['size']
            ]);

            header('Location: /admin/media');
            exit;
        }

        $this->view->render('admin/media/upload');
    }
}

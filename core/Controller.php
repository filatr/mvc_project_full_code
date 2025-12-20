<?php
class Controller {

    protected array $meta = [
        'title' => 'Інформаційний сайт',
        'description' => 'Інформаційний сайт'
    ];

    protected function setMeta(array $meta): void {
        $this->meta = array_merge($this->meta, $meta);
    }

    protected function view(string $file, array $data = []) {
        extract($data);
        $meta = $this->meta;
        require __DIR__.'/../views/layout.php';
    }
}

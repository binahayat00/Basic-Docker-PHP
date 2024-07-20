<?php

declare(strict_types= 1);

namespace App;

use App\Exception\ViewNotFoundException;

class View
{
    public function __construct(protected string $view, protected array $params = [])
    {
    }

    public static function make(string $view, array $params = []): static
    {
        return new static($view, $params);
    }

    public function render(bool $withLayout = true): string
    {
        $pagePath = VIEW_PATH . '/layouts/page' . '.php';
        if(!file_exists($pagePath)){
            throw new ViewNotFoundException();
        }
        ob_start();
        
        include $pagePath;

        $pageHtml = (string) ob_get_clean();

        $viewPath = VIEW_PATH . '/' . $this->view . '.php';
        if(!file_exists($viewPath)){
            throw new ViewNotFoundException();
        }
        foreach ($this->params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        
        include $viewPath;
        $viewHtml = (string) ob_get_clean();
        $wholePage = str_replace('{{content}}',$viewHtml, $pageHtml);
        return $wholePage;
    }

    public function __tostring(): string
    {
        return $this->render();
    }

    public function __get(string $name)
    {
        return $this->params[$name] ?? null;
    }
}

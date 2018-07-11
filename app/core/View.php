<?php
/**
 * Created by Mirosław Kowieski
 * Date: 2018-07-12 00:02
 */

namespace app\core;


class View
{
    const VIEWS_DIR = "view";

    const VIEWS_LAYOUT_DIR = "layout";

    private $layout = "default";

    public $content;

    public static function asset($asset)
    {
        echo $asset;
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;

        return $this;
    }

    public function render($view)
    {
        $this->content = $this->getViewContent($view);

        return require_once $this->getLayoutPath();
    }

    public function getContent()
    {
        echo $this->content;
    }

    public function getViewPath($view)
    {
        $view = explode(".", $view);
        $view = implode("\\", $view);
        $viewDir = dirname(__DIR__);

        return "$viewDir\\" . self::VIEWS_DIR . "\\$view.php";
    }

    public function getViewContent($view)
    {
        return file_get_contents($this->getViewPath($view));
    }

    public function getLayoutPath()
    {
        $viewDir = dirname(__DIR__);

        return "$viewDir\\" . self::VIEWS_DIR . "\\" . self::VIEWS_LAYOUT_DIR . "\\{$this->layout}.php";
    }
}
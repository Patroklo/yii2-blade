<?php
/**
 * Created for Yii2.
 * User: Joseba Juániz joseba.juaniz@gmail.com
 * Date: 18/09/15
 * Time: 13:17
 */

namespace cyneek\yii2\blade;

use Yii;
use \yii\web\Controller as BaseController;

class Controller extends BaseController
{

    /**
     * Renders the file and, if it's a Blade view, will check for a layout that
     * if also Blade file, will send all rendering logic to the Blade layout system.
     *
     * @param string $view
     * @param array $params
     * @return string
     */
    public function render($view, $params = [])
    {
        $layoutFile = $this->findLayoutFile($this->getView());

        $layoutExt = pathinfo($layoutFile, PATHINFO_EXTENSION);

        $viewExt = pathinfo($view, PATHINFO_EXTENSION);

        if ($layoutExt === ViewRenderer::$extension && $viewExt === ViewRenderer::$extension)
        {
            $this->getView()->renderers[$layoutExt] = Yii::createObject($this->getView()->renderers[$layoutExt]);

            $this->getView()->renderers[$layoutExt]->addLayout($layoutFile);

            return $this->getView()->render($view, $params, $this);
        }

        return parent::render($view, $params);
    }

}
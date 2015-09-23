<?php

namespace cyneek\yii2\blade;


use yii\base\Behavior;
use yii\web\View;
use Yii;

class BladeBehavior extends Behavior
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        // Will add an event before rendering the view file.
        Yii::$app->getView()->on(View::EVENT_BEFORE_RENDER, [$this, 'viewRender']);
    }

    /**
     * Changes the render file order of the layout and views
     * if both layout and view are blade files.
     *
     * @param \yii\base\ViewEvent $event
     * @return mixed
     * @throws \yii\base\InvalidConfigException
     */
    function viewRender($event)
    {

        /** @var View $view */
        $view = $event->sender;

        /** @var \yii\web\Controller $controller */
        $controller = $this->owner;

        /** @var String $viewFile */
        $viewFile = $event->viewFile;

        /**
         * The layout file defined for that controller
         *
         * @var String $layoutFile
         */
        $layoutFile = $controller->findLayoutFile($view);

        // If layout is not a string, won't be necessary to do anything more.
        if (!is_string($layoutFile))
        {
            return;
        }

        /** @var String $layoutExt */
        $layoutExt = pathinfo($layoutFile, PATHINFO_EXTENSION);

        /** @var String $viewExt */
        $viewExt = pathinfo($viewFile, PATHINFO_EXTENSION);

        /**
         * The defined blade extension file for blade Renderer 
         * @var String $bladeExtension 
         */
        $bladeExtension = $this->getRendererExtension($view);

        // If the two files (view and layout) are blade files, chances are
        // that developer has used a blade-like layout code, so we will
        // have to launch first the layout and after that the view, while
        // Yii2 does that the other way round.
        if ($layoutExt === $bladeExtension && $viewExt === $bladeExtension)
        {
            $view->renderers[$bladeExtension]->addLayout($layoutFile);

            // we don't want to use the layout anymore.
            $controller->layout = FALSE;
        }

    }


    /**
     * Checks for the defined Blade file extension
     * for the renderer. Since we don't know the name
     * the developer has given to the renderer we will have
     * to check it one by one.
     *
     *
     * @param View $view
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    function getRendererExtension($view)
    {
        $renderList = $view->renderers;

        $extension = '';

        foreach ($renderList as $key => $renderer)
        {

            if (is_array($renderer) && trim($renderer['class'], '\\') == trim(ViewRenderer::className(), '\\'))
            {
                $view->renderers[$key] = Yii::createObject($view->renderers[$key]);
                $extension = $view->renderers[$key]->extension;
            }
            elseif (is_object($renderer) && get_class($renderer) == ViewRenderer::className())
            {
                $extension = $view->renderers[$key]->extension;
            }
        }

        return $extension;
    }

}
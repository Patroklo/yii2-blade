<?php
/**
 * Created for Yii2.
 * User: Joseba Juániz joseba.juaniz@gmail.com
 * Date: 16/09/15
 * Time: 12:23
 */

namespace cyneek\yii2\blade;

use Yii;
use yii\base\InvalidParamException;
use yii\base\ViewRenderer as BaseViewRenderer;
use \Philo\Blade\Blade;


class ViewRenderer extends BaseViewRenderer
{

    /**
     * Extension the special view files will use
     *
     * @var string
     */
    public static $extension = 'blade';
    /**
     * Path where view cache will be located
     * Warning: this path must be writable by PHP.
     *
     * @var  String
     */
    public $cachePath;
    /**
     * List of view paths
     *
     * @var String[]
     */
    public $viewPaths = [];
    /**
     * Blade object used to make the dawgh
     *
     * @var  \Philo\Blade\Blade
     */
    public $blade;
    /**
     * Main view that will be used as layout for the rest of
     * views in this render.
     *
     * If it's null the layout will be the view sent in the
     * render.
     *
     * @var string
     */
    protected $base_view;


    /**
     * @inheritdoc
     */
    public function init()
    {
        if (is_null($this->cachePath) || !is_string($this->cachePath))
        {
            throw new InvalidParamException('Cache path must be a declared string');
        }

        foreach ($this->viewPaths as $key => $path)
        {
            $this->viewPaths[$key] = Yii::getAlias($path);
        }

        $this->blade = new Blade($this->viewPaths, Yii::getAlias($this->cachePath));

        $this->blade->view()->addExtension(self::$extension, self::$extension);
    }


    /**
     * Renders the view file sent by /Yii/base/View
     *
     * @param \yii\base\View $view
     * @param string $viewFile
     * @param array $params
     * @return mixed
     */
    public function render($view, $viewFile, $params)
    {

        $viewFile = pathinfo($viewFile, PATHINFO_FILENAME);


        if (is_null($this->base_view))
        {
            $this->base_view = $viewFile;
            $viewFile = NULL;
        }

        $viewObject = $this->blade->view()->make($this->base_view, $params)->with('view', $view);

        if (!is_null($viewFile))
        {
            $params['view'] = $view;
            $viewObject->nest($viewFile.'_view', $viewFile, $params);
        }

        return $viewObject->render();
    }

    /**
     * Returns View blade Object
     *
     * @return \Philo\Blade\Illuminate\View\Factory|void
     */
    public function view()
    {
        return $this->blade->view();
    }


    /**
     * Adds a layout to the Blade System to use as a base view
     *
     * @param $layout
     */
    public function addLayout($layout)
    {
        $layout = pathinfo($layout, PATHINFO_FILENAME);
        $this->base_view = $layout;
    }

}
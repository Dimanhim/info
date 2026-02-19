<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [

    ];
    public $js = [
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];

    public function init()
    {
        $this->css = static::getCss();
        $this->js = static::getJs();
        return parent::init();
    }

    public static function getCss()
    {
        return [
            'css/bootstrap-icons.css',
            'css/jquery-ui.min.css',
            'css/jquery.fancybox.min.css',
            'css/toastr.min.css',
            'jstree/themes/default/style.min.css',
            'css/site.css?v='.mt_rand(1000,10000),
            'css/admin.css',
        ];
    }

    public static function getJs()
    {
        return [
            'js/jquery-ui.min.js',
            'js/jquery.fancybox.min.js',
            'jstree/jstree.min.js',
            'js/jstree-actions.min.js',
            'js/toastr.min.js',
            'js/functions.js?v=' . mt_rand(1000,10000),
            'js/common.js?v=' . mt_rand(1000,10000),
            'js/vcs.js?v=' . mt_rand(1000,10000),
        ];
    }
}

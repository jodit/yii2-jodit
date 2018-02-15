<?php
namespace yii2jodit;

use yii\web\AssetBundle;

/**
 * Jodit Editor asset
 */
class JoditAssetExt extends AssetBundle {
	/**
	 * @var string
	 */
	public $sourcePath = '@vendor/jodit/yii2-jodit/src/assets';
	/**
	 * @var array
	 */
	public $js = [
		'script.js',
	];
	/**
	 * @var array
	 */
	public $css = [
		'style.css',
	];
}
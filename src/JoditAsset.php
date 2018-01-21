<?php
namespace yii2jodit;

use yii\web\AssetBundle;
/**
 * Jodit Editor asset
 */
class JoditAsset extends AssetBundle {
	/**
	 * @var string
	 */
	public $sourcePath = '@vendor/npm-asset/jodit/build/';
	/**
	 * @var array
	 */
	public $js = [
		'jodi.min.js',
	];
	/**
	 * @var array
	 */
	public $css = [
		'jodit.min.css',
	];
}
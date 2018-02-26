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
	public $sourcePath = '@vendor/xdan/jodit/build/';
	/**
	 * @var array
	 */
	public $js = [
		'jodit.min.js',
	];
	/**
	 * @var array
	 */
	public $css = [
		'jodit.min.css',
	];
	public $depends = [
		'\yii2jodit\JoditAssetExt',
	];
}
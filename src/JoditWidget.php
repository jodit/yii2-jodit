<?php

namespace yii2jodit;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

class JoditWidget extends InputWidget {

	public $csrfCookieParam = '_csrfCookie';

	/**
	 * @var boolean
	 */
	public $render = true;

	/**
	 * @inheritdoc
	 */
	public function run()
	{
		if ($this->render) {
			if ($this->hasModel()) {
				echo Html::activeTextarea($this->model, $this->attribute, $this->options);
			} else {
				echo Html::textarea($this->name, $this->value, $this->options);
			}
		}
		$this->registerClientScript();
	}

	/**
	 * register client scripts(css, javascript)
	 */
	public function registerClientScript()
	{
		$view = $this->getView();
		JoditAsset::register($view);

		$id = $this->options['id'];

		$jsOptions = Json::encode([]);

		$view->registerJs("var editor = new Jodit('#$id', $jsOptions);");
	}
}

<?php

namespace yii2jodit;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

class JoditWidget extends InputWidget {
	/** Name of inline JavaScript package that is registered by the widget */
	const INLINE_JS_KEY = 'jodit/jodit';

	/**
	 * @var boolean
	 */
	public $render = true;

	/**
	 * @var array Default settings that will be merged with {@link $settings}. Useful with DI container.
	 */
	public $defaultSettings = [];

	/**
	 * @var array {@link https://xdsoft.com/jodit/docs/ redactor options}.
	 */
	public $settings = [];

	/**
	 * @inheritdoc
	 */
	public function init() {
		if ($this->name === null && !$this->hasModel() && $this->selector === null) {
			throw new InvalidConfigException("Either 'name', or 'model' and 'attribute' properties must be specified.");
		}

		if (!isset($this->options['id'])) {
			$this->options['id'] = $this->hasModel() ? Html::getInputId($this->model, $this->attribute) : $this->getId();
		}

		if (!empty($this->defaultSettings)) {
			$this->settings = ArrayHelper::merge($this->defaultSettings, $this->settings);
		}

		if (!isset($this->settings['language']) && \Yii::$app->language !== 'en-US') {
			$this->settings['language'] = substr(\Yii::$app->language, 0, 2);
		}

		if ($this->selector === null) {
			$this->selector = '#' . $this->options['id'];
		}

		parent::init();
	}
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


	public function registerClientScript() {
		$view = $this->getView();
		JoditAsset::register($view);

		$selector = Json::encode($this->selector);
		$settings = !empty($this->settings) ? Json::encode($this->settings) : '';

		$view->registerJs("var editor = new Jodit('$selector', $settings);", $view::POS_READY, self::INLINE_JS_KEY . $this->options['id']);
	}
}

<?php

namespace yii2jodit;

use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\InputWidget;

class JoditIconPickerWidget extends InputWidget {
	/** Name of inline JavaScript package that is registered by the widget */
	const INLINE_JS_KEY = 'jodit/jodit';


	public $path = '';
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

		parent::init();
	}
	public function run() {
	    ?>
		<a  class="jodit-icon-picker" href="javascript:void(0)" onclick="return openJoditFileBrowser(this, '<?=$this->path?>');">
			<?
                if ($this->hasModel()) {
                    echo Html::activeHiddenInput($this->model, $this->attribute, $this->options);
	                $src = $this->model->{$this->attribute};
                } else {
	                $src = $this->value;
                    echo Html::hiddenInput($this->name, $this->value, $this->options);
                }
            ?>
            <img src="<?=$src?>" onerror="this.parentNode.classList.add('jodit-icon-picker_wrong')"/>
		</a>
		<?
		$this->registerClientScript();
	}


	public function registerClientScript() {
		$view = $this->getView();
		JoditAsset::register($view);

		$this->settings = [
			'ajax' => [
				'url'  => Url::to(['/jodit/connector/fileupload/'])
			],
			'uploader' => [
				'url'  => Url::to(['/jodit/connector/fileupload/'])
			],
			'create' => [
				'url'  => Url::to(['/jodit/connector/foldercreate/'])
			],
			'getLocalFileByUrl' => [
				'url'  => Url::to(['/jodit/connector/getlocalfilebyurl/'])
			],
			'resize' => [
				'url'  => Url::to(['/jodit/connector/imageresize/'])
			],
			'crop'=> [
				'url'  => Url::to(['/jodit/connector/imagecrop/'])
			],
			'move'=> [
				'url'  => Url::to(['/jodit/connector/filemove/'])
			],
			'remove'=> [
				'url'  => Url::to(['/jodit/connector/fileremove/'])
			],
			'items'=> [
				'url'  => Url::to(['/jodit/connector/files/'])
			],
			'folder'=> [
				'url'  => Url::to(['/jodit/connector/folders/'])
			],
			'permissions'=> [
				'url'  => Url::to(['/jodit/connector/permissions/'])
			],
		];


		$settings = !empty($this->settings) ? Json::encode($this->settings) : '';

		$view->registerJs("Jodit.defaultOptions.filebrowser = $settings;", $view::POS_READY, self::INLINE_JS_KEY . $this->options['id']);
	}
}

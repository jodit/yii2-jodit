<?php
namespace yii2jodit;

class JoditModule extends \yii\base\Module {
	/**
	 * @var JoditApplication
	 */
	public $joditApplication;

	public function init() {
		$this->joditApplication = new JoditApplication((array)$this);
		parent::init();
	}
}
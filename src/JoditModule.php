<?php
namespace yii2jodit;

class JoditModule extends \yii\base\Module {
	/**
	 * @var
	 */
	public $joditApplication;

	public function init() {
		$this->joditApplication = new JoditRestApplication((array)$this);
		parent::init();
	}
}
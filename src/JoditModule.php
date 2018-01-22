<?php
namespace yii2jodit;

class JoditModule extends \yii\base\Module {
	/**
	 * @var bool
	 */
	public $debug = true; // must be true

	/**
	 * @var \Jodit\Source[]
	 */
	public $sources = [];

	/**
	 * @var string
	 */
	public $datetimeFormat = 'm/d/Y g:i A';

	/**
	 * @var int
	 */
	public $quality = 90;

	/**
	 * @var int
	 */
	public $defaultPermission = 0775;

	/**
	 * @var bool
	 */
	public $createThumb = true;

	/**
	 * @var string
	 */
	public $thumbFolderName = '_thumbs';

	/**
	 * @var string[]
	 */
	public $excludeDirectoryNames = ['.tmb', '.quarantine'];

	/**
	 * @var string
	 */
	public $maxFileSize = '8mb';

	/**
	 * @var bool
	 */
	public $allowCrossOrigin = false;

	/**
	 * @var array
	 * @see https://github.com/xdan/jodit-connectors#access-control
	 */
	public $accessControl = [];

	/**
	 * @var string
	 */
	public $roleSessionVar = 'JoditUserRole';

	/**
	 * @var string
	 */
	public $defaultRole = 'guest';

	/**
	 * @var bool
	 */
	public $allowReplaceSourceFile = true;

	/**
	 * @var string
	 */
	public $baseurl = '@web';

	/**
	 * @var string
	 */
	public $root = '@webroot/uploads/';

	/**
	 * @var string[]
	 */
	public $extensions = ['jpg', 'png', 'gif', 'jpeg'];

	/**
	 * @var string[]
	 */
	public $imageExtensions = ['jpg', 'png', 'gif', 'jpeg', 'bmp'];

	/**
	 * @var int
	 */
	public $maxImageWidth = 1900;

	/**
	 * @var int
	 */
	public $maxImageHeight = 1900;

	/**
	 * @var JoditApplication
	 */
	public $joditApplication;

	public function init() {


		$this->root = \Yii::getAlias($this->root);
		$this->baseurl = \Yii::getAlias($this->baseurl);


		$this->joditApplication = new JoditApplication($this);
		parent::init();
	}
}
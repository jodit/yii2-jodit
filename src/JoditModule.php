<?php
namespace yii2jodit;

use yii\web\Response;

class JoditModule extends \yii\base\Module {
	/**
	 * @var bool
	 */
	public $debug = false;

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
	public $baseurl = '@web/uploads/';

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


		\Yii::$app->response->formatters[Response::FORMAT_JSON] = [
			'class' => 'yii\web\JsonResponseFormatter',
			'prettyPrint' => YII_DEBUG, // use "pretty" output in debug mode,
			'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
		];

		\Yii::$app->response->on(Response::EVENT_BEFORE_SEND, function ($event) {
			$response = $event->sender;
			if ($response->data !== null) {
				if (isset($response->data['code']) and $response->data['code']) {
					$response->data['status'] = $response->data['code'];
					unset($response->data['code']);
				}

				if (!isset($response->data['status'])) {
					$response->data['status'] = 200;
				}

				$response->data = [
					'success' => $response->isSuccessful,
					"time" => date($this->datetimeFormat),
					'data' => $response->data,
				];

				if (YII_DEBUG) {
					$response->data['elapsed_time'] = \Yii::getLogger()->getElapsedTime();
				}

				$response->statusCode = 200;
			}
		});

		$this->joditApplication = new JoditApplication($this);
		parent::init();
	}
}
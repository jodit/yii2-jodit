<?php
namespace yii2jodit;

use yii\rest\Action;

class JoditAction  extends Action {
	public $joditApplication;
	public $method;

	public function run() {
	    if (is_callable([$this->joditApplication, $this->method])) {
	    	$result = call_user_func([$this->joditApplication, $this->method]);
		    return $result ?: [];
	    }

	    return [];
	}
}
# yii2-jodit
Jodit widget for Yii2

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist jodit/yii2-jodit "*"
```
or 
```
composer require --prefer-dist jodit/yii2-jodit
```
or add

```
"jodit/yii2-jodit": "*"
```

to the require section of your `composer.json` file.

Configure
-----
Add to config file (config/web.php or common\config\main.php)

```php
'modules' => [
	'jodit' => 'yii2jodit\JoditModule',
],
```

or if you want to change the upload directory. to path/to/uploadfolder default value @webroot/uploads

```php
'modules' => [
	'jodit' => [
		'class' => 'yii2jodit\JoditModule',
		'imageAllowExtensions'=>['jpg','png','gif']
	],
],
```

> note: You need to create uploads folder and chmod and set security for folder upload reference:[Protect Your Uploads Folder with `.htaccess`](http://tomolivercv.wordpress.com/2011/07/24/protect-your-uploads-folder-with-htaccess/), []How to Setup Secure Media Uploads](http://digwp.com/2012/09/secure-media-uploads/)

Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?=$form->field($model, 'content')->widget(\yii2jodit\JoditWidget::className(), [
    'settings' => [
        'buttons'=>[
            'bold', 'italic', 'underline', '|', 'ul', 'ol', '|', 'image', '|', 'hr',
        ],
    ],
]);?>
```

or not use ActiveField

<?= \yii2jodit\JoditWidget::widget([
    'model' => $model,
    'attribute' => 'content'
]) ?>

Image uploader
--------------

add uploader action to controller:

```php
public function actions()
{
    return [
        'upload-image' => [
            'class' => 'yii2jodit\jodit\UploadAction',
            'folder'=>Yii::getAlias('@webroot/uploads'),
            'webroot'=>Yii::getAlias('@webroot'),
        ],
    ];
}
```

editors config:

```php
<?=$form->field($model, 'content')->widget(\yii2jodit\JoditWidget::className(), [
    'settings' => [
        'height'=>'250px',
        'enableDragAndDropFileToEditor'=>new \yii\web\JsExpression("true"),
        'uploader'=>[
            'url'=>\yii\helpers\Url::to(['upload-image']),
            'data'=> [
                '_csrf'=> Yii::$app->request->csrfToken,
            ],
        ],
    ],
]);?>
```


License
-----
This package is available under `MIT` License.
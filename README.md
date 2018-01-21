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


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?=$form->field($model, 'content')->widget(\worstinme\jodit\Editor::className(), [
    'settings' => [
        'buttons'=>[
            'bold', 'italic', 'underline', '|', 'ul', 'ol', '|', 'image', '|', 'hr',
        ],
    ],
]);?>
```

Image uploader
--------------

add uploader action to controller:

```php
public function actions()
{
    return [
        'upload-image' => [
            'class' => 'worstinme\jodit\UploadAction',
            'folder'=>Yii::getAlias('@webroot/uploads'),
            'webroot'=>Yii::getAlias('@webroot'),
        ],
    ];
}
```

editors config:

```php
<?=$form->field($model, 'content')->widget(\worstinme\jodit\Editor::className(), [
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

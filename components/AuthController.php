<?php
namespace app\components;
use yii\filters\AccessControl;


class AuthController extends \yii\web\Controller
{
  public function init()
  {
    parent::init();
  }

  public function behaviors()
  {
    return [
      'access' => [
        'class' => AccessControl::className(),
        'rules' => [
          // allow authenticated users
          [
            'allow' => true,
            'roles' => ['@'],
          ],
          // everything else is denied by default
        ],
      ],
    ];
  }
}

?>

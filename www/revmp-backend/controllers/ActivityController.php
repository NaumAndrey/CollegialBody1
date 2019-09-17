<?php
namespace app\controllers;

use app\models\Activity;
use yii\rest\Controller;

class ActivityController extends Controller
{
    public function actionHello()
    {
        $query=Activity::find();
        return $query->all();
    }

    public function actionCreate()
    {
        $data = \Yii::$app->request->post();
        $model=new Activity;

        if ($model->load($data)&&$model->save()) {
            return $model->toArray();
        }
        return $model->errors;
    }
}
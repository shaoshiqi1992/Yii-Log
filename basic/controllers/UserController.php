<?php
namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\EditpwdForm;

class UserController extends Controller{

    /**
     *  Editpwd action
     *
     * @return string
     */
    public function actionEditpwd()
    {

        $model = new EditpwdForm();
        if ($model->load(Yii::$app->request->post()) && $model->editpwd()) {
            return $this->goHome();
        }
        return $this->render('editpwd', [
            'model' => $model,
        ]);

    }
}
?>
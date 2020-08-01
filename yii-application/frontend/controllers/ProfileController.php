<?php


namespace frontend\controllers;


use common\models\User as UserModel;
use frontend\models\resetForm;
use frontend\models\SignupForm;
use phpDocumentor\Reflection\Element;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\User;

class ProfileController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['personalinfo'],
                'rules' => [
                    [
                        'actions' => ['personalinfo'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionPersonalinfo(){
        $user_id = \Yii::$app->user->identity->getId();
        $user = UserModel::findOne(['id' , $user_id]);

        $reset_form = $user->getResetForm();

        if ($reset_form->load(Yii::$app->request->post()) && $reset_form->validate() ) {
            $user->student_id = $reset_form->student_id;
            $user->username = $reset_form->username;
            $user->email = $reset_form->email;
            if($user->validate()){
                $user->save();
            }
        }
        return $this->render('personalinfo', ['model' => $reset_form]);
    }


}
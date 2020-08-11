<?php


namespace frontend\controllers;


use common\models\Constructor;
use common\models\ConstructorSearch;
use common\models\UserConstructor;
use frontend\models\QqUrlModel;
use phpDocumentor\Reflection\Element;
use Yii;
use yii\web\Controller;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\ErrorAction;
use yii\web\NotFoundHttpException;

class ConstructorController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'agreement', 'licence','handle','set-qqurl'],
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

    public function actionIndex()
    {
        $searchModel = new ConstructorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', ['searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    /**
     * Displays a single Constructor model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        $id = Yii::$app->request->get('id');
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    protected function findModel($id)
    {
        $model = Constructor::findOne(['id' => $id]);
        if ($model !== null) {
            return $model;
        }
        throw new NotFoundHttpException('this page do not exist');
    }


    public function actionLicence()
    {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        $filePath = Yii::getAlias('@uploads').'/licence/'.$model->license;
        $this->sendFile($filePath);
    }

    public function actionAgreement()
    {
        $id = Yii::$app->request->get('id');
        $model = $this->findModel($id);
        $filePath = Yii::getAlias('@uploads').'/agreement/constructor/'.$model->agreement;
        $this->sendFile($filePath);
    }

    protected function sendFile($filePath){
        if(file_exists($filePath)) {
            Yii::$app->response->sendFile($filePath);
        }else{
            return var_dump($filePath);
        }
    }

    public function actionSetQqurl(){
        $id = Yii::$app->request->get('id');
        $model = new QqUrlModel();
        if($model->load(Yii::$app->request->post())){
            $handle = new UserConstructor();
            $handle->user_id = Yii::$app->user->getId();
            $handle->constructor_id = $id;
            $handle->join_date = time();
            $handle->qq_url = $model->qqurl;
            $handle->save();
            $model = Constructor::findOne(['id' => $id]);
            $model->status_id = 1;
            $model->save();
            return $this->redirect(['index']);
        }
        return $this->render('set-qqurl' , ['model' => $model] );
    }

    public function actionHandle(){

        return $this->actionIndex();

    }

}
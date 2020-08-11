<?php


namespace frontend\controllers;


use common\models\AgreementModel;
use common\models\Constructor;
use common\models\ConstructorSearch;
use common\models\LicenceModel;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

class MyConstructorController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'publicfile', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $searchModel = new ConstructorSearch();
        $dataProvider = $searchModel->myConstructorSearch(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Constructor model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the Constructor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Constructor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Constructor::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Updates an existing Constructor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $licence = new LicenceModel();
        $agreement = new AgreementModel();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->join_date = strtotime($model->join_date);
            $agreement->agreementFile = UploadedFile::getInstance($agreement, 'agreementFile');
            $licence->licenceFile = UploadedFile::getInstance($licence, 'licenceFile');
            if ($agreement->agreementFile != null) {
                $model->agreement = $model->name . '.' . $agreement->agreementFile->extension;
                $agreement->upload($model->agreement , 'constructor');
            }

            if ($licence->licenceFile != null) {
                $model->license = $model->name . '.' . $licence->licenceFile->extension;
                $licence->upload($model->license);
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'licence' => $licence,
            'agreement' => $agreement
        ]);
    }
}
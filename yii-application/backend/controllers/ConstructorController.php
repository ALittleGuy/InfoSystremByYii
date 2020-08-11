<?php

namespace backend\controllers;

use common\models\AgreementModel;
use common\models\LicenceModel;
use common\models\UserConstructor;
use frontend\assets\AppAsset;
use PharIo\Manifest\ApplicationName;
use PharIo\Manifest\License;
use Yii;
use common\models\Constructor;
use common\models\ConstructorSearch;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\gii\console\GenerateAction;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ConstructorController implements the CRUD actions for Constructor model.
 */
class ConstructorController extends Controller
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
                        'actions' => ['index', 'update', 'delete', 'view', 'create', 'licence' ,'agreement' ],
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

    /**
     * Lists all Constructor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ConstructorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

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
     * Creates a new Constructor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Constructor();
        $licence = new LicenceModel();
        $agreement = new AgreementModel();


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->join_date = strtotime($model->join_date);
            $licence->licenceFile = UploadedFile::getInstance($licence, 'licenceFile');
            $agreement->agreementFile = UploadedFile::getInstance($agreement, 'agreementFile');
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

        return $this->render('create', [
            'model' => $model,
            'licence' => $licence,
            'agreement' => $agreement
        ]);
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

    /**
     * Deletes an existing Constructor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionLicence($id)
    {
        $model = $this->findModel($id);
        $filePath = 'uploads/licence/' . $model->license;
        if ($model->isLicenceExist()) {
            Yii::$app->response->sendFile($filePath);
        }
    }

    public function actionAgreement($id)
    {
        $model = $this->findModel($id);
        $filePath = 'uploads/agreement/constructor/' . $model->license;
        if ($model->isAgreementExist()) {
            Yii::$app->response->sendFile($filePath);
        }
    }



}

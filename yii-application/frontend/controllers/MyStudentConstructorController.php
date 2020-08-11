<?php

namespace frontend\controllers;

use common\models\AgreementModel;
use Yii;
use common\models\StudentConstructor;
use common\models\StudentConstructorSearch;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * StudentConstructorController implements the CRUD actions for StudentConstructor model.
 */
class MyStudentConstructorController extends Controller
{


    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' =>[
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'update','delete','view','create' , 'agreement'],
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
     * Lists all StudentConstructor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentConstructorSearch();
        $dataProvider = $searchModel->myStudentConstructorSearch( Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StudentConstructor model.
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
     * Creates a new StudentConstructor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new StudentConstructor();
        $agreement = new AgreementModel();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->join_date = strtotime($model->join_date);
            $model->end_date = strtotime($model->end_date);
            $agreement->agreementFile = UploadedFile::getInstance($agreement , 'agreementFile');
            if($agreement->agreementFile!=null){
                $model->agreement = $model->student_id.'_'.$model->constructor_id.'.'.$agreement->agreementFile->extension;
                $agreement->upload($model->agreement , 'student');
                $model->save();
            }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'agreement' => $agreement
        ]);
    }

    /**
     * Updates an existing StudentConstructor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $agreement = new AgreementModel();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->join_date = strtotime($model->join_date);
            if($model->end_date!=null) {
                $model->end_date = strtotime($model->end_date);
            }
            $agreement->agreementFile = UploadedFile::getInstance($agreement , 'agreementFile');
            if($agreement->agreementFile!=null){
                $model->agreement = $model->student_id.'_'.$model->constructor_id.'.'.$agreement->agreementFile->extension;
                $agreement->upload($model->agreement , 'student');
                $model->save();
            }
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'agreement' => $agreement
        ]);
    }

    /**
     * Deletes an existing StudentConstructor model.
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

    /**
     * Finds the StudentConstructor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StudentConstructor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StudentConstructor::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAgreement($id)
    {
        $model = $this->findModel($id);
        $filePath = 'uploads/agreement/student/' . $model->agreement;
        if ($model->isAgreementExist()) {
            Yii::$app->response->sendFile($filePath);
        }
    }
}

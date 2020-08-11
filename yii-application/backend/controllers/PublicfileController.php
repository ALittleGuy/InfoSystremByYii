<?php

namespace backend\controllers;

use common\models\PublicFileModel;
use phpDocumentor\Reflection\Element;
use Yii;
use common\models\Publicfile;
use common\models\PublicfileSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * PublicfileController implements the CRUD actions for Publicfile model.
 */
class PublicfileController extends Controller
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
                        'actions' => ['index', 'update','delete','view','create','publicfile'],
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
     * Lists all Publicfile models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PublicfileSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Publicfile model.
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
     * Creates a new Publicfile model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Publicfile();
        $publicfile = new PublicFileModel();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->join_date =  time();
            $publicfile->publicfile = UploadedFile::getInstance($publicfile , 'publicfile');

            if($publicfile->publicfile!=null){
                $model->name = $model->name.'.'.$publicfile->publicfile->extension;
                $publicfile->upload($model->name);
                $model->save();
            }else{
                return $this->refresh();

            }

            return $this->redirect(['view', 'id' => $model->id]);

        }

        return $this->render('create', [
            'model' => $model,
            'publicfile' => $publicfile
        ]);
    }

    /**
     * Updates an existing Publicfile model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $publicfile = new PublicFileModel();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->join_date = time();
            $publicfile->publicfile = UploadedFile::getInstance($publicfile , 'publicfile');

            if($publicfile->publicfile!=null){
                $model->name = $model->name.'.'.$publicfile->publicfile->extension;
                $publicfile->upload($model->name);
                $model->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'publicfile' => $publicfile
        ]);
    }

    /**
     * Deletes an existing Publicfile model.
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
     * Finds the Publicfile model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Publicfile the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Publicfile::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPublicfile($id)
    {
        $model = $this->findModel($id);
        $filePath = 'uploads/public/' . $model->name;
        if ($model->isPublicFileExist()) {
            Yii::$app->response->sendFile($filePath);
        }
    }
}

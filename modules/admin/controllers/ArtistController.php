<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Artist;
use app\models\ArtistSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;
use yii\web\UploadedFile;
/**
 * ArtistController implements the CRUD actions for Artist model.
 */
class ArtistController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
                'access' => [
           'class' => AccessControl::className(),
           'only' => ['create', 'update', 'view', 'delete','index'],
           'rules' => [

               [
                   'actions' => ['create','update','view','delete','index'],
                   'allow' => true,
                   'roles' => ['@'],
                   'matchCallback' => function ($rule, $action) {
                       return User::isUserAdmin(Yii::$app->user->identity->username);
                   }
               ],
           ],
       ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Artist models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArtistSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $exportmenu= \kartik\export\ExportMenu::widget([
            'dataProvider' => $dataProvider,
             // 'columns' => $gridColumns
        ]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'exportmenu' =>$exportmenu
        ]);
    }

    /**
     * Displays a single Artist model.
     * @param integer $id
     * @return mixed
     */
    public function actionPicturesUpload(){ 
            
           $picture=UploadedFile::getInstancesByName('picture');
            $name1=date('Y_m_d_H_i_s_'). $picture->baseName .'.' . $picture->extension;
            $picture->saveAs('images/artist/'.$name1);
            $model->picture=$name1;

    }
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Artist model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Artist();
        $model->creation_date=date('Y-m-d H:i:s');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $picture=UploadedFile::getInstance($model,'picture');
            if($picture){
            $name1=date('Y_m_d_H_i_s_'). $picture->baseName .'.' . $picture->extension;
            $picture->saveAs('images/artist/'.$name1);
            $model->picture=$name1;
            $model->save();  
            }

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Artist model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldpicture=$model->picture;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $picture=UploadedFile::getInstance($model,'picture');
            if($picture){
            $name1=date('Y_m_d_H_i_s_'). $picture->baseName .'.' . $picture->extension;
            $picture->saveAs('images/artist/'.$name1);
            $model->picture=$name1;
            $model->save();  
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Artist model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Artist model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Artist the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Artist::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

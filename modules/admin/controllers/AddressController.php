<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Address;
use app\models\AddressSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;
/**
 * AddressController implements the CRUD actions for Address model.
 */
class AddressController extends Controller
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
     * Lists all Address models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AddressSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                // Renders a export dropdown menu
        $exportmenu= \kartik\export\ExportMenu::widget([
            'dataProvider' => $dataProvider,
             // 'columns' => $gridColumns
        ]);
                $GridView= \kartik\grid\GridView::widget([
            'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => $gridColumns,
            'resizableColumns'=>true,
                'responsive'=>false,
            'hover'=>true

        ]);
        return $this->render('index', [
            'GridView' => $GridView,
            'exportmenu' => $exportmenu
        ]);
    }

    /**
     * Displays a single Address model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Address model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Address();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Address model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Address model.
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
     * Finds the Address model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Address the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Address::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Product;
use app\models\Picture;
use app\models\ProductSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use app\models\User;
use yii\web\UploadedFile;
/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $exportmenu= \kartik\export\ExportMenu::widget([
            'dataProvider' => $dataProvider,
             // 'columns' => $gridColumns
        ]);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'exportmenu' => $exportmenu
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionPicturesUpload(){ 
            
           $pictures=UploadedFile::getInstancesByName('pictures');
           foreach($pictures  as $picture){
            $name1=date('Y_m_d_H_i_s_'). $picture->baseName .'.' . $picture->extension;
            $picture->saveAs('images/products/'.$name1);
            $model= New Picture();
            $model->description=$name1;
            $model->creation_date=date('Y-m-d H:i:s');
            $model->product_id=$_POST['product_id'];
            $model->sort=$_POST['file_id'];
            if($model->save()){
                return true;
            }else{
                return false;
            }
           }
    }
    public function actionPicturesDelete(){ 
            
        die(print_r(Yii::$app->request->post()));
            $model=Picture::find();
            if($model->save()){
                return true;
            }else{
                return false;
            }
           
    }
    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $model->creation_date=date('Y-m-d H:i:s');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $base=URL::base();
        $pictures = Picture::find()->select([new \yii\db\Expression("CONCAT('$base','/images/products/',`description`) as description")])->where(['product_id'=>$model->id])->asArray()->all();
        $pictures2=array();
        foreach($pictures as $picture){
            $pictures2[]=$picture['description'];
            
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,  'pictures'=>$pictures2
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
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
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

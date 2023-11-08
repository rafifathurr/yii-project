<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\ProductSearch;
use app\components\AuthController;
use app\models\UploadForm;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends AuthController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    public function datenow()
    {
        return date('Y-m-d H:i:s');
    }

    /**
     * Lists all Product models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionList($id)
    {
        $products = Product::find()->select(['price', 'stock'])->where(['id' => $id])->one();
        return $this->asJson($products);
    }


    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Product();
        $uploadFile = new UploadForm();

        $model->created_at = $this->datenow();
        $model->updated_at = $this->datenow();

        // if (isset($_POST['UploadForm'])) {

        //     dump($uploadFile);
        //     die;

        //     $uploadFile->imageFiles = UploadedFile::getInstance($uploadFile, 'imageFile');
        //     try {
        //         $uploadFile->upload();
        //     } catch (Exception $e) {
        //         dump($e);
        //         die;
        //         //throw $th;
        //     }

        //     // $dir_product = Yii::getAlias('@assets/images') . '/' . $model->id;
        //     // if (!file_exists($dir_product)) {
        //     //     mkdir($dir_product, 0777, true);
        //     // }

        //     // $uploadFile->imageFiles = UploadedFile::getInstances($uploadFile, 'imageFiles');

        //     // foreach ($uploadFile->imageFiles as $file) {
        //     //     // echo $file->baseName; die;
        //     //     $img = new ProductImages();
        //     //     $img->IdProduct = $model->Id;
        //     //     // date('Ymd') . str_random(30)
        //     //     $img->Filename = $file->baseName . '.' . $file->extension;
        //     //     $file->saveAs($dir_product . '/' . $img->Filename);
        //     //     $img->save();
        //     // }
        // }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', "Product created successfully.");
            } else {
                Yii::$app->session->setFlash('failed', "Product created failed.");
            }
            return $this->redirect(['index']);
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'images' => $uploadFile
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $uploadFile = new UploadForm();
        $model = $this->findModel($id);
        $model->updated_at = $this->datenow();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', "Product updated successfully.");
            } else {
                Yii::$app->session->setFlash('success', "Product updated successfully.");
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'images' => $uploadFile
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->deleted_at = $this->datenow();

        if ($model->save()) {
            Yii::$app->session->setFlash('success', "Product deleted successfully.");
        } else {
            Yii::$app->session->setFlash('failed', "Product deleted failed.");
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Tutorials;
use frontend\models\TutorialsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//use yii\data\ActiveDataProvider;

/**
 * TutorialsController implements the CRUD actions for Tutorials model.
 */
const ROOT_PATH = "../../repository/";
class TutorialsController extends Controller
{
    
    
    public function behaviors()
    {
        return [
            
//            'access' => [
//                'class' => \yii\filters\AccessControl::className(),
//                'only' => ['create', 'update', 'upload'],
//                'rules' => [
//                    // allow authenticated users
//                    [
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                 ],
//            ],
            
            
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Tutorials models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TutorialsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
       
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    // im trying to list tutorial of one category here
    public function actionCate($cate)
    {
//        return $this->render('view', [
//            'model' => $this->findCate($cate),
//        ]);
        
        
        $searchModel = new TutorialsSearch();
        $dataProvider = $searchModel->searchCate($cate);

        //Yii::$app->request->setQueryParams($params);
        
        return $this->render('cate', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
        

                
    }

    /**
     * Displays a single Tutorials model.
     * @param integer $_id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Tutorials model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
       if (\Yii::$app->user->can('createPost')) {

            $model = new Tutorials();
        
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $model->setAttribute('author', Yii::$app->user->identity->username);
                $model->save();
                return $this->redirect(['view', 'id' => (string)$model->_id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }
        else
        {
            echo "You don't have permissions to do this."
            . " If you have any questions,"
            . " please contact the admin at yufangong@hotmail.com.";
        }
    }

    
    public function actionUpload($id)
    {                
        $model = $this->findModel($id);
        if (\Yii::$app->user->can('uploadFile', ['post' => $model])) {
            if(empty($_FILES['file']['name']))
            {
                echo json_encode(['error' => 'Please Select a File']);
                return;
            }
        
            //$file = $_FILES['file'];
            $success = null;
            $path = [];
            //$filename = $_FILES['name'];



            //$ext = explode('.', basename($filename));
            $folder = ROOT_PATH;//"../../../repository";
            $filename = basename($_FILES['file']['name']);
            $target_file = $folder . $filename;
        
            if (file_exists($target_file)) {
            
                echo json_encode(['error' => 'File is existed']);
                return;
            }   
        
            if(move_uploaded_file($_FILES['file']['tmp_name'], $target_file))
            {
                $success = true;
                $path = $target_file;
            }
            else
            {
                $success = false;
            }

            if($success)
            {
                $output = ['ok' => 'File Upload Successed'];
                
                $files = (array)$model->getAttribute('file');
                array_push($files, $filename);
                $model->setAttribute('file', $files);
                $model->save();
            }
            elseif(!$success)
            {
                $output = ['error' => 'Failed'];
//                foreach ($path as $value) {
//                    unlink($value);
//                }
            }
            else
            {
                $output = ['error' => 'No file'];
            }

        }    
        else
        {
            $output = ['error' => 'You don not have permissions to do this'];
//            return  "You don't have permissions to do this."
//            . " If you have any questions,"
//            . " please contact the admin at yufangong@hotmail.com.";
        }
       
        echo json_encode($output);

    }
    
    public function actionDownload($file)
    {
        $target_dir = ROOT_PATH;
        $target_file = $target_dir . $file;
        if(file_exists($target_file))
        {
            header("Pragma: public");
            header("Accept-Ranges: bytes");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-type: application/zip");
            header("Content-Disposition: attachment; filename=". basename($target_file));
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: ".filesize($target_file));
            ob_clean();
            readfile($target_file);
        }
        else
        {
            echo "file didn't exist!";
        }
    }
    
    /**
     * Updates an existing Tutorials model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $_id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //echo json_encode(\Yii::$app->user->can('updatePost', ['post' => $model]));
        if (\Yii::$app->user->can('updatePost', ['post' => $model])) {

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => (string)$model->_id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
        else
        {
            echo "You don't have permissions to do this."
            . " If you have any questions,"
            . " please contact the admin at yufangong@hotmail.com.";
        }
    }

    /**
     * Deletes an existing Tutorials model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $_id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if (\Yii::$app->user->can('deletePost')) {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }
        else
        {
            echo "You don't have permissions to do this."
            . " If you have any questions,"
            . " please contact the admin at yufangong@hotmail.com.";

        }
    }

    /**
     * Finds the Tutorials model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $_id
     * @return Tutorials the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tutorials::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
//    //find all documents by category
//     protected function findCate($cate)
//    {
//        if (($model = Tutorials::findAll($cate)) !== null) {
//            return $model;
//        } else {
//            throw new NotFoundHttpException('The requested page does not exist.');
//        }
//    }
}

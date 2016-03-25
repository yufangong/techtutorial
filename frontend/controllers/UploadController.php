<?php

namespace frontend\controllers;

class UploadController extends \yii\web\Controller
{
    public function actionUpload()
    {
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
        $folder = "../../repository";
        $target_file = $folder . DIRECTORY_SEPARATOR . basename($_FILES['file']['name']);
        
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
            $output = ['error' => 'File Upload Successed'];
            //$model->file = $target_file;
        }
        elseif(!$success)
        {
            $output = ['error' => 'Failed'];
            foreach ($path as $file) {
                unlink($file);
            }
        }
        else
        {
            $output = ['error' => 'No file'];
        }

        echo json_encode($output);
        
        //return $target_file;
    }

}

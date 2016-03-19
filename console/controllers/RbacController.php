<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $rule = new \console\rbac\EditorRule();
        $auth->add($rule);
        
        $deletePost = $auth->createPermission('deletePost');
        $deletePost->description = 'Delete a post';
        $auth->add($deletePost);
        
        // add "createPost" permission
        $createPost = $auth->createPermission('createPost');
        $createPost->description = 'Create a post';
        $auth->add($createPost);

        // add "updatePost" permission
        $updatePost = $auth->createPermission('updatePost');
        $updatePost->description = 'Update post';
        $auth->add($updatePost);
        
        $uploadFile = $auth->createPermission('uploadFile');
        $uploadFile->description = 'Upload files';
        $auth->add($uploadFile);
        
        $uploadOwnFile = $auth->createPermission('uploadOwnFile');
        $uploadOwnFile->description = 'Upload own files';
        $uploadOwnFile->ruleName = $rule->name;
        $auth->add($uploadOwnFile);
        $auth->addChild($uploadOwnFile, $uploadFile);
        
        
        // add the "updateOwnPost" permission and associate the rule with it.
        $updateOwnPost = $auth->createPermission('updateOwnPost');
        $updateOwnPost->description = 'Update own post';
        $updateOwnPost->ruleName = $rule->name;
        $auth->add($updateOwnPost);
        
        // "updateOwnPost" will be used from "updatePost"
        $auth->addChild($updateOwnPost, $updatePost);
        
        //$rule2 = new \console\rbac\UserGroupRule();
        //$auth->add($rule2);

        $user = $auth->createRole('user');
        //$user->ruleName = $rule2->name;
        $auth->add($user);
        
        // add "author" role and give this role the "createPost" permission
        $editor = $auth->createRole('editor');
        //$editor->ruleName = $rule2->name;
        $auth->add($editor);
        $auth->addChild($editor, $createPost);
        $auth->addChild($editor, $user);
        // allow "author" to update their own posts
        $auth->addChild($editor, $updateOwnPost);
        $auth->addChild($editor, $uploadOwnFile);


        // add "admin" role and give this role the "updatePost" permission
        // as well as the permissions of the "author" role
        $admin = $auth->createRole('admin');
        //$admin->ruleName = $rule2->name;
        $auth->add($admin);
        $auth->addChild($admin, $updatePost);
        $auth->addChild($admin, $uploadFile);
        $auth->addChild($admin, $deletePost);
        $auth->addChild($admin, $editor);

        // Assign roles to users. 1 and 2 are IDs returned by IdentityInterface::getId()
        // usually implemented in your User model.
         $auth->assign($admin, '55431d5d7b446e63050041a9');
         $auth->assign($editor, '5544177c8ead0e31030041a7');
//        $auth->assign($user, 3);
//        $auth->assign($editor, 2);
//        $auth->assign($admin, 1);
   
        
    }
}

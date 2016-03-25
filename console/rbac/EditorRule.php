<?php 
namespace console\rbac;

use yii\rbac\Rule;
use frontend\models\User;
use yii\mongodb\ActiveRecord;
use Yii;
/**
 * Checks if authorID matches user passed via params
 */
class EditorRule extends Rule
{
    public $name = 'isEditor';

    /**
     * @param string|integer $user the user ID.
     * @param Item $item the role or permission that this rule is associated with
     * @param array $params parameters passed to ManagerInterface::checkAccess().
     * @return boolean a value indicating whether the rule permits the role or permission it is associated with.
     */
    public function execute($user, $item, $params)
    {
        //echo json_encode($user);
        $model = new \common\models\User();
        $user_ = $model->findIdentity($user);
        $user_name = $user_->username;
        
        return isset($params['post']) ? $params['post']->author == $user_name : false;
    }
}    


<?php
class UserIdentity extends CUserIdentity
{
    private $_id;
 
    public function authenticate()
    {
        $username=strtolower($this->username);
        $user=User::model()->find('LOWER(username)=?',array($username));
        if($user===null)
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if(!$user->validatePassword($this->password))
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
        {
            $this->_id=$user->id;
            $this->username=$user->level;
            $this->errorCode=self::ERROR_NONE;
            $auth = Yii::app()->authManager;
            $auth->isAssigned($this->username,$this->_id) ;
            //Yii::app()->session['level'] = "authorized";
            User::model()->setLastVisited($user->id);
        }
        return $this->errorCode==self::ERROR_NONE;
    }
 
    public function getId()
    {
        return $this->_id;
    }
    
}
<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $name
 * @property string $image
 * @property string $level
 * @property string $profile
 * @property integer $lastvisit
 *
 * The followings are the available model relations:
 * @property Post[] $posts
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        public $image_update;
        public $new_password;
        public $tmp_level;
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, email, name, level', 'required'),
			array('lastvisit', 'numerical', 'integerOnly'=>true),
			array('username, password, email, name, path', 'length', 'max'=>128),
                        array('image, image_update', 'file', 'safe'=>true, 'types'=>'jpg, png','allowEmpty'=>true),
                        array('password', 'required', 'on'=>'insert'),
                        array('new_password', 'default', 'on'=>'update', 'setOnEmpty'=>true),
			array('level', 'length', 'max'=>6),
			array('tmp_level', 'default', 'setOnEmpty'=>true),
			array('profile', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, email, name, level, profile, lastvisit', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'posts' => array(self::HAS_MANY, 'Post', 'author_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app','model.user.id'),
			'username' => Yii::t('app','model.user.username'),
			'password' => Yii::t('app','model.user.password'),
			'email' => Yii::t('app','model.user.email'),
			'name' => Yii::t('app','model.user.name'),
			'image' => Yii::t('app','model.user.image'),
			'level' => Yii::t('app','model.user.level'),
			'profile' => Yii::t('app','model.user.profile'),
			'lastvisit' => Yii::t('app','model.user.lastvisit'),
			'new_password' => Yii::t('app','model.user.new_password'),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('image',$this->image,true);
		$criteria->compare('level',$this->level,true);
		$criteria->compare('profile',$this->profile,true);
		$criteria->compare('lastvisit',$this->lastvisit);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        /**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{
		return CPasswordHelper::verifyPassword($password,$this->password);
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return CPasswordHelper::hashPassword($password);
	}
        
        protected function afterSave() {
            if($this->isNewRecord){
                $path = Yii::getPathOfAlias('webroot') . '/images/upload/';
                $pathDb = $this->id.rand(0, 100);
                mkdir($path.$pathDb);
                $model = $this->model()->findByPk($this->id);
                $model->path = $pathDb;
                $model->save();
                
                $auth=Yii::app()->authManager;
                $auth->assign($this->level,$this->id);
                $auth->save();
                        
            }
            return parent::afterSave();
        }
        
        protected function beforeSave() {
            if($this->isNewRecord){
                $this->password = $this->hashPassword($this->password);
                $this->lastvisit = time();
            }else{
                if(isset($this->new_password)){
                    $this->password = $this->hashPassword($this->new_password);
                }
                if($this->image_update != "update" ){
                    $this->image = $this->image_update;
                }
            }
            return parent::beforeSave();
        }

                
        public function getImageProfile($id){
            $model = $this->model()->findByPk($id);
            if(isset($model->image)){
                return Yii::app()->baseUrl."/".$model->image;
            }else{
                return Yii::app()->baseUrl."/images/user/default.png";
            }
        }
        
        public function setLastVisited($id){
            $model = $this->model()->findByPk($id);
            $model->lastvisit = time();
            $model->image_update = "update";
            $model->save();
        }
        
        public function getPathUser($id){
            $model = $this->model()->findByPk($id);
            return $model->path;
        }
}

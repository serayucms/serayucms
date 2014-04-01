<?php

class Halaman extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'tbl_post':
	 * @var integer $id
	 * @var string $title
	 * @var string $content
	 * @var string $tags
	 * @var integer $status
	 * @var integer $create_time
	 * @var integer $update_time
	 * @var integer $author_id
	 */
	const STATUS_DRAFT=1;
	const STATUS_PUBLISHED=2;
	const STATUS_ARCHIVED=3;

	

	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{post}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, status', 'required'),
			array('status', 'in', 'range'=>array(1,2,3)),
                        array('hit', 'numerical', 'integerOnly'=>true),
			array('page', 'in', 'range'=>array(0,1)),
			array('title, parent , slug, layout, meta_title', 'length', 'max'=>128),
                        array('meta_keyword', 'default'),
                        array('frontpage', 'boolean'),
                        array('meta_description', 'length','max'=>160),

			array('title, status', 'safe', 'on'=>'search'),
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
			'author' => array(self::BELONGS_TO, 'User', 'author_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('app','model.post.id'),
			'title' => Yii::t('app','model.post.title'),
			'parent' => Yii::t('app','model.post.parent'),
			'content' => Yii::t('app','model.post.content'),
			'tags' => Yii::t('app','model.post.tags'),
			'status' => Yii::t('app','model.post.status'),
			'create_time' => Yii::t('app','model.post.create_time'),
			'update_time' => Yii::t('app','model.post.update_time'),
			'author_id' => Yii::t('app','model.post.author_id'),
			'slug' => Yii::t('app','model.post.slug'),
                        'meta_title' => Yii::t('app','model.post.meta_title'),
			'meta_description' => Yii::t('app','model.post.meta_description'),
			'meta_keyword' => Yii::t('app','model.post.meta_keyword'),
                        'hit' => Yii::t('app','model.post.hit'),
                        'id_kategori' => Yii::t('app','model.post.id_kategori'),
                        'layout' => Yii::t('app','model.post.layout'),
                        'page' => Yii::t('app','model.post.page'),
                        'frontpage' => Yii::t('app','model.post.frontpage'),
		);
	}

	/**
	 * @return string the URL that shows the detail of the post
	 */
	public function getUrl(){
                if(empty($this->parent)){
                    return Yii::app()->createUrl('halaman/view', array(
                            'alias'=>$this->slug,
                    ));
                }else{
                    return Yii::app()->createUrl('halaman/view', array(
			'parent'=>$this->parent,
			'alias'=>$this->slug,
                    ));
                }
		
	}

	


	
	/**
	 * This is invoked before the record is saved.
	 * @return boolean whether the record should be saved.
	 */
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->isNewRecord)
			{
				$this->create_time=$this->update_time=time();
				$this->author_id=Yii::app()->user->id;
                                $this->slug = $this->genAlias($this->title);
                                $this->page = "1";
			}
			else{
                            if($this->slug == ""){
                                $this->slug = $this->genAlias($this->title);
                            }
                            $this->update_time=time();
                                
                        }
			return true;
		}
		else
			return false;
	}
        
         protected function genAlias($judul){
            $data = str_replace(" ", "-", strtolower($judul));
            if($this->checkAlias($data)){
                return $data;
            }else{
                return $data."-".mt_rand(); 
            }
            
        }
        
        protected function checkAlias($alias){
            if($this->count("slug = '".$alias."'") == 0){
                return true;
            }else{
                return false;
            }
        }

	
	/**
	 * Retrieves the list of posts based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the needed posts.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
                $criteria->condition = "page IS NOT NULL";
		$criteria->compare('title',$this->title,true);

		$criteria->compare('status',$this->status);
                

		return new CActiveDataProvider('Halaman', array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'status, update_time DESC',
			),
		));
	}
        
        public function frontP($id){
            $this->model()->updateAll(array('frontpage'=>"0"));
            $model = $this->model()->findByPk($id);
            $model->frontpage = true;
            $model->save();
        }
        
        public function getfrontP(){
            $model = $this->model()->find("frontpage = :st", array(":st"=>"1"));
            if(count($model) == 0){
                return NULL;
            }else{
                return $model;
            }
        }
        
        
}
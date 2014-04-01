<?php

class Post extends CActiveRecord
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
	private $_oldTags;

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
			array('title, content, status, id_kategori', 'required'),
			array('status', 'in', 'range'=>array(1,2,3)),
                        array('hit', 'numerical', 'integerOnly'=>true),
			array('page', 'in', 'range'=>array(0,1)),
			array('title, slug, layout, meta_title', 'length', 'max'=>128),
			array('tags', 'match', 'pattern'=>'/^[\w\s,]+$/', 'message'=>'Tags can only contain word characters.'),
			array('tags', 'normalizeTags'),
                        array('meta_keyword', 'default'),
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
                        'idKategori' => array(self::BELONGS_TO, 'Kategori', 'id_kategori'),
			'author' => array(self::BELONGS_TO, 'User', 'author_id'),
			'comments' => array(self::HAS_MANY, 'Comment', 'post_id', 'condition'=>'comments.status='.Comment::STATUS_APPROVED, 'order'=>'comments.create_time DESC'),
			'commentCount' => array(self::STAT, 'Comment', 'post_id', 'condition'=>'status='.Comment::STATUS_APPROVED),
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
		);
	}

	/**
	 * @return string the URL that shows the detail of the post
	 */
	public function getUrl()
	{
		return Yii::app()->createUrl('artikel/view', array(
			'alias'=>$this->slug,
		));
	}

	/**
	 * @return array a list of links that point to the post list filtered by every tag of this post
	 */
	public function getTagLinks()
	{
		$links=array();
		foreach(Tag::string2array($this->tags) as $tag)
			$links[]=CHtml::link(CHtml::encode($tag), array('artikel/index', 'tag'=>$tag));
		return $links;
	}

	/**
	 * Normalizes the user-entered tags.
	 */
	public function normalizeTags($attribute,$params)
	{
		$this->tags=Tag::array2string(array_unique(Tag::string2array($this->tags)));
	}

	/**
	 * Adds a new comment to this post.
	 * This method will set status and post_id of the comment accordingly.
	 * @param Comment the comment to be added
	 * @return boolean whether the comment is saved successfully
	 */
	public function addComment($comment)
	{
		if(Yii::app()->params['commentNeedApproval'])
			$comment->status=Comment::STATUS_PENDING;
		else
			$comment->status=Comment::STATUS_APPROVED;
		$comment->post_id=$this->id;
		return $comment->save();
	}

	/**
	 * This is invoked when a record is populated with data from a find() call.
	 */
	protected function afterFind()
	{
		parent::afterFind();
		$this->_oldTags=$this->tags;
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
			}
			else
                            if($this->slug == ""){
                                $this->slug = $this->genAlias($this->title);
                            }
                            if($this->scenario == "update"){
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
	 * This is invoked after the record is saved.
	 */
	protected function afterSave()
	{
		parent::afterSave();
		Tag::model()->updateFrequency($this->_oldTags, $this->tags);
	}

	/**
	 * This is invoked after the record is deleted.
	 */
	protected function afterDelete()
	{
		parent::afterDelete();
		Comment::model()->deleteAll('post_id='.$this->id);
		Tag::model()->updateFrequency($this->tags, '');
	}

	/**
	 * Retrieves the list of posts based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the needed posts.
	 */
	public function search()
	{
		$criteria=new CDbCriteria;
                $criteria->condition = "page IS NULL";
                
                if(Yii::app()->user->checkAccess("author") && !Yii::app()->user->checkAccess("admin"))
			$criteria->addSearchCondition('author_id',Yii::app()->user->getId());

		$criteria->compare('title',$this->title,true);

		$criteria->compare('status',$this->status);

		return new CActiveDataProvider('Post', array(
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'status, update_time DESC',
			),
		));
	}
        
        
}
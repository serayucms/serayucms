<?php

class ArtikelController extends Controller
{
	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;
        public function actionIndex()
	{
                if(Menu::model()->checkRouteInMenu(array("/artikel/index"))):
                    $this->layout = Yii::app()->params['layoutArtikel'];
                    $this->pageTitle= Yii::app()->params['title'] ." | Artikel";
                    $this->breadcrumbs=array(
                            'Artikel',
                    );
                    $criteria=new CDbCriteria(array(
                            'condition'=>'status='.Post::STATUS_PUBLISHED." AND page IS NULL",
                            'order'=>'update_time DESC',
                            'with'=>'commentCount',
                    ));
                    if(isset($_GET['tag'])){
                            $criteria->addSearchCondition('tags',$_GET['tag']);
                    }
                    if(isset($_GET['kategori'])){
                            $kategori = Kategori::model()->find("alias_kategori = :alias",array(":alias"=>$_GET['kategori']));
                            if(!empty($kategori)){
                                $criteria->addSearchCondition('id_kategori',$kategori->id_kategori);
                            }else{
                                throw new CHttpException(404,'Kategori yang anda cari tidak ditemukan.');
                            }
                            
                    }
                    
                    $dependecy = new CDbCacheDependency('SELECT MAX(update_time) FROM {{post}}');
 
                    $dataProvider= new CActiveDataProvider(Post::model()->cache(1000, $dependecy, 2), array ( 
                        'pagination'=>array(
                                    'pageSize'=>Yii::app()->params['postsPerPage'],
                            ),
                        'criteria'=>$criteria,
                    ));
                    /*
                    $dataProvider=new CActiveDataProvider('Post', array(
                            'pagination'=>array(
                                    'pageSize'=>Yii::app()->params['postsPerPage'],
                            ),
                            'criteria'=>$criteria,
                    ));
                    */
                    $this->render('index',array(
                            'dataProvider'=>$dataProvider,
                    ));
                else:
                    throw new CHttpException(404,'Halaman yang anda cari tidak ditemukan.');
                endif;
                
	}
        
        

        public function actionView()
	{
                $post=$this->loadModel();
                $this->layout = Yii::app()->params['layoutArtikel'];
                $this->breadcrumbs=array(
                        'Artikel'=>array('artikel/index'),
                        $post->title,
                );
                $this->pageTitle= Yii::app()->params['title'] ." | ". $post->title;
                $this->metaDescription = $post->meta_description;
                $this->metaTitle = $post->meta_title;
                $this->metaKeyword = $post->meta_keyword;
                
		$comment=$this->newComment($post);

		$this->render('view',array(
			'model'=>$post,
			'comment'=>$comment,
		));
	}
        
        public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['alias']))
			{
                                $dependency = new CDbCacheDependency('SELECT MAX(update_time) FROM {{post}}');
                                $this->_model = Post::model()->cache(1000, $dependency)->find('slug = :sl AND status ='.Post::STATUS_PUBLISHED.' OR status='.Post::STATUS_ARCHIVED, array(":sl"=>$_GET['alias']));
                                //$this->_model=Post::model()->find('slug = :sl AND status ='.Post::STATUS_PUBLISHED.' OR status='.Post::STATUS_ARCHIVED, array(":sl"=>$_GET['alias']));
                                if(!empty($this->_model)){
                                    $this->_model->setScenario("hitUpdate");
                                    $this->_model->hit = $this->_model->hit + 1;
                                    $this->_model->update();
                                }
			}
			if($this->_model===null)
				throw new CHttpException(404,'Artikel yang anda cari tidak ditemukan.');
		}
		return $this->_model;
	}

	protected function newComment($post)
	{
		$comment=new Comment;
		if(isset($_POST['ajax']) && $_POST['ajax']==='comment-form')
		{
			echo CActiveForm::validate($comment);
			Yii::app()->end();
		}
		if(isset($_POST['Comment']))
		{
			$comment->attributes=$_POST['Comment'];
			if($post->addComment($comment))
			{
				if($comment->status==Comment::STATUS_PENDING)
					Yii::app()->user->setFlash('commentSubmitted','Thank you for your comment. Your comment will be posted once it is approved.');
				$this->refresh();
			}
		}
		return $comment;
	}

}
<?php

/**
 * This is the model class for table "od_menu".
 *
 * The followings are the available columns in table 'od_menu':
 * @property integer $id
 * @property integer $parent_id
 * @property string $label
 * @property integer $position
 * @property string $url
 */
class Menu extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{menu}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('label, url', 'required'),
			array('parent_id, position, id_menu_parent', 'numerical', 'integerOnly'=>true),
			array('label, url', 'length', 'max'=>256),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, parent_id, label, position, url', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'parent_id' => 'Parent',
			'label' => 'Label',
			'position' => 'Position',
			'url' => 'Url',
			'id_menu_parent' => 'Parent Menu',
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('label',$this->label,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('url',$this->url,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Menu the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getMenuItem($name){
            $array = array();
            $id_temp = ParentMenu::model()->find("name = :name",array(":name"=>$name));
            $idMenuParent = $id_temp == NULL ? $id_temp : $id_temp->id;
            $menu = $this->findAll(array('condition'=>'id_menu_parent = :idMenuParent','params'=>array(':idMenuParent'=>$idMenuParent), 'order'=>'parent_id, position'));
                foreach ($menu as $key => $level1){
                    if($level1->parent_id == 0){
                        if($this->checkAnakan($level1->id)){
                            $array = array_merge($array, array(array('label'=>$level1->label,'linkOptions'=>array("title"=>$level1->label),'url'=>unserialize($level1->url),'items'=>$this->itemBawahan($level1->id))) );
                        }else{
                            $array = array_merge($array, array(array('label'=>$level1->label,'linkOptions'=>array("title"=>$level1->label),'url'=>unserialize($level1->url))) );
                        }
                    }

                }
            return $array;
        }

        private function itemBawahan($parent){
            $array = array();
            $menu = $this->findAll("parent_id=:parent Order by position",array('parent'=>$parent));
            foreach ($menu as $key => $level1){
                if($level1->parent_id == $parent){
                    if($this->checkAnakan($level1->id)){
                        $array = array_merge($array, array(array('label'=>$level1->label,'linkOptions'=>array("title"=>$level1->label),'url'=>unserialize($level1->url),'items'=>$this->itemBawahan($level1->id))) );
                    }else{
                        $array = array_merge($array, array(array('label'=>$level1->label,'linkOptions'=>array("title"=>$level1->label),'url'=>unserialize($level1->url))) );
                    }

                }

            }
            return $array;      
        }
        
        private function checkAnakan($parent){
            $menu = $this->findAll("parent_id=:parent",array('parent'=>$parent));
            if(empty($menu[0]->id)){
                return false;
            }else{
                return true;
            }
        }
        
        protected function beforeSave() {
            $url = explode("/", $this->url);
            if(is_array($url)){
                switch (count($url)) {
                    case 2:
                        $this->url = serialize(array("/".$url[0]."/".$url[1]));
                        break;
                    case 3:
                        $this->url = serialize(array("/".$url[0]."/".$url[1]."/".$url[2]));
                        break;
                    case 4:
                        $this->url = serialize(array("/".$url[0]."/".$url[1], $url[2]=>$url[3]));
                        break;

                    default:
                         $this->url = serialize(array($url[0]));
                        break;
                }
            }
            
            return parent::beforeSave();
        }
        
        private function isSerialized($str) {
            return ($str == serialize(false) || @unserialize($str) !== false);
        }
        
        public function tampilMenuUrl(){
                if($this->isSerialized($this->url)){
                    $url = unserialize($this->url);
                    if(isset($url['alias'])){
                        return $url[0]."/alias/".$url['alias'];
                    }else{
                        return $url[0];
                    }
                }   
        }
        
        public function checkRouteInMenu($route){
            $url = serialize($route);
            $u = $this->find("url = :url",array(":url"=>$url));
            if(count($u) != 0){
                return true;
            }else{
                return false;
            }
        }
       
}

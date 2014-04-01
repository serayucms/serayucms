<?php

/**
 * This is the model class for table "od_kategori".
 *
 * The followings are the available columns in table 'od_kategori':
 * @property integer $id_kategori
 * @property string $nama_kategori
 * @property string $keterangan_kategori
 * @property integer $id_parent
 * @property string $alias_kategori
 *
 * The followings are the available model relations:
 * @property Artikel[] $artikels
 * @property Kategori $idParent
 * @property Kategori[] $kategoris
 */
class Kategori extends CActiveRecord
{
	
        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{kategori}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_kategori', 'required'),
			array('id_parent', 'numerical', 'integerOnly'=>true),
			array('nama_kategori, alias_kategori', 'length', 'max'=>128),
			array('keterangan_kategori', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_kategori, nama_kategori, keterangan_kategori, id_parent, alias_kategori', 'safe', 'on'=>'search'),
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
			'artikels' => array(self::HAS_MANY, 'Artikel', 'id_kategori'),
			'idParent' => array(self::BELONGS_TO, 'Kategori', 'id_parent'),
			'kategoris' => array(self::HAS_MANY, 'Kategori', 'id_parent'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_kategori' => Yii::t('app','model.kategori.id_kategori'),
			'nama_kategori' => Yii::t('app','model.kategori.nama_kategori'),
			'keterangan_kategori' => Yii::t('app','model.kategori.keterangan_kategori'),
			'id_parent' => Yii::t('app','model.kategori.id_parent'),
			'alias_kategori' => Yii::t('app','model.kategori.alias_kategori'),
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

		$criteria->compare('id_kategori',$this->id_kategori);
		$criteria->compare('nama_kategori',$this->nama_kategori,true);
		$criteria->compare('keterangan_kategori',$this->keterangan_kategori,true);
		$criteria->compare('id_parent',$this->id_parent);
		$criteria->compare('alias_kategori',$this->alias_kategori,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Kategori the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        protected function beforeValidate() {
            if($this->isNewRecord){
                $this->alias_kategori = $this->genAlias($this->nama_kategori);
            }
            return parent::beforeSave();
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
            if($this->count("alias_kategori = '".$alias."'") == 0){
                return true;
            }else{
                return false;
            }
        }
        
        

}

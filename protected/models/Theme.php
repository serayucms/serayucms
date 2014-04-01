<?php

/**
 * This is the model class for table "od_theme".
 *
 * The followings are the available columns in table 'od_theme':
 * @property integer $id_theme
 * @property string $nama_theme
 * @property string $gambar_theme
 * @property string $pembuat_theme
 * @property string $keterangan_theme
 * @property string $status_theme
 *
 * The followings are the available model relations:
 * @property WidgetPosisi[] $widgetPosisis
 */
class Theme extends CActiveRecord
{
	
        /**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{theme}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_theme, gambar_theme, pembuat_theme, keterangan_theme, status_theme', 'required'),
			array('nama_theme, gambar_theme, pembuat_theme', 'length', 'max'=>128),
			array('status_theme', 'length', 'max'=>1),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_theme, nama_theme, gambar_theme, pembuat_theme, keterangan_theme, status_theme', 'safe', 'on'=>'search'),
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
			'widgetPosisis' => array(self::HAS_MANY, 'WidgetPosisi', 'id_theme'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_theme' => Yii::t("app", 'model.theme.id_theme'),
			'nama_theme' => Yii::t("app", 'model.theme.nama_theme'),
			'gambar_theme' => Yii::t("app", 'model.theme.gambar_theme'),
			'pembuat_theme' => Yii::t("app", 'model.theme.pembuat_theme'),
			'keterangan_theme' => Yii::t("app", 'model.theme.keterangan_theme'),
			'status_theme' => Yii::t("app", 'model.theme.status_theme'),
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
                $criteria->condition = "status_theme='0'";
		$criteria->compare('id_theme',$this->id_theme);
		$criteria->compare('nama_theme',$this->nama_theme,true);
		$criteria->compare('gambar_theme',$this->gambar_theme,true);
		$criteria->compare('pembuat_theme',$this->pembuat_theme,true);
		$criteria->compare('keterangan_theme',$this->keterangan_theme,true);
		$criteria->compare('status_theme',$this->status_theme,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Theme the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getActiveTheme(){
            $model = $this->find('status_theme = 1');
            if(!empty($model->nama_theme)){
                return $model->nama_theme;
            }else{
                return NULL;
            }
            
            //return $this->nama_theme;
        }
        
        public function nonActiveTheme(){
            $this->updateAll(array("status_theme"=>"0"));
        }
        
}

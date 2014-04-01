<?php

/**
 * This is the model class for table "{{widget_posisi}}".
 *
 * The followings are the available columns in table '{{widget_posisi}}':
 * @property integer $id_wp
 * @property string $nama_wp
 * @property integer $id_layouts
 *
 * The followings are the available model relations:
 * @property DetailWp[] $detailWps
 * @property Layouts $idLayouts
 */
class WidgetPosisi extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{widget_posisi}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_wp, id_layouts, id_theme', 'required'),
			array('id_layouts, id_theme', 'numerical', 'integerOnly'=>true),
			array('nama_wp', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_wp, nama_wp, id_layouts', 'safe', 'on'=>'search'),
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
			'detailWps' => array(self::HAS_MANY, 'DetailWp', 'id_widget_posisi'),
			'idLayouts' => array(self::BELONGS_TO, 'Layouts', 'id_layouts'),
			'idTheme' => array(self::BELONGS_TO, 'Theme', 'id_theme'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_wp' => 'Id Wp',
			'nama_wp' => 'Nama Wp',
			'id_layouts' => 'Id Layouts',
			'id_theme' => 'Id Theme',
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

		$criteria->compare('id_wp',$this->id_wp);
		$criteria->compare('nama_wp',$this->nama_wp,true);
		$criteria->compare('id_layouts',$this->id_layouts);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return WidgetPosisi the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

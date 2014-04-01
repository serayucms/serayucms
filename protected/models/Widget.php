<?php

/**
 * This is the model class for table "od_widget".
 *
 * The followings are the available columns in table 'od_widget':
 * @property integer $id_widget
 * @property string $nama_widget
 * @property string $pembuat_widget
 * @property string $keterangan
 *
 * The followings are the available model relations:
 * @property DetailWp[] $detailWps
 */
class Widget extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{widget}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_widget', 'required'),
			array('nama_widget, pembuat_widget', 'length', 'max'=>128),
			array('keterangan', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_widget, nama_widget, pembuat_widget, keterangan', 'safe', 'on'=>'search'),
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
			'detailWps' => array(self::HAS_MANY, 'DetailWp', 'id_widget'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_widget' => Yii::t("app",'model.widget.id_widget'),
			'nama_widget' => Yii::t("app",'model.widget.nama_widget'),
			'pembuat_widget' => Yii::t("app",'model.widget.pembuat_widget'),
			'keterangan' => Yii::t("app",'model.widget.keterangan'),
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

		$criteria->compare('id_widget',$this->id_widget);
		$criteria->compare('nama_widget',$this->nama_widget,true);
		$criteria->compare('pembuat_widget',$this->pembuat_widget,true);
		$criteria->compare('keterangan',$this->keterangan,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Widget the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

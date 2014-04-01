<?php

/**
 * This is the model class for table "od_detail_wp".
 *
 * The followings are the available columns in table 'od_detail_wp':
 * @property integer $id_detail_wp
 * @property integer $id_widget_posisi
 * @property integer $id_widget
 * @property string $config
 *
 * The followings are the available model relations:
 * @property Widget $idWidget
 * @property WidgetPosisi $idWidgetPosisi
 */
class DetailWp extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
                return '{{detail_wp}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_widget_posisi, id_widget, config', 'required'),
			array('id_widget_posisi, id_widget', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_detail_wp, id_widget_posisi, id_widget, config', 'safe', 'on'=>'search'),
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
			'idWidget' => array(self::BELONGS_TO, 'Widget', 'id_widget'),
			'idWidgetPosisi' => array(self::BELONGS_TO, 'WidgetPosisi', 'id_widget_posisi'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id_detail_wp' => 'Id Detail Wp',
			'id_widget_posisi' => 'Id Widget Posisi',
			'id_widget' => 'Id Widget',
			'config' => 'Config',
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

		$criteria->compare('id_detail_wp',$this->id_detail_wp);
		$criteria->compare('id_widget_posisi',$this->id_widget_posisi);
		$criteria->compare('id_widget',$this->id_widget);
		$criteria->compare('config',$this->config,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
	public function searchBy($id)
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
                $criteria->condition = "id_widget_posisi = '".$id."'";
		$criteria->compare('id_detail_wp',$this->id_detail_wp);
		$criteria->compare('id_widget_posisi',$this->id_widget_posisi);
		$criteria->compare('id_widget',$this->id_widget);
		$criteria->compare('config',$this->config,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DetailWp the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}

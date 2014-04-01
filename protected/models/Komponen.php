<?php

/**
 * This is the model class for table "od_komponen".
 *
 * The followings are the available columns in table 'od_komponen':
 * @property integer $id_komponen
 * @property string $nama_komponen
 * @property string $pembuat_komponen
 * @property string $keterangan_komponen
 * @property string $gambar_komponen
 */
class Komponen extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
                return '{{komponen}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nama_komponen, pembuat_komponen, keterangan_komponen', 'required'),
			array('nama_komponen, pembuat_komponen, pengguna_komponen, gambar_komponen', 'length', 'max'=>128),
                        array('table_komponen, pembuat_komponen','safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id_komponen, nama_komponen, pembuat_komponen, keterangan_komponen, gambar_komponen', 'safe', 'on'=>'search'),
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
			'id_komponen' => Yii::t("app",'model.komponen.id_komponen'),
			'nama_komponen' => Yii::t("app",'model.komponen.nama_komponen'),
			'pembuat_komponen' => Yii::t("app",'model.komponen.pembuat_komponen'),
			'keterangan_komponen' => Yii::t("app",'model.komponen.keterangan_komponen'),
			'gambar_komponen' => Yii::t("app",'model.komponen.gambar_komponen'),
			'table_komponen' => Yii::t("app",'model.komponen.table_komponen'),
			'pengguna_komponen' => Yii::t("app",'model.komponen.pengguna_komponen'),
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

		$criteria->compare('id_komponen',$this->id_komponen);
		$criteria->compare('nama_komponen',$this->nama_komponen,true);
		$criteria->compare('pembuat_komponen',$this->pembuat_komponen,true);
		$criteria->compare('keterangan_komponen',$this->keterangan_komponen,true);
		$criteria->compare('gambar_komponen',$this->gambar_komponen,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Komponen the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function jumlahKomponen(){
            return count($this->findAll());
        }
}

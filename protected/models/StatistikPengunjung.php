<?php

/**
 * This is the model class for table "od_statistik_pengunjung".
 *
 * The followings are the available columns in table 'od_statistik_pengunjung':
 * @property string $ip_sp
 * @property string $tanggal_sp
 * @property integer $hit_sp
 * @property string $online_sp
 */
class StatistikPengunjung extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{statistik_pengunjung}}';
                
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ip_sp, tanggal_sp, hit_sp, online_sp', 'required'),
			array('hit_sp', 'numerical', 'integerOnly'=>true),
			array('ip_sp, online_sp', 'length', 'max'=>128),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ip_sp, tanggal_sp, hit_sp, online_sp', 'safe', 'on'=>'search'),
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
			'ip_sp' => 'Ip Sp',
			'tanggal_sp' => 'Tanggal Sp',
			'hit_sp' => 'Hit Sp',
			'online_sp' => 'Online Sp',
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

		$criteria->compare('ip_sp',$this->ip_sp,true);
		$criteria->compare('tanggal_sp',$this->tanggal_sp,true);
		$criteria->compare('hit_sp',$this->hit_sp);
		$criteria->compare('online_sp',$this->online_sp,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StatistikPengunjung the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function perTahun($tahun = NULL){
            
            if($tahun == NULL){
                for($i=1;$i<=date("m");$i++):
                $hasil[] = (int) $this->count("YEAR(tanggal_sp) = :th AND MONTH(tanggal_sp) = :mt",array(
                    ":th"=>date("Y"),
                    ":mt"=>$i,
                ));
                endfor;
            }
            return $hasil;
        }
        
        


        public function updatePengunjung($ip){
            $sp = $this->model()->findByAttributes(array(
                "ip_sp"=>$ip,
                "tanggal_sp"=>date("Y-m-d"),
                ));
            if(count($sp) != 0){
                StatistikPengunjung::model()->updateAll(
                            array(
                                "online_sp"=>time()
                                ), 
                            "ip_sp = :ip AND tanggal_sp = :tanggal",
                            array(
                                ":ip"=>$ip,
                                ":tanggal"=>date("Y-m-d"),
                            )
                        );
            }else{
                $model = new StatistikPengunjung();
                $model->ip_sp = $ip;
                $model->tanggal_sp = date("Y-m-d");
                $model->hit_sp = "1";
                $model->online_sp = time();
                $model->save();
            }
        }
}

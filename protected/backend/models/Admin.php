<?php

/**
 * This is the model class for table "{{admin}}".
 *
 * The followings are the available columns in table '{{admin}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $profile
 * @property integer $add_time
 * @property integer $update_time
 */
class Admin extends CActiveRecord
{
   public $cpassword; //重复密码
   public $upassword; //更新时的密码
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Admin the static model class
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
		return '{{admin}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('username, email', 'required'),
            array('password, cpassword','required','on'=>'insert'),
 			array('add_time, update_time', 'numerical', 'integerOnly'=>true),
			array('username, password, email', 'length', 'max'=>128),
            array('password','length','min'=>6),
            array('email,username','unique'),
            array('email','email'),
            array('password','compare','compareAttribute'=>'cpassword'),//create
            array('profile', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, profile, add_time, update_time', 'safe', 'on'=>'search'),
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
            'cpassword' => '确认密码：',
			'id' => 'ID',
			'username' => '用户名：',
			'password' => '密码：',
            'upassword' => '新密码：',
			'email' => 'Email：',
			'profile' => '简介：',
			'add_time' => '添加时间：',
			'update_time' => '更新时间：',
		);
	}

    /*
     *
     */
    protected function beforeSave(){
        if(parent::beforeSave()){
           if($this->isNewRecord){
              $this->add_time = $this->update_time = time();
           }else{
              $this->update_time = time();
           }
           return true;
        }else{
           return false;
        }
    }

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('profile',$this->profile,true);
		$criteria->compare('add_time',$this->add_time);
		$criteria->compare('update_time',$this->update_time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function encryptPassword($password,$hash='md5'){
       if($hash == 'md5'){
          return md5($password);
       }
    }

    public function validatePassword($password,$hash = 'md5'){
       $password = $this->encryptPassword($password);
       return ($password == $this->password);
    }
}
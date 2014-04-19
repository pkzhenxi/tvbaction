<?php

/**
 * This is the model class for table "{{users}}".
 *
 * The followings are the available columns in table '{{users}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $activkey
 * @property integer $superuser
 * @property integer $status
 * @property integer $create_at
 * @property integer $lastvisit_at
 */
class Users extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
    public $cpassword;//密码确认
    public $upassword;//临时存储密码

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{users}}';
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
            array('email,username','unique'),
            array('email','email'),
            array('password','compare','compareAttribute'=>'cpassword'),
            array('password,cpassword','required','on'=>'insert'),
            array('password','length','min'=>6),
			array('superuser, status, create_at, lastvisit_at', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>20),
			array('password, email, activkey', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, activkey, superuser, status, create_at, lastvisit_at', 'safe', 'on'=>'search'),
		);
	}

    /*
     * 是否超级用户下拉数据
     */
    public static function isSuperUser(){
        return array(
            '0' => UserModule::t('no'),
            '1' => UserModule::t('yes')
        );
    }

    /*
     * 用户状态下拉数据
     */
    public static  function userStatus(){
        return array(
            '0' => UserModule::t('inavailable'),
            '1' => UserModule::t('available')
        );
    }

    /*
     * 返回是否超级用户
     */
    public function getSuperUserlabel(){
        return $this->superuser ? UserModule::t('yes') : UserModule::t('no');
    }

    /*
     * 返回用户状态
     */
    public function getUserStatus(){
        return $this->status ? UserModule::t('available') : UserModule::t('inavailable');
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
			'id' => 'ID:',
			'username' => '用户名：',
			'password' => '密码：',
            'cpassword' => '确认密码：',
			'email' => '邮件：',
			'activkey' => '激活码：',
			'superuser' => '超级用户：',
			'status' => '状态：',
			'create_at' => '创建时间：',
			'lastvisit_at' => '最后登录时间：',
		);
	}

    protected function beforeSave(){
        if(parent::beforeSave()){
           if($this->isNewRecord){
              $this->create_at = time();
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
		$criteria->compare('activkey',$this->activkey,true);
		$criteria->compare('superuser',$this->superuser);
		$criteria->compare('status',$this->status);
		$criteria->compare('create_at',$this->create_at);
		$criteria->compare('lastvisit_at',$this->lastvisit_at);

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
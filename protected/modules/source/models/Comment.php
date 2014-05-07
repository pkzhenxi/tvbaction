<?php

/**
 * This is the model class for table "{{comment}}".
 *
 * The followings are the available columns in table '{{comment}}':
 * @property string $id
 * @property integer $uid
 * @property integer $v_id
 * @property integer $typeid
 * @property string $username
 * @property string $ip
 * @property integer $ischeck
 * @property string $dtime
 * @property string $msg
 * @property string $m_type
 * @property integer $reply
 * @property string $agree
 * @property string $anti
 * @property string $pic
 * @property string $vote
 */
class Comment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
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
		return '{{comment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('reply', 'required'),
			array('uid, v_id, typeid, ischeck, reply', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>20),
			array('ip', 'length', 'max'=>15),
			array('dtime', 'length', 'max'=>10),
			array('m_type, agree, anti, vote', 'length', 'max'=>6),
			array('pic', 'length', 'max'=>255),
			array('msg', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, uid, v_id, typeid, username, ip, ischeck, dtime, msg, m_type, reply, agree, anti, pic, vote', 'safe', 'on'=>'search'),
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
            'vdata'=>array(self::BELONGS_TO,'Data','v_id'),
		);
	}

    /*
     * @return 返回一个被截取的字符
     */
    public function cutmsg($len=50){
       $length = strlen($this->msg);
       return ( $length > $len ) ? substr($this->msg,0,$len) : $this->msg;
    }

    /*
     * @return dropdownlist for model filter
     */
    public static function setIscheck(){
        return array(
            '1'=>'审核',
            '0'=>'未审核',
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uid' => 'Uid',
			'v_id' => 'V',
			'typeid' => 'Typeid',
			'username' => '评论人:',
			'ip' => 'ip地址:',
			'ischeck' => 'Ischeck',
			'dtime' => '评论时间:',
			'msg' => '评论内容: ',
			'm_type' => 'M Type',
			'reply' => 'Reply',
			'agree' => 'Agree',
			'anti' => 'Anti',
			'pic' => 'Pic',
			'vote' => 'Vote',
		);
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('v_id',$this->v_id);
		$criteria->compare('typeid',$this->typeid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('ischeck',$this->ischeck);
		$criteria->compare('dtime',$this->dtime,true);
		$criteria->compare('msg',$this->msg,true);
		$criteria->compare('m_type',$this->m_type,true);
		$criteria->compare('reply',$this->reply);
		$criteria->compare('agree',$this->agree,true);
		$criteria->compare('anti',$this->anti,true);
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('vote',$this->vote,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
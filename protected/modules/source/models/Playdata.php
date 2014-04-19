<?php

/**
 * This is the model class for table "{{playdata}}".
 *
 * The followings are the available columns in table '{{playdata}}':
 * @property integer $v_id
 * @property integer $tid
 * @property string $body
 * @property string $body1
 */
class Playdata extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Playdata the static model class
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
		return '{{playdata}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('v_id, tid', 'numerical', 'integerOnly'=>true),
			array('body, body1', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('v_id, tid, body, body1', 'safe', 'on'=>'search'),
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
			'v_id' => 'V',
			'tid' => 'Tid',
			'body' => 'Body',
			'body1' => 'Body1',
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

		$criteria->compare('v_id',$this->v_id);
		$criteria->compare('tid',$this->tid);
		$criteria->compare('body',$this->body,true);
		$criteria->compare('body1',$this->body1,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
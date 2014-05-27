<?php

/**
 * This is the model class for table "{{album}}".
 *
 * The followings are the available columns in table '{{album}}':
 * @property integer $id
 * @property string $sort
 * @property string $name
 * @property integer $vid
 * @property string $artist
 * @property string $company
 * @property string $language
 * @property string $introduction
 * @property string $picture
 * @property string $pubtime
 * @property string $recommend
 * @property integer $hit
 * @property integer $good
 * @property string $time
 * @property string $check
 */
class Album extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Album the static model class
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
		return '{{album}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('vid, hit, good,recommend', 'numerical','integerOnly'=>true),
			array('sort', 'length', 'max'=>5),
			array('name, artist, company, pubtime', 'length', 'max'=>255),
			array('language', 'length', 'max'=>15),
			array('ischeck', 'length', 'max'=>1),
            array('picture,introduction','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, sort, name, vid, artist, company, language, introduction, picture, pubtime, recommend, hit, good, time, ischeck', 'safe', 'on'=>'search'),
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
            'vdata'=>array(self::BELONGS_TO,'Data','vid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'sort' => '排序：',
			'name' => '专辑名称：',
			'vid' => '所属视频：',
			'artist' => 'Artist',
			'company' => '公司：',
			'language' => '语言：',
			'introduction' => '专辑介绍：',
			'picture' => '专题图片：',
			'pubtime' => '出版时间：',
			'recommend' => '推荐：',
			'hit' => '点击：',
			'good' => 'Good',
			'time' => 'Time',
			'ischeck' => '审核：',
		);
	}

    /*
     * 审核数据
     */
    public static  function getCheckdownlist(){
        return array(
            0=>'不通过',
            1=>'通过',
        );
    }

    public function getNamewithimage(){
        $image = empty($this->picture) ? '' : "<img src=".Yii::app()->theme->baseUrl."/images/picture.png style='margin-right:5px;cursor: pointer;' class='title2div' title='<img src=".Yii::app()->request->baseUrl."/upload/".$this->picture." >' >";
        echo $image.$this->name;
    }

    protected  function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->time = time();
            }
            return true;
        }
        else
            return false;
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
		$criteria->compare('sort',$this->sort,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('vid',$this->vid);
		$criteria->compare('artist',$this->artist,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('introduction',$this->introduction,true);
		$criteria->compare('picture',$this->picture,true);
		$criteria->compare('pubtime',$this->pubtime,true);
		$criteria->compare('recommend',$this->recommend,true);
		$criteria->compare('hit',$this->hit);
		$criteria->compare('good',$this->good);
		$criteria->compare('time',$this->time,true);
		$criteria->compare('ischeck',$this->ischeck,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));
	}
}
<?php

/**
 * This is the model class for table "{{category}}".
 *
 * The followings are the available columns in table '{{category}}':
 * @property string $id
 * @property string $root
 * @property string $lft
 * @property string $rgt
 * @property integer $level
 * @property string $name
 * @property string $url
 * @property string $pic
 * @property string $position
 * @property integer $isshow
 * @property string $title
 * @property string $keyword
 * @property string $description
 */
class Category extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Category the static model class
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
		return '{{category}}';
	}

    public function behaviors()
    {
        return array(
            'nestedSetBehavior'=>array(
                'class'=>'ext.nested-set-behavior.NestedSetBehavior',
            ),
        );
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
            array('name','unique'),
			array('level, isshow', 'numerical', 'integerOnly'=>true),
			array('root, lft, rgt', 'length', 'max'=>10),
			array('name, description', 'length', 'max'=>100),
			array('url, pic', 'length', 'max'=>255),
			array('position', 'length', 'max'=>45),
			array('title, keyword', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, root, lft, rgt, level, name, url, pic, position, isshow, title, keyword, description', 'safe', 'on'=>'search'),
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

    public static function allVideoCategoriesDownList(){
        $category = self::model()->findByPk(1);
        $descendants=$category->descendants()->findAll();
        $arr = array();
        if(isset($descendants) && !empty($category)){
            foreach($descendants as $vaule){
                $name = str_repeat("&nbsp;&nbsp;",($vaule->level)-2).$vaule->name;
                $arr[$name] = $vaule->id;
            }
        }
        return array_flip($arr);
    }

    public static function allViedoCatergories(){
        $category = self::model()->findByPk(1);
        $descendants=$category->descendants()->findAll();
        $arr = array();
        if(isset($descendants) && !empty($category)){
            foreach($descendants as $vaule){
                $arr[$vaule->id] = $vaule->name;
            }
        }
        return $arr;
    }

    /*
     * 是否显示
     */
    public static function arrIsShow(){
        return array(
            '0' => '不显示',
            '1' => '显示',
        );
    }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'root' => '所属分类：',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'level' => 'Level',
			'name' => '名称：',
			'url' => 'Url',
			'pic' => 'Pic',
			'position' => 'Position',
			'isshow' => '是否显示',
			'title' => '标题：',
			'keyword' => '关键字：',
			'description' => '描述：',
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
		$criteria->compare('root',$this->root,true);
		$criteria->compare('lft',$this->lft,true);
		$criteria->compare('rgt',$this->rgt,true);
		$criteria->compare('level',">=2");
		$criteria->compare('name',$this->name,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('position',$this->position,true);
		$criteria->compare('isshow',$this->isshow);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('keyword',$this->keyword,true);
		$criteria->compare('description',$this->description,true);
        $criteria->order = "lft desc";

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
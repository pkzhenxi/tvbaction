<?php

/**
 * This is the model class for table "{{data}}".
 *
 * The followings are the available columns in table '{{data}}':
 * @property integer $id
 * @property string $tid
 * @property string $name
 * @property string $state
 * @property string $pic
 * @property integer $hit
 * @property integer $money
 * @property integer $rank
 * @property integer $digg
 * @property integer $tread
 * @property integer $commend
 * @property integer $wrong
 * @property integer $ismake
 * @property string $actor
 * @property string $color
 * @property string $publishyear
 * @property string $publisharea
 * @property string $addtime
 * @property string $topic
 * @property string $note
 * @property string $tags
 * @property string $letter
 * @property integer $isunion
 * @property integer $recycled
 * @property string $director
 * @property string $enname
 * @property string $lang
 * @property string $score
 * @property string $extratype
 */
class Data extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Data the static model class
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
		return '{{data}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
            array('name,tid','required'),
			array('hit, money, rank, digg, tread, commend, wrong, ismake, isunion, recycled', 'numerical', 'integerOnly'=>true),
			array('tid', 'length', 'max'=>8),
			array('name', 'length', 'max'=>60),
			array('state, addtime, score', 'length', 'max'=>10),
			array('pic', 'length', 'max'=>255),
			array('actor, director, enname, lang', 'length', 'max'=>200),
			array('color', 'length', 'max'=>7),
			array('publishyear, publisharea', 'length', 'max'=>20),
			array('topic', 'length', 'max'=>11),
			array('note, tags', 'length', 'max'=>30),
			array('letter', 'length', 'max'=>3),
			array('extratype', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tid, name, state, pic, hit, money, rank, digg, tread, commend, wrong, ismake, actor, color, publishyear, publisharea, addtime, updatetime,topic, note, tags, letter, isunion, recycled, director, enname, lang, score, extratype', 'safe', 'on'=>'search'),
		);
	}

    /*
     * 返回标题颜色下拉框数组值
     */
    public static  function tColors(){
        return array(
            "#FF0000" => '红色',
            "#FF33CC" => '粉红',
            "#00FF00" => '绿色',
            "#0000CC" => '深蓝',
            "#FFFF00" => '黄色',
            "#660099" => '紫色',
        );
    }

    public static function tColorsOptionBg(){
       return array(
            "#FF0000" => array("style"=>"background-color:#FF0000;color: #FF0000"),
            "#FF33CC" => array("style"=>"background-color:#FF33CC;color: #FF33CC"),
            "#00FF00" => array("style"=>"background-color:#00FF00;color: #00FF00"),
            "#0000CC" => array("style"=>"background-color:#0000CC;color: #0000CC"),
            "#FFFF00" => array("style"=>"background-color:#FFFF00;color: #FFFF00"),
            "#660099" => array("style"=>"background-color:#660099;color: #660099"),
        );
    }

    /*
     * 发行年份
     */
    public static function Publishyear(){
        for($i = 1980;$i<2020;$i++){
            $arr[$i]  = $i;
        }
        return $arr;
    }

    /*
     * 语言地区
     */
    public static function Lanuage(){
        return array(
            '粤语'=>'粤语',
            '国语'=>'国语',
            '英语'=>'英语'
        );
    }

    /*
     * 区域
     */
    public static function Publisharea(){
        return array(
            '大陆' => '大陆',
            '台湾' => '台湾',
            '香港' => '香港'
        );
    }

    public static function Setisunion(){
        return array(
            '1'=>'锁定',
            '0'=>'解锁',
        );
    }

    /*
     * 返回带影片名称(带颜色修饰)
     */
    public function Getnamewithcolor(){
        //$state = $this->state==0 ? '' : "&nbsp;&nbsp;"."<a href=\"remote.html\" data-toggle=\"modal\" data-target=\"#modal\">({$this->state}集)</a>";
        $url = CHtml::link("({$this->state}集)",array('getstate','id'=>$this->id),array(
            'data-toggle'=>'modal',
            'data-target'=>'#myModal',
            'id'=>'state_'.$this->id,
        ));
        $state = $this->state==0 ? '' : "&nbsp;&nbsp;".$url;
        $image = empty($this->pic) ? '' : "<img src=".Yii::app()->theme->baseUrl."/images/picture.png style='margin-right:5px;cursor: pointer;' class='title2div' title='<img src=".Yii::app()->request->baseUrl."/upload/".$this->pic." >' >";
        echo $image."<font color = \"{$this->color}\" >".$this->name."</font>".$state;
    }

    /*
     * 获得专题
     */
   public function Gettopic(){
       $topic = $this->vtopic->name;
       $topicstr = "<span>".$topic."</span>";
       $timage = CHtml::link(empty($topic) ? CHtml::image(Yii::app()->theme->baseUrl."/images/icon_l01.gif") : CHtml::image(Yii::app()->theme->baseUrl."/images/icon_l02.gif"),array('gettopic','id'=>$this->id),
            array(
                'data-toggle'=>'modal',
                'data-target'=>'#myModal',
                'style'=>"margin-left:5px;",
            )
       );
       echo $topicstr.$timage;
   }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'playdata' =>array(self::HAS_ONE,'Playdata','v_id'),
            'datacontent'=>array(self::HAS_ONE,'Content','v_id'),
            'vtopic'=>array(self::BELONGS_TO,'Topic','topic'),
            'category'=>array(self::BELONGS_TO,'Category','tid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tid' => '视频分类：',
			'name' => '名称：',
			'state' => '集数：',
			'pic' => '图片地址：',
			'hit' => '点击率：',
			'money' => 'Money',
			'rank' => 'Rank',
			'digg' => 'Digg',
			'tread' => 'Tread',
			'commend' => '星级：',
			'wrong' => 'Wrong',
			'ismake' => 'Ismake',
			'actor' => '主演：',
			'color' => 'Color',
			'publishyear' => '发行年份：',
			'publisharea' => '区域：',
			'addtime' => 'Addtime',
            'updatetime'=>'Updatetime',
			'topic' => '专题：',
			'note' => '备注：',
			'tags' => '关键词：',
			'letter' => '字母：',
			'isunion' => 'Isunion',
			'recycled' => 'Recycled',
			'director' => '导演：',
			'enname' => 'Enname',
			'lang' => '语言：',
			'score' => 'Score',
			'extratype' => '扩展分类：',
		);
	}


    protected  function beforeSave() {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->addtime = $this->updatetime = time();
            }
            else
                $this->updatetime = time();
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
		$criteria->compare('tid',$this->tid,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('hit',$this->hit);
		$criteria->compare('money',$this->money);
		$criteria->compare('rank',$this->rank);
		$criteria->compare('digg',$this->digg);
		$criteria->compare('tread',$this->tread);
		$criteria->compare('commend',$this->commend);
		$criteria->compare('wrong',$this->wrong);
		$criteria->compare('ismake',$this->ismake);
		$criteria->compare('actor',$this->actor,true);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('publishyear',$this->publishyear,true);
		$criteria->compare('publisharea',$this->publisharea,true);
		$criteria->compare('addtime',$this->addtime,true);
		$criteria->compare('updatetime',$this->addtime,true);
		$criteria->compare('topic',$this->topic,true);
		$criteria->compare('note',$this->note,true);
		$criteria->compare('tags',$this->tags,true);
		$criteria->compare('letter',$this->letter,true);
		$criteria->compare('isunion',$this->isunion);
		$criteria->compare('recycled',$this->recycled);
		$criteria->compare('director',$this->director,true);
		$criteria->compare('enname',$this->enname,true);
		$criteria->compare('lang',$this->lang,true);
		$criteria->compare('score',$this->score,true);
		$criteria->compare('extratype',$this->extratype,true);
        $criteria->order = 'updatetime DESC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'pagination'=>array(
                'pageSize'=>20,
            ),
        ));
	}
}
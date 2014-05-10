<?php

class DataController extends Controller
{
	/**
	* @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	* using two-column layout. See 'protected/views/layouts/column2.php'.
	*/
	public $layout='//layouts/sitesource';

	/**
	* @return array action filters
	*/
    public function filters()
    {
        return array(
            array('auth.filters.AuthFilter'),
        );
    }

	public function actions(){
        return array(
            'upload'=>array(
                'class'=>'ext.swfupload.SWFUploadAction',
                'uploaddir'=>F::mkpath(Yii::app()->basePath.'/../upload/'.date('Ym').'/'),
                'filename'=>uniqid().'.EXT', //注意这里是绝对路径,.EXT是文件后缀名替代符号
                'onAfterUpload'=>array($this,'saveFile'),
            ),
            'toggle' => array(
                'class'=>'bootstrap.actions.TbToggleAction',
                'redirectRoute'=>Yii::app()->request->urlReferrer,
                'modelName' => 'Data',
            )
        );
    }

    /** 进行裁剪、打水印等其它处理 */
    public function saveFile($event)
    {
        //$event->sender['uploadedFile'] is CUploadedFile
        //$event->sender['uploadedFile']->name; the original name of the file being uploaded
        // $event->sender['name']  yourfilename.EXT
        // do something   ......
        $url = $event->sender['path'].$event->sender['name'];
        if(is_file($url)){
           $pic = new Picture();
           $pic->cut['file'] = $url;
           $pic->cut['width'] = 300;
           $pic->cut['save_name'] = false;
           $pic->cut['height'] = 300;
           $pic->cut() === true or $pic_info = $pics->info;
        }
       /*
        $im = imagecreatefromjpeg($src);
        $textcolor = imagecolorallocate($im, 0, 0, 255);
        imagestring($im, 2, 0, 0, 'lcswfupload onAfterUpload saveFile run', $textcolor);
        imagejpeg($im,$src);
        imagedestroy($im);
       */
        return true;
    }

    /*
     * 修改星级推荐
     */
    public function actionStarajax(){
        $id = $_GET['vid'];
        $level=$_GET['level'];
        $model = Data::model()->findByPk($id);
        $model->commend = $level;
        if($model->save()){
           echo 'true';
        }
    }

    /*
     * ajax 获得星级推荐
     */
    public function actionGetstate(){
        $id = $_GET['id'];
        $model = Data::model()->findByPk($id);
        echo '状态：连载到'.CHtml::activeTextField($model,'state',array('style'=>'margin:0px 5px;')).CHtml::activeHiddenField($model,'id').CHtml::hiddenField('act','state').'集';
    }

    /*
     * ajax 获得专题
     */
    public function actionGettopic(){
        $id = $_GET['id'];
        $model = Data::model()->with('vtopic')->findByPk($id);
        echo '专题：'.CHtml::activeDropDownList($model,'topic',Topic::FindallToArray(),array('empty'=>"请选择专题",'class'=>'span4')).CHtml::activeHiddenField($model,'id').CHtml::hiddenField('act','topic');
    }

    /*
     * 修改连载集数
     */
    public function actionSavestate(){
        $id = $_GET['id'];
        $state=$_GET['state'];
        $model = Data::model()->findByPk($id);
        $model->state = $state;
        if($model->save()){
            echo 'true';
        }
    }

    /*
     * 保存专题
     */
    public function actionSavetopic(){
        $id = $_GET['id'];
        $topic = $_GET['topic'];
        $model = Data::model()->findByPk($id);
        $model->topic = $topic;
        if($model->save()){
           $model->Gettopic();
        }
    }

    /*
     *  批量保存
     */
     public function actionDatasubmit(){
         $idarr = $_POST['data-grid_c0'];
         $act = $_POST['act'];
         if(empty($idarr) || empty($act)) $this->redirect(Yii::app()->request->urlReferrer);
         foreach($idarr as $id){
             $model = $this->loadModel($id);
             $model->$act = ($act != 'isunion') ? trim($_POST[$act]) : ( $model->$act == 0 ? 1 : 0 );
             if(!$model->save()){
                 throw new CHttpException(404,'数据保存错误,请检查！');
             }
         }
         $this->redirect(Yii::app()->request->urlReferrer);
     }


	/**
	* Displays a particular model.
	* @param integer $id the ID of the model to be displayed
	*/
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	* Creates a new model.
	* If creation is successful, the browser will be redirected to the 'view' page.
	*/
	public function actionCreate()
	{
		$model=new Data;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Data']))
		{
            $playurl = empty($_POST['playurl']) ? '' : F::mergeUrlForm($_POST['playurl'],$_POST['playfrom']);
            if($playurl == false || empty($playurl)){
               F::setflash('error','视频信息没有填写完整!');
            }
            $palydata = F::transferUrl($_POST['playfrom'],$playurl);
            if(!$palydata){
                F::setflash('error','视频信息没有填写完整!');
            }
            $model->attributes=$_POST['Data'];
            $model->extratype = !empty($_POST['Data']['extratype']) ? implode(',',$_POST['Data']['extratype']) : '';
			if($model->save()){
              $palydataModel = new Playdata();
              $palydataModel->v_id = $model->id;
              $palydataModel->tid = $model->tid;
              $palydataModel->body = $palydata;
              $palydataModel->save();
              if(!empty($_POST['content'])){
                  $tvcontent = new Content();
                  $tvcontent->tid = $model->tid;
                  $tvcontent->body = trim($_POST['content']);
                  $tvcontent->vid = $model->id;
                  $tvcontent->save();
               }
               echo "<script type='text/javascript'>alert('添加成功！');location.href = 'admin'</script>";
            }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	* Updates a particular model.
	* If update is successful, the browser will be redirected to the 'view' page.
	* @param integer $id the ID of the model to be updated
	*/
	public function actionUpdate($id)
	{
		//$model=$this->loadModel($id);
        $model=Data::model()->with('playdata','datacontent')->findByPk($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Data']))
		{
            $playurl = empty($_POST['playurl']) ? '' : F::mergeUrlForm($_POST['playurl'],$_POST['playfrom']);
            if($playurl == false || empty($playurl)){
                F::setflash('error','视频信息没有填写完整!');
            }
            $palydata = F::transferUrl($_POST['playfrom'],$playurl);
            if(!$palydata){
                F::setflash('error','视频信息没有填写完整!');
            }
            $oldimage = $model->pic;

            $model->attributes=$_POST['Data'];
            $model->extratype = !empty($_POST['Data']['extratype']) ? implode(',',$_POST['Data']['extratype']) : '';
            if($model->save()){
                //删除图片
                if($oldimage != $model->pic){
                   $file = Yii::app()->basePath.'/../upload/'.$oldimage;
                   if(is_file($file))@unlink($file);
                }
                Playdata::model()->deleteAll("v_id = ".$id);
                $palydataModel = new Playdata();
                $palydataModel->v_id = $model->id;
                $palydataModel->tid = $model->tid;
                $palydataModel->body = $palydata;
                $palydataModel->save();
                if(!empty($_POST['content'])){
                    Content::model()->deleteAll("vid = ".$id);
                    $tvcontent = new Content();
                    $tvcontent->tid = $model->tid;
                    $tvcontent->body = trim($_POST['content']);
                    $tvcontent->vid = $model->id;
                    $tvcontent->save();
                }
                echo "<script type='text/javascript'>alert('修改成功！');location.href = '".$this->createUrl('admin')."';</script>";
            }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	* Deletes a particular model.
	* If deletion is successful, the browser will be redirected to the 'admin' page.
	* @param integer $id the ID of the model to be deleted
	*/
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	* Lists all models.
	*/
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Data');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new Data('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Data'])){
           $model->attributes=$_GET['Data'];
        }
		$this->render('admin',array(
			'model'=>$model,
		));
	}

    /*
     * commend data
     */
    public function actionCommend(){
        $model=new Data('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['Data'])){
            $model->attributes=$_GET['Data'];
        }
        $model->commend = 5;
        $this->render('admin',array(
            'model'=>$model,
        ));
    }


	/**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer the ID of the model to be loaded
	*/
	public function loadModel($id)
	{
		$model=Data::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	* Performs the AJAX validation.
	* @param CModel the model to be validated
	*/
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='data-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

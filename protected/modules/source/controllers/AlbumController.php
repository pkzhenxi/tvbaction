<?php

class AlbumController extends Controller
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
              'menulinkageinit'=>array(
                  'class'=>'ext.menulinkage.actions.InitdroplistmenuAction',
              ),
              'menulinkage'=>array(
                  'class'=>'ext.menulinkage.actions.MenulinkageAction',
              ),
              'upload'=>array(
                'class'=>'ext.swfupload.SWFUploadAction',
                'uploaddir'=>F::mkpath(Yii::app()->basePath.'/../upload/'.date('Ym').'/'),
                'filename'=>uniqid().'.EXT', //注意这里是绝对路径,.EXT是文件后缀名替代符号
                'onAfterUpload'=>array($this,'saveFile'),
              ),
              'toggle' => array(
                    'class'=>'bootstrap.actions.TbToggleAction',
                    'redirectRoute'=>Yii::app()->request->urlReferrer,
                    'modelName' => 'Album',
              ),
        );
    }

    /*
    * 修改星级推荐
    */
    public function actionStarajax(){
        $id = $_GET['vid'];
        $level=$_GET['level'];
        $model = Album::model()->findByPk($id);
        $model->recommend = $level;
        if($model->save()){
            echo 'true';
        }
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
		$model=new Album;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Album']))
		{
			$model->attributes=$_POST['Album'];
			if($model->save())
				$this->redirect(array('admin'));
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Album']))
		{
			$model->attributes=$_POST['Album'];
			if($model->save())
                $this->redirect(array('admin'));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

    public function actionAlbumsubmit(){
        $IdArray = $_POST['album-grid_c0'];
        if(empty($IdArray)){
           $_GET['Album'] = isset($_POST['Album']) ? $_POST['Album'] : $_GET['Album'];
           $this->actionAdmin();
        }
        else{
           foreach($IdArray as $id){
              $this->loadModel($id)->delete();
           }
           $this->redirect(Yii::app()->request->urlReferrer);
        }

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
		$dataProvider=new CActiveDataProvider('Album');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new Album('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Album']))
			$model->attributes=$_GET['Album'];

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
		$model=Album::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='album-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

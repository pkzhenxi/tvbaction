<?php

class DataCategoryController extends Controller
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
		//echo Yii::app()->request->baseUrl;
        $model=new Category;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Category']))
		{
            $model->attributes = $_POST['Category'];
            $parentNode = $_POST['Category']['root'];
            if($parentNode != 0){
                $parentModel = Category::model()->findByPk($parentNode);
                if($model->appendTo($parentModel)){
                    $this->redirect(array('admin'));
                }
            }

            if ($model->saveNode())
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

		if(isset($_POST['Category']))
		{
			$model->attributes=$_POST['Category'];
			if($model->saveNode())
				$this->redirect($this->createUrl('admin'));
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
			$this->loadModel($id)->deleteNode();

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
		$dataProvider=new CActiveDataProvider('Category');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	* Manages all models.
	*/
	public function actionAdmin()
	{
		$model=new Category('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Category']))
			$model->attributes=$_GET['Category'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

    /**
     * 批量处理表单
     */
    public function actionCategorySubmit(){
       $idArr = $_POST["id"];
       $operate = $_POST['operation'];
       if($operate == 'edit'){
           if(!empty($idArr)){
               foreach($idArr as $id){
                   $category = $this->loadModel($id);
                   $category->name = $_POST["name_".$id];
                   $category->title = $_POST["title_".$id];
                   $category->keyword = $_POST["keyword_".$id];
                   $category->description = $_POST["description_".$id];
                   if(!$category->saveNode()){
                       throw new CHttpException('数据无法更新！！');
                   }
               }
           }
       }elseif($operate == 'delete'){
           if(!empty($idArr)){
              $idArr = array_reverse($idArr);//数组翻转,就可以先删除子分类再删除父分类，不会发生错误
              foreach($idArr as $id){
                  $model = $this->loadModel($id);
                  if($model != null){
                     $model->deleteNode();
                  }
              }
           }
       }
       $this->redirect($this->createUrl('admin'));
    }

    /*
     * 分类移动
     */
    public function actionMove(){
       $model = $this->loadModel($_GET['id']);
       if($_GET['action'] == 'up'){
          $prevModel = $model->prev()->find();
          if($prevModel != null){
              $model->moveBefore($prevModel);
          }
       }else{
           $nextModel = $model->next()->find();
           if($nextModel != null){
               $model->moveAfter($nextModel);
           }
       }
       $this->redirect($this->createUrl('admin'));
    }

    /**
	* Returns the data model based on the primary key given in the GET variable.
	* If the data model is not found, an HTTP exception will be raised.
	* @param integer the ID of the model to be loaded
	*/
	public function loadModel($id)
	{
		$model=Category::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='category-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

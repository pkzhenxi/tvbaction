<?php

class SiteController extends Controller
{
	public function actionIndex()
	{
        //sietconfig
        $this->render('index');
	}

    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
                'maxLength'=>'4',       // 最多生成几个字符
                'minLength'=>'4',       // 最少生成几个字符
                'height'=>'40'
            ),
        );
    }

    public function accessRules(){
        return array(
            array('allow',
                'actions'=>array('index','login','captcha'),
                'users'=>array('*'),
            ),
        );

    }

    public  function actionLogin()
    {
        $model  = new LoginForm();
        $arr = F::getSiteConfigArray('siteconfigform');
        $model->scenario = ($arr['isAdminCapthca']) ? 'login' : '';
        $model->setuserType();
        // if it is ajax validation request
        if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if(isset($_POST['LoginForm']))
        {
            $model->attributes=$_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid

            if($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login',array('model'=>$model,'iscaptha'=>$arr['isAdminCapthca']));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['messages'];
            else
                $this->render('error', $error);
        }
    }

    /**
    02
     * 提示信息
    03
     */
    public function actionShowMessage(){
            $data = Yii::app()->user->getFlash('showmessage');//flash中读取提示信息
            if(empty($data) || !is_array($data) || !isset($data['msg']) || $data['msg']==""){
                Yii::app()->end();
            }
            if(!isset($data['wait'])){
               $data['wait'] = 3;
            }
            if(!isset($data['type'])){
               $data['type'] = 1;
            }
            $data['title'] = ($data['type']==1) ? "提示信息" : "错误信息";
            if(!isset($data['jumpurl']) || empty($data['jumpurl'])){
                if($data['type']==1){
                    $data['jumpurl']=isset($_SERVER['HTTP_REFERER'])?$_SERVER['HTTP_REFERER']:"javascript:window.close();";
                }else{
                    $data['jumpurl'] = "javascript:history.back(-1);";
                }
            }
            $this->renderPartial("show_message",$data);
    }


    // Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/

    public function actionLogout(){
        //echo Yii::app()->request->baseUrl.'<br>';  //  /tvbaction
        //echo Yii::app()->homeUrl; // /tvbaction/backend.php
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }
}
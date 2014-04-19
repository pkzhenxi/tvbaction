<?php

class SiteconfigModule extends CWebModule
{
    public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'siteconfig.models.*',
			'siteconfig.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}

    //提交表单
    public function configSumbit($data=array()){
        if(isset($data)){
            $key = array_keys($data);
            $action = $key[0];
            //添加
            if($this->setToFile($data)){
                $this->setflash('success');
            }else{
                $this->setflash('error');
            }
            //跳转
            switch($action){
                case 'SiteConfigForm':
                    Yii::app()->controller->redirect(array('index'));
                    break;
                case 'SiteRegisterForm':
                    Yii::app()->controller->redirect(array('siteregister'));
                    break;
                case 'SiteMailForm':
                    Yii::app()->controller->redirect(array('sitemail'));
                    break;
            }
        }
    }

    //添加入文件
    private function setToFile($data){
        $key = array_keys($data);
        $filePath = $this->getSiteConfigPath($key[0]);
        if(file_exists($filePath)){
           //将数组写入文件
           return $this->array2php($data[$key[0]],$filePath);
        }else{
           //创建文件
           @touch($filePath);
           @chmod($filePath,0777);
           return $this->array2php($data[$key[0]],$filePath);
        }
    }

    /*
     * 获得放置配置文件路径
     */
    private function getSiteConfigPath($filename){
        return $this->basePath.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'cache_'.strtolower($filename).'.php';
    }
    /*
     * 将数组写入文件
     */
    private function array2php($arr,$filepath){
        $arr = F::unslashes($arr);
        $phpcode = "<?php\r\n"."return ".var_export($arr,true).";\r\n?>";
        return @file_put_contents($filepath,$phpcode);
    }

    /*
     * 获得配置文件数据
     */
    public function getFromFile($filename){
        $filePath = $this->getSiteConfigPath($filename);
        if(file_exists($filePath)){
           return include($filePath);
        }else{
           return array();
        }
    }

    /*
     * 设置更新信息
     */
    private function setflash($type){
        switch($type){
            case 'success':
                Yii::app()->user->setFlash($type, '<strong>更新成功!</strong> 你已经成功写入文件！');
                break;
            case 'error':
                Yii::app()->user->setFlash($type, '<strong>更新失败!</strong> 可能内容写入文件错误,请检查！');
                break;
        }
    }

}

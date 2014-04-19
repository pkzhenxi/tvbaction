<?php

class SourceModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'source.models.*',
			'source.components.*',
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
    /**
     * @param $str
     * @param $params
     * @param $dic
     * @return string
     */
    public static function t($str = '', $params = array(), $dic = 'main') {
        if (Yii::t("SourceModule", $str) == $str)
            return Yii::t("SourceModule." . $dic, $str, $params);
        else
            return Yii::t("SourceModule", $str, $params);
    }
}

<?php
/*
 * 公共静态方法
 */
class F {

    public static function unslashes(&$var){
        if(is_array($var)){
            foreach($var as $i => $n){
                $var[$i] = F::unslashes($n);
            }
        } else {
            $var = stripcslashes($var);
        }
        return $var;
    }

    public static function getSiteConfigArray($filename){
        return Yii::app()->getModule('siteconfig')->getFromFile($filename);
    }

    public static function timetostr($time = ''){
       if($time != null && !empty($time)){
        return date("Y-m-d", $time);
       }
    }

    public static function transferUrl($fromArray,$playStr){
        $playStr=str_replace(chr(13),"#",str_replace(chr(10),"",str_replace("$$","",str_replace("#","",$playStr))));
        $playStr=rtrim(rtrim($playStr, ","),"#");
        $playArray=explode(", ",$playStr);
        $fromLen=count($fromArray);
        $playLen=count($playArray);
        $resultStr="";
        $j=0;
        foreach($fromArray as $i => $from)
        {
            if(empty($from) and !empty($playArray[$j])){
                return false;
            }elseif($playArray[$j]=='')
            {
                $resultStr.='';
            }
            else{
                $resultStr=$resultStr.trim($from)."$$".trim(rtrim($playArray[$j],"#"))."$$$";
            }
            $j++;
        }
        $transferUrl=rtrim($resultStr,"$$$");
        return  $transferUrl;
    }

    /*
     * 合并视频地址数据
     */
    public static function mergeUrlForm($playurl,$playfrom){
        if (count($playurl)!=count($playfrom))
        {
            return false;
        }
        foreach($playurl as $k=>$v)
        {
            $v = trim($v);
            if($v!='')
            {
                $rstr=$rstr.self::repairStr($v,self::getReferedId($playfrom[$k])).', ';
            }else{
                $rstr=$rstr.', ';
            }
        }
        return rtrim($rstr, ", ");
    }

    private static function repairStr($vstr,$playfrom){
        $vstr = str_replace(chr(10),"",$vstr);
        $vstr = explode(chr(13),$vstr);
        $stru="";
        foreach($vstr as $j=>$playurl)
        {
            $strurl = explode('$',$playurl);
            $i=count($strurl);
            if ($i==1){
                $jj=$j+1;
                $stru=$stru.'第'.$jj.'集$'.$playurl.'$'.$playfrom.chr(13).chr(10);
            }elseif ($i==2){
                $stru=$stru.$playurl.'$'.$playfrom.chr(13).chr(10);
            }else{
                $stru=$stru.$playurl.chr(13).chr(10);
            }
        }
        return $stru;
    }

    private static function chgreg($reg){
        $nreg=str_replace("/","\\/",$reg);
        return "/".$nreg."/";
    }

    private static function m_ereg($reg,$p){
        return preg_match(self::chgreg($reg),$p);
    }

    private static function getReferedId($str){
        if (self::m_ereg("qvod",$str)) return "qvod";
        if (self::m_ereg("百度影音",$str)) return "bdhd";
        if (self::m_ereg("土豆高清",$str)) return "hd_tudou";
        if (self::m_ereg("新浪高清",$str)) return "hd_iask";
        if (self::m_ereg("搜狐高清",$str)) return "hd_sohu";
        if (self::m_ereg("天线高清",$str)) return "hd_openv";
        if (self::m_ereg("56高清",$str)) return "hd_56";
        if (self::m_ereg("56",$str)) return "56";
        if (self::m_ereg("优酷",$str)) return "youku";
        if (self::m_ereg("土豆",$str)) return "tudou";
        if (self::m_ereg("搜狐",$str)) return "sohu";
        if (self::m_ereg("新浪",$str)) return "iask";
        if (self::m_ereg("六间房",$str)) return "6rooms";
        if (self::m_ereg("qq",$str)) return "qq";
        if (self::m_ereg("youtube",$str)) return "youtube";
        if (self::m_ereg("17173",$str)) return "17173";
        if (self::m_ereg("ku6视频",$str)) return "ku6";
        if (self::m_ereg("FLV",$str)) return "flv";
        if (self::m_ereg("SWF数据",$str)) return "swf";
        if (self::m_ereg("real",$str)) return "real";
        if (self::m_ereg("media",$str)) return "media";
        if (self::m_ereg("ppstream",$str)) return "pps";
        if (self::m_ereg("迅播高清",$str)) return "gvod";
        if (self::m_ereg("远古高清",$str)) return "wp2008";
        if (self::m_ereg("ppvod高清",$str)) return "ppvod";
        if (self::m_ereg("PVOD",$str)) return "pvod";
        if (self::m_ereg("播客CC",$str)) return "cc";
        if (self::m_ereg("皮皮影音",$str)) return "pipi";
        if (self::m_ereg("久久影音",$str)) return "webplayer9";
        if (self::m_ereg("激动",$str)) return "jidong";
        if (self::m_ereg("闪播Pvod",$str)) return "flashPvod";
    }

    public static function setflash($type,$message){
        Yii::app()->user->setFlash($type,$message);
        echo "<script type='text/javascript'>history.back(-1);</script>";
        exit;
    }

    public static function mkpath($dir,$mode = 0777){
        if(!is_dir($dir)) {
            self::mkpath(dirname($dir));
            if(@mkdir($dir,$mode)){
                @touch($dir.'/index.html');
                @chmod($dir.'/index.html',0777);
            } else {
                return false;
            }
        }
        return $dir;
    }

    public static function makePlayerSelect($flag)
    {
        $playerArray=array();
        $m_file = Yii::app()->basePath."/../data/playerKinds.xml";
        $allstr = '';
        $xml = simplexml_load_file($m_file);
        $i = 0;
        $a = 0;
        foreach($xml as $player){
            $i++;
            if($flag==$player['flag']){
                $selectstr=" selected";
            }else{
                $selectstr="";
            }
            if($player['open']==1)
                $allstr .="<option value='".$player['flag']."' $selectstr>".$player['flag']."</option>";

        }
        return $allstr;
    }

}
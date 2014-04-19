<?php
class Picture{
    public $info = true;
    public $cut = array(
        'file' => NULL,
        'min_width' => 120,
        'min_height' => 100,
        'save_dir' => 'auto',
        'save_name' => false,
        'format' => 'auto',
        'quality' => 100,
        'width' => 124,
        'height' => 124
    );
    public $watermark = array(
        'file' => NULL,
        'min_width' => 300,
        'min_height' => 100,
        'rename' => 'auto',
        'type' => 'pics',
        'pics' => './images/watermark.png',
        'alignment' => 3,
        'x' => 0,
        'y' => 0,
        'font_file' => 'inc/fonts/ariali.ttf',
        'color' => "#0000ff",
        'text' => 'www.mlecms.com',
        'font_size' => 22,
        'angle' => 0,
    );
    private $Language = array(
        0 => '当前环境不支持 GD 图像库，无法对图片进行处理。',
        1 => '非法的图片文件，裁切及水印支持的文件类型：jpg,gif,png',
        2 => '图片保存目录不存在：',
        3 => '图片小于规定值，没有对图片进行裁切。',
        4 => '图片小于规定值，没有添加图片水印。',
        5 => '无法读取水印字体文件：',
        6 => '无法读取水印图片文件：',
        7 => '添加文字水印时出现错误，可能原因：非法的字体库或字体库不支持当前填写的文字内容，请尝试选择（或安装）其它的字体文件。',
        8 => '无法保存处理后的图片文件，请确认您是否有相应文件的写入权限：',
    );
    private $Size = array();
    private $chmod_files = 0777;
    public function __construct(){
        if(!function_exists("gd_info") || !extension_loaded('gd')){
            $this->info = $this->Language[0];
            return false;
        }
    }
    //剪裁,生成小图
    public function cut(){
        $this->picssize($this->cut['file']);
        if($this->info !== true) return false;
        //图片小于规定的值,无法进行裁剪
        if($this->Size[0]<$this->cut['min_width'] || $this->Size[1]<$this->cut['min_height']){
            $this->info = $this->Language[3];
            return false;
        }
        //文件格式,即后缀
        if($this->cut['format'] == 'auto') $this->cut['format'] = $this->Size[4];
        //存放目录
        if($this->cut['save_dir'] == 'auto') $this->cut['save_dir'] = dirname($this->cut['file']) . '/';
        //判断保存的目录存在不
        if(!is_dir($this->cut['save_dir'])){
            $this->info = $this->Language[2] . $this->cut['save_dir'];
            return false;
        }
        //保存的名称
        $this->cut['save_name'] = $this->autoname();

        //导入图片
        $sp = $this->picscreate($this->cut['file']);
        //算法计算宽高坐标等
        $w_again = $this->cut['width']/$this->Size[0];
        $h_again = $this->cut['height']/$this->Size[1];
        $again = $w_again<$h_again ? $w_again : $h_again;
        $src_w = $this->Size[0] * $again;
        $src_h = $this->Size[1] * $again;
        $src_x = ($this->Size[0]-$src_w)/2;
        $src_y = ($this->Size[1]-$src_h)/2;
        //生成新的图片,不重命名则会覆盖，这里的裁剪似乎不对?
        //imagecopyresampled($NewPics,$sp,0,0,$src_x,$src_y,$this->cut['width'],$this->cut['height'],$src_w,$src_h);
        //新建一个新图
        $NewPics = @imagecreatetruecolor($src_w,$src_h);
        imagecopyresampled($NewPics,$sp,0,0,0,0,$src_w,$src_h,$this->Size[0],$this->Size[1]);
        switch($this->cut['format']){
            case 'jpg' : $result = @imagejpeg($NewPics,$this->cut['save_dir'].$this->cut['save_name'],$this->cut['quality']); break;
            case 'png' : $result = @imagepng($NewPics,$this->cut['save_dir'].$this->cut['save_name']); break;
            case 'gif' : $result = @imagegif($NewPics,$this->cut['save_dir'].$this->cut['save_name']); break;
        }
        //改变权限以及销毁资源
        if($result){
            @chmod ($this->cut['save_dir'].$this->cut['save_name'],$this->chmod_files);
            @imagedestroy($NewPics); @imagedestroy($sp);
            unset($NewPics,$w_again,$h_again,$again,$sp,$src_w,$src_h,$src_x,$src_y);
            return true;
        } else {
            $this->info = $this->Language[8].$newPics;
            return false;
        }
    }

    public function watermark(){
        //获得源图像的信息，后缀,名称等
        $this->picssize($this->watermark['file']);
        if($this->info !== true) return false;
        if($this->Size[0]<$this->watermark['min_width'] || $this->Size[1]<$this->watermark['min_height']){
            $this->info = $this->Language[4];
            return false;
        }

        //导入源图像资源
        $nzpics = $this->picscreate($this->watermark['file']);
        //处理水印类型,是文字水印还是图像水印
        if($this->watermark['type'] == 'pics'){
            $wapics = $this->watermark['pics'];
            if(!is_file($wapics)){
                $this->info = $this->Language[6] . $wapics;
                return false;
            }
            //获得水印图片的相关信息
            $src = getimagesize($wapics);
            $wapics = $this->picscreate($wapics);
        }else{
            $src[0] = 300;
            $src[1] = 30;
            if(!is_file($this->watermark['font_file'])){
                $this->info = $this->Language[5] . $this->watermark['font_file'];
                return false;
            }
        }

        //处理水印位置
        switch($this->watermark['alignment']){
            case 1 : $src_x = 0;	$src_y = 0;	break;
            case 2 : $src_x = ($this->Size[0]/2)-($src[0]/2); $src_y = 0; break;
            case 3 : $src_x = $this->Size[0]-$src[0]; $src_y = 0; break;
            case 4 : $src_x = 0; $src_y = ($this->Size[1]/2)-($src[1]/2); break;
            case 5 : $src_x = ($this->Size[0]/2)-($src[0]/2); $src_y = ($this->Size[1]/2)-($src[1]/2); break;
            case 6 : $src_x = $this->Size[0]-$src[0]; $src_y = ($this->Size[1]/2)-($src[1]/2); break;
            case 7 : $src_x = 0; $src_y = $this->Size[1]-$src[1]; break;
            case 8 : $src_x = ($this->Size[0]/2)-($src[0]/2); $src_y = ($this->Size[1])-($src[1]); break;
            case 9 : $src_x = ($this->Size[0])-($src[0]); $src_y = ($this->Size[1])-($src[1]); break;
        }
        $src_x += $this->watermark['x'];
        $src_y += $this->watermark['y'];

        //添加上水印
        if($this->watermark['type'] == 'pics'){
            imagecopyresampled($nzpics,$wapics,$src_x,$src_y,0,0,$src[0],$src[1],$src[0],$src[1]);
        } else { //文字水印
            $src_x += 0;
            $src_y += 20;
            $rgb = $this->hex2rgb($this->watermark['color']);
            $color = imagecolorallocate($nzpics,$rgb[0],$rgb[1],$rgb[2]);
            $result = @imagettftext($nzpics,$this->watermark['font_size'],$this->watermark['angle'],$src_x,$src_y,$color,$this->watermark['font_file'],$this->watermark['text']);
            if(!is_numeric($result[0])){
                $this->info = $this->Language[7];
                return false;
            }
            unset($color,$rgb);
        }

        //新建新图片,不重命名则会覆盖
        $newPics = $this->watermark['rename'] == 'auto' ? $this->watermark['file'] : $this->watermark['rename'];
        switch($this->Size[4]){
            case 'jpg' : $result = @imagejpeg($nzpics,$newPics,100); break;
            case 'png' : $result = @imagepng($nzpics,$newPics); break;
            case 'gif' : $result = @imagegif($nzpics,$newPics); break;
        }
        if($result){
            @chmod ($newPics,$this->chmod_files);
            @imagedestroy($nzpics); @imagedestroy($wapics);
            unset($wapics,$nzpics,$src,$src_x,$src_y,$newPics);
            return true;
        } else {
            $this->info = $this->Language[8].$newPics;
            return false;
        }
    }

    //导入图片
    private function picscreate($xfile){
        switch($this->suffix($xfile)){
            case 'png' : $result = imagecreatefrompng($xfile); break;
            case 'jpg' : $result = imagecreatefromjpeg($xfile); break;
            case 'gif' : $result = imagecreatefromgif($xfile); break;
        }
        return $result;
    }
    //是否保存新名称
    private function autoname(){
        $sn = $this->cut['save_name'];
        if(false === $sn){
            $result = $this->Size[3];
            $result = basename($result,$this->Size[4]);
            $result .= $this->cut['format'];
            return $result;
        } elseif (true === $sn) {
            @$result = date("YmdHis") . mt_rand(1000,9999) . '.' . $this->cut['format'];
            return $result;
        } else {
            return $sn;
        }
    }
    //getimagesize获得图片的相关信息数组,然后改组下这个数组,加上文件名和文件名的后缀
    private function picssize($xfile){
        @$this->Size = getimagesize($xfile);
        //图片格式不对
        if($this->Size[2] < 1 || $this->Size[2] > 3){
            $this->info = $this->Language[1];
            return false;
        }
        $this->Size[3] = basename($xfile);
        $this->Size[4] = $this->suffix($this->Size[3]);
        unset($suffix);
        return true;
    }

    //文件后缀名
    private function suffix($xfile){
        $result = pathinfo($xfile);
        $result = strtolower($result['extension']);
        $result = strtolower($result);
        return $result;
    }
    //转化成rgb颜色
    private function hex2rgb($hex){
        if (strtolower(substr($hex,0,1)) == '#'){
            $offset = 1;
        } else {
            $offset = 0;
        }
        $rgb[0] = hexdec(substr($hex,$offset,2));
        $offset += 2;
        $rgb[1] = hexdec(substr($hex,$offset,2));
        $offset += 2;
        $rgb[2] = hexdec(substr($hex,$offset,2));
        return $rgb;
    }
}
?>
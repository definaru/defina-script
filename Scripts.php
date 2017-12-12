<?php

namespace budyaga_cust\users\models;

use Yii;
use yii\helpers\Html;
use budyaga_cust\users\voicecms\Voice;
use budyaga_cust\users\voicecms\Namevoiceru;
use budyaga_cust\users\models\Defina;

class Scripts {
    

    
    const company = '<i class="ionicons ion-coffee"></i> Моя компания';
    const mysql = 'http://127.0.0.1/openserver/phpmyadmin/db_structure.php?server=1&db=marina&token=61cb53029211668175bff66343d91c04';
    const filemanager = '/filemanager/default';
    const help = '/user/help';
    const limit = 7;
    
    
    
    public function sklonen($n,$s1,$s2,$s3, $b = false)
    {
        // Scripts::sklonen( 'число', 'новость', 'новости', 'новостей') 1, 2, 7
        $m = $n % 10; $j = $n % 100;
        if($b) {$n = '<b>'.$n.'</b>';}
        if($m==0 || $m>=5 || ($j>=10 && $j<=20)) {return $n.' '.$s3;}
        if($m>=2 && $m<=4) {return  $n.' '.$s2;}
        return $n.' '.$s1;
    }
    
    public function getCountText($param = '') 
    {
        // Scripts::getCountText()
        return Html::tag('p', substr($param, 3, Defina::countText), ['class' => 'lg-center md-center sm-justify xs-justify']);
    }
    
    public static function creatUnix($unix = '')
    {
        return Yii::$app->formatter->asDate($unix, 'php:Y-m-d');
    }
    
    public static function getCountDay($firstdate = '', $twodate = '')
    {
        $datetime1 = date_create($firstdate);
        $datetime2 = date_create($twodate);
        $interval = date_diff($datetime1, $datetime2);
        return $interval->format('%a');
    }


    public static function getHelpIcon($params = '')
    {
        return ($params == '') ? '' : '<span class="prof pull-right" title="'.$params.'" data-toggle="tooltip" data-placement="bottom"><i class="ionicons ion-help-circled"></i></span>';
    }	
    
    public static function genderPhoto($alt = '', $param = '', $style = '')
    {
        // Scripts::genderPhoto()
        $nc = new Namevoiceru(); 
        $person = Yii::$app->user->identity->nickname;
        $gender = $nc->genderDetect($person);
        ($gender == Voice::$MAN)? $p = 'male' : $p = 'female';
        return Html::img('/img/'.$p.'.png',['alt' => $alt, 'class' => $param, 'style' => $style]);
    }
    
    
    public static function getDefaultPhoto($person = '')
    {
        $nc = new Namevoiceru(); 
        $gender = $nc->genderDetect($person);
        return ($gender == Voice::$MAN) ? 'male' : 'female';
    }
    
    
    public static function alertEmailDefault()
    {
        // Scripts::alertEmailDefault()
        $x = Yii::$app->user->identity;
        $mail = $x->email;
        $default = 'test@test.com';
        return ($mail == $default) ? '<li><a href="/user/admin/update?id='.$x->id.'?error=mail"><i class="fa fa-cog text-info"></i> Настройте ваш сайт</a></li>' : '';
        
    }
    
    public function ErrorMail()
    {
        return (Yii::$app->user->identity->email == 'test@test.com') ? '<span class="text-danger">Cмените ваш E-mail</span>' : 'E-mail';
    }
    
    public function getErrorMail()
    {
        if(Yii::$app->user->identity->email == 'test@test.com') {return false;} else {return true;}
    }
    
    public function getErrorMailMessage()
    {
        $border = (Scripts::getErrorMail() == false) ? 'form-control ahtung' : 'form-control'; return $border;
    }
    
    public function noPhotoUser()
    {
        $x = Yii::$app->user->identity;
        return ($x->photo == '') ? '<li><a href="/user/admin/update?id='.$x->id.'"><i class="fa fa-id-card-o text-info"></i> Отсутствует фото профиля</a></li>' : '';
    }
    
    public function countNotify()
    {
        // Scripts::countNotify()
        $a = (Scripts::alertEmailDefault() == '') ? 0 : 1;
        $b = (Scripts::noPhotoUser() == '') ? 0 : 1;
        return $summa = $a+$b;
    }
    

    

    public function typeFile($file)
    {
        // Scripts::typeFile()
        $file = strtr($file, array(
            'txt' => '<i class="fa fa-file-text-o bg-gray color-palette"></i>', 
            'md' => '<i class="fa fa-file-text-o bg-gray color-palette"></i>', 
            
            'htaccess' => '<i class="ionicons ion-document bg-gray color-palette"></i>', 
            'gitignore' => '<i class="ionicons ion-document bg-gray color-palette"></i>', 
            
            'rar' => '<i class="fa fa-file-archive-o bg-orange color-palette"></i>', 
            'zip' => '<i class="fa fa-file-archive-o bg-orange color-palette"></i>', 
            'gz' => '<i class="fa fa-file-archive-o bg-orange color-palette"></i>', 
            
            'docx' => '<i class="fa fa-file-word-o bg-aqua color-palette"></i>', 
            'doc' => '<i class="fa fa-file-word-o bg-aqua color-palette"></i>', 
            'dotx' => '<i class="fa fa-file-word-o bg-aqua color-palette"></i>', 
            'dot' => '<i class="fa fa-file-word-o bg-aqua color-palette"></i>', 
            'rtf' => '<i class="fa fa-file-word-o bg-aqua color-palette"></i>', 
            'docm' => '<i class="fa fa-file-word-o bg-aqua color-palette"></i>', 
            'dotm' => '<i class="fa fa-file-word-o bg-aqua color-palette"></i>', 
            'dic' => '<i class="fa fa-file-word-o bg-aqua color-palette"></i>', 
            
            'pptx' => '<i class="fa fa-file-powerpoint-o"></i>', 
            'pptm' => '<i class="fa fa-file-powerpoint-o"></i>', 
            'ppt' => '<i class="fa fa-file-powerpoint-o"></i>', 
            
            'xlsx' => '<i class="fa fa-file-excel-o bg-green color-palette"></i>', 
            'xlsm' => '<i class="fa fa-file-excel-o bg-green color-palette"></i>', 
            'xlsb' => '<i class="fa fa-file-excel-o bg-green color-palette"></i>', 
            'xltx' => '<i class="fa fa-file-excel-o bg-green color-palette"></i>', 
            'xltm' => '<i class="fa fa-file-excel-o bg-green color-palette"></i>', 
            'xls' => '<i class="fa fa-file-excel-o bg-green color-palette"></i>', 
            'xlt' => '<i class="fa fa-file-excel-o bg-green color-palette"></i>', 
            'csv' => '<i class="fa fa-file-excel-o bg-green color-palette"></i>', 
            
            'png' => '<i class="fa fa-file-image-o bg-maroon color-palette"></i>', 
            'jpg' => '<i class="fa fa-file-image-o bg-maroon color-palette"></i>', 
            'jpeg' => '<i class="fa fa-file-image-o bg-maroon color-palette"></i>', 
            'gif' => '<i class="fa fa-file-image-o bg-maroon color-palette"></i>', 
            'tiff' => '<i class="fa fa-file-image-o bg-maroon color-palette"></i>',
            
            'pdf' => '<i class="fa fa-file-pdf-o bg-red color-palette"></i>', 
            
            'html' => '<i class="fa fa-file-code-o bg-purple color-palette"></i>', 
            'css' => '<i class="fa fa-file-code-o bg-purple color-palette"></i>', 
            'rss' => '<i class="fa fa-file-code-o bg-purple color-palette"></i>', 
            'xml' => '<i class="fa fa-file-code-o bg-purple color-palette"></i>', 
            'js' => '<i class="fa fa-file-code-o bg-purple color-palette"></i>', 
            'py' => '<i class="fa fa-file-code-o bg-purple color-palette"></i>', 
            'php' => '<i class="fa fa-file-code-o bg-purple color-palette"></i>', 
            'exe' => '<i class="fa fa-file-code-o bg-purple color-palette"></i>'));
        return $file;
    }
	
	
    public function get_filesize($file = '') {
    // Scripts::get_filesize();
    if(!file_exists($file)) return "Файл  не найден";
    $filesize = filesize($file);
        if($filesize > 1024) {
            $filesize = ($filesize/1024);
            if($filesize > 1024) {
                $filesize = ($filesize/1024);
                if($filesize > 1024) {
                    $filesize = ($filesize/1024); $filesize = round($filesize, 1); return $filesize." ГБ";       
                } else {
                    $filesize = round($filesize, 1); return $filesize." MБ";
                }       
            } else {
                $filesize = round($filesize, 1); return $filesize." Кб";   
            }  
        } else {
            $filesize = round($filesize, 1); return $filesize." байт";   
        }
    }
 	
    
    
    public static function moontag($value)
    {
        // Scripts::moontag();
        $value = strtr($value, array(
            "January" => "Января", 
            "February" => "Февраля", 
            "March" => "Марта", 
            "April" => "Апреля", 
            "May" => "Мая", 
            "June" => "Июня", 
            "July" => "Июля", 
            "August" => "Августа", 
            "September" => "Сентября", 
            "October" => "Октября", 
            "November" => "Ноября", 
            "December" => "Декабря"));
        return $value;
    } 
    
    public function getTime()
    {
        return time();
    }
    
    public function site() {
        return Yii::$app->getRequest()->getHostInfo();
    }
    
    public function funcMail() {
        return Yii::$app->params[Defina::current_mail];
    }
    
    public function formTime($param = '') 
    {
        return self::moontag(Yii::$app->formatter->asDateTime($param, 'php: опубликовано '.Defina::DateFormat));
    }

    public function getStat($value)
    {
        $value = strtr($value, array(
            '0' => 'в ожидании', 
            '1' => 'опубликовано', 
            '2' => 'заблокировано'));
        return $value;
    } 

    public function getStatColor($value)
    {
        $value = strtr($value, array(
            '0' => 'label label-warning pull-right', 
            '1' => 'label label-success pull-right', 
            '2' => 'label label-danger pull-right'));
        return $value;
    }  
    
    
    public function formTimeChat($param = '') 
    {
        return self::moontag(Yii::$app->formatter->asDateTime($param, 'php: '.Defina::DateFormatChat));
    }

    public function getTimeName($params = '') 
    { 
        // Scripts::getTimeName(1508260892);
        return Html::tag('small', Defina::CLOCK . Scripts::formTime($params), ['class' => 'text-muted']);
    }  
    
    public function getTimeChat($params = '') 
    { 
        // Scripts::getTimeName(1508260892);
        return Html::tag('small', Defina::CLOCK . self::formTimeChat($params), ['class' => 'text-muted']);
    }    
	
    public static function phone($phone, $options = [])
    {
        // Scripts::phone()
        $options['href'] = 'tel:'.$phone;
        if (!isset($options['class'])) {
            $options['class'] = '';
        }
        return Html::tag('a', $phone, $options);
    }
    

}

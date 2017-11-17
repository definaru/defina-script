<?php

/* 
* преобразователи параметров
* Разработка CMS Defina
*/

namespace budyaga_cust\users\models;

use Yii;

class Script
{
	
	 
	/* 
	* GridView::widget();
	* Script::sklonen( '{totalCount}', 'новость', 'новости', 'новостей') 1,2,7
	*
	* или
	* Script::sklonen( $modal->count, 'новость', 'новости', 'новостей') 1,2,7
	*/
    public function sklonen($n,$s1,$s2,$s3, $b = false)
	{
		//Script::sklonen();
        $m = $n % 10; $j = $n % 100;
        if($b) $n = '<b>'.$n.'</b>';
        if($m==0 || $m>=5 || ($j>=10 && $j<=20)) return $n.' '.$s3;
        if($m>=2 && $m<=4) return  $n.' '.$s2;
		
        return $n.' '.$s1;
    }
	
	
	public function getIp()
	{
		return Yii::$app->request->userIP;
	}
	
	// Script::phone('+7 (999) 00-00-000', ['class' => 'phone'])
	// <a class="phone" href="tel:+7 (999) 00-00-000">+7 (999) 00-00-000</a>
    public static function phone($phone, $options = [])
    {
        $options['href'] = 'tel:'.$phone;
        if (!isset($options['class'])) {
            $options['class'] = '';
        }
        return static::tag('a', $phone, $options);
    }
	
	
    public function level ($act){
        $act = strtr(
		   $act, array(
				"0" => "Пользователь",
				"1" => "Администратор",
				"2"=>"Корреспондент",
				"3"=>"Бухгалтер",
				"4"=>"Курьер"               
		   )
        );
        return $act;
    }	
	

    public function moontag($value)
    {
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
   
    
    public function access($x)
    {
        // Script::access()
        $x = strtr($x, array(
            '1' => '<span class="label label-warning">В ожидании</span>', 
            '2' => '<span class="label label-success">Активный</span>', 
            '3' => '<span class="label label-danger">Заблокирован</span>', 
            ));
        return $x;
    }  


	public function translit($string) {
		$converter = array(
			'«'=>'__',
			'»'=>'___',
			'`'=>'____',
			'"'=>'_____',
			'...'=>'______',
			'а' => 'a',   'б' => 'b',   'в' => 'v',
			'г' => 'g',   'д' => 'd',   'е' => 'e',
			'ё' => 'yo',   'ж' => 'zh',  'з' => 'z',
			'и' => 'i',   'й' => 'iy',   'к' => 'k',
			'л' => 'l',   'м' => 'm',   'н' => 'n',
			'о' => 'o',   'п' => 'p',   'р' => 'r',
			'с' => 's',   'т' => 't',   'у' => 'u',
			'ф' => 'f',   'х' => 'h',   'ц' => 'c',
			'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
			'ь' => 'ey',  'ы' => 'y',   'ъ' => 'zz',
			'э' => 'ie',   'ю' => 'yu',  'я' => 'ya',
			
			'А' => 'A',   'Б' => 'B',   'В' => 'V',
			'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
			'Ё' => 'Yo',   'Ж' => 'Zh',  'З' => 'Z',
			'И' => 'I',   'Й' => 'Iy',   'К' => 'K',
			'Л' => 'L',   'М' => 'M',   'Н' => 'N',
			'О' => 'O',   'П' => 'P',   'Р' => 'R',
			'С' => 'S',   'Т' => 'T',   'У' => 'U',
			'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
			'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
			'Ь' => 'eyy',  'Ы' => 'Y',   'Ъ' => 'Zz',
			'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
		);
		return strtr($string, $converter);
	}
	

	public function url($str) {
		$str = translit($str);
		$str = strtolower($str);
		$str = preg_replace('~[^-a-z0-9_]+~u', '_', $str);
		$str = trim($str, "-");
		return $str;
	}	
    

}

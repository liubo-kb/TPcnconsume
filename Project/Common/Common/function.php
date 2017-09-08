<?php
/*	全局公共方法	*/

ini_set('date.timezone','Asia/Shanghai');


function getAscStore($data,$lng,$lat)
{
	//计算每家店铺距离当前位置的距离
	for($i = 0; $i<count($data); $i++)
	{
		$data[$i]['distance'] = getDistance($lng, $lat, $data[$i]['longtitude'], $data[$i]['latitude'], 1);
	}
	$sort = array(  
		'direction' => 'SORT_ASC', //排序顺序标志 SORT_DESC 降序；SORT_ASC 升序  
		'field'     => 'distance',       //排序字段  
	); 
	
	//按照距离由近到远进行排序
	$arrSort = array(); 
	foreach($data as $uniqid => $row)
	{  
		foreach($row as $key=>$value)
		{  
			$arrSort[$key][$uniqid] = $value;  
		}  
	}  
	array_multisort($arrSort[$sort['field']], constant($sort['direction']), $data);  
	
	return $data;
}


//获取周边的经纬度范围
function getRange($lat,$lon,$raidus)
{
	//raidus 单位米
	$PI = 3.14159265;

	$latitude = $lat;
	$longitude = $lon;

	$degree = (24901*1609)/360.0;
	$raidusMile = $raidus;

	$dpmLat = 1/$degree;
	$radiusLat = $dpmLat*$raidusMile;
	$range['minLat'] = $latitude - $radiusLat;
	$range['maxLat'] = $latitude + $radiusLat;

	$mpdLng = $degree*cos($latitude * ($PI/180));
	$dpmLng = 1 / $mpdLng;
	$radiusLng = $dpmLng*$raidusMile;
	
	$range['minLng'] = $longitude - $radiusLng;
	$range['maxLng'] = $longitude + $radiusLng;
	return $range;
}

//计算两点之间的距离	
function getDistance($longitude1, $latitude1, $longitude2, $latitude2, $unit=2, $decimal=2)
{

	$EARTH_RADIUS = 6370.996; // 地球半径系数
	$PI = 3.1415926;

	$radLat1 = $latitude1 * $PI / 180.0;
	$radLat2 = $latitude2 * $PI / 180.0;

	$radLng1 = $longitude1 * $PI / 180.0;
	$radLng2 = $longitude2 * $PI /180.0;

	$a = $radLat1 - $radLat2;
	$b = $radLng1 - $radLng2;

	$distance = 2 * asin(sqrt(pow(sin($a/2),2) + cos($radLat1) * cos($radLat2) * pow(sin($b/2),2)));
	$distance = $distance * $EARTH_RADIUS * 1000;

	if($unit==2)
	{
		$distance = $distance / 1000;
	}

	return round($distance, $decimal);

}

function dateComp( $date1 , $date2 )
{
	$month1 = date("m",strtotime($date1));
    $month2 = date("m",strtotime($date2));

	$day1 = date("d",strtotime($date1));
	$day2 = date("d",strtotime($date2));

	$year1 = date("Y",strtotime($date1));
	$year2 = date("Y",strtotime($date2));

	$operate1 = mktime(0,0,0,$month1,$day1,$year1);
	$operate2 = mktime(0,0,0,$month2,$day2,$year2);

	if( $operate1 >= $operate2 )
	{
		return true;
	}
	else
	{
		return false;
	}
}


function logIn( $content )
{
	$table = D('log');
	$record = array(
	"datetime" => currentTime(), "content" => $content);
	addWithCheck( $table,$record );
}

function getDbErrorCode( $table )
{
    $str = $table->getDbError();
    $result = explode(':',$str);
    $code = $result[0];
    return $code;
}

function addWithCheck( $table,$record)
{
	try
	{
		$data = $table->add($record);
		return $data;
	}
	catch(\Think\Exception $e)
	{
		return getDbErrorCode( $table );
	}
}


function saveWithCheck( $table,$where,$set)
{
	try
	{
			$data = $table->where($where)->save($set);
			return $data;
	}
	catch(\Think\Exception $e)
	{
			return getDbErrorCode( $table );
	}
}



function setWithCheck( $table,$where,$set)
{
	try
	{
			$data = $table->where($where)->save($set);
			return $data;
	}
	catch(\Think\Exception $e)
	{
			return getDbErrorCode( $table );
	}
}



//获取唯一标示码
function get_uuid($prefix = "")
{    
	//可以指定前缀
	$str = md5(uniqid(mt_rand(), true));   
	$uuid  = substr($str,0,2);   
	$uuid .= substr($str,8,2);   
	$uuid .= substr($str,12,2);   
	$uuid .= substr($str,16,2);   
	$uuid .= substr($str,20,2);   
   	return $prefix . $uuid;
}

//记录添加到日志文件    
function logInfo($info)
{
	Think\Log :: write($info,'INFO');
}

//错误添加到日志文件
function logWarn($warn)
{
	Think\Log :: write($warn,'WARN');
}

//获取post数据
function post($para)
{
	return I('post.'.$para,'null','htmlspecialchars');
}

//获取get数据
function get($para)
{
	return I('get.'.$para,'null','htmlspecialchars');
}

//获取当前时间
function currentTime()
{
	return date('y-m-d H:i:s',time());
}

//获取对应时间
function getTime($current,$operate)
{
	 LogInfo($operate);
	 return date( 'y-m-d H:i:s',strtotime( $operate,strtotime($current) ) );
}

//获取当前日期
function currentDate()
{
	return date('y-m-d');
}

//转为Double做加法
function addAsDouble($para1,$para2)
{
	$para3 = doubleval($para1) + doubleval($para2);
	return $para3;
}

//转为Int做加法
function addAsInt($para1,$para2)
{
	$para3 = intval($para1) + intval($para2);
	return $para3;
}

//转为Double做减法
function redAsDouble($para1,$para2)
{
	$para3 = doubleval($para1) - doubleval($para2);
	return $para3;
}

//转为Int做减法
function redAsInt($para1,$para2)
{
	$para3 = intval($para1) - intval($para2);
	return $para3;
}

//转为Int做乘法
function multiAsInt($para1,$para2)
{
	$para3 = intval($para1) * intval($para2);
	return $para3;
}

?>

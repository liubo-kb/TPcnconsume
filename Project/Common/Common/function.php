<?php

ini_set('date.timezone','Asia/Shanghai');

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

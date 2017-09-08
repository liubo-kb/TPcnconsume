<?php
/**
	--------------------------------------------------
	接口的安全签名机制 SignUtils
	--------------------------------------------------
	Datetime: 2017-09-06
	--------------------------------------------------
	Author: LB
	--------------------------------------------------
*/

class SignUtils
{
    private $_password; // 口令（前后端规定的统一字段）
    private $_timestap; //时间戳
    private $_randCode; //随机数
    private $_sign;  //签名


    /*	带参构造方法	*/
    public function __construct($options = null)
    {
        $this->_password = "cnconsum";
        $this->_timestap = $options['timestap'];
        $this->_randCode = $options['randCode'];
        $this->_sign = $options['sign'];
    }

    /*  配置待验证参数  */
    function config($options)
    {
        $this->_timestap = $options['timestap'];
        $this->_randCode = $options['randCode'];
        $this->_sign = $options['sign'];
    }

    /*	验证签名	*/
    function checkSign()
    {
        //echo "口令:".$this->_password.",".strlen($this->_password)."<br/>";
        //echo "时间戳:".$this->_timestap.",".strlen($this->_timestap)."<br/>";
        //echo "随机码:".$this->_randCode.",".strlen($this->_randCode)."<br/>";
        //echo "上传的签名:".$this->_sign.",".strlen($this->_sign)."<br/>";
        //时间是否超时
        $currentTime = time()."";
        if( substr($this->_timestap,0,strlen($this->_timestap)-2) != substr($currentTime,0,strlen($currentTime)-2) )
        {
            return "time_out";
        }
        else
        {
            //签名是否正确
            $_sign = $this->genSign();
            //echo "生成的签名:".$_sign.",".strlen($_sign)."<br/>";
            if($_sign == $this->_sign)
            {
                return "sign_access";
            }
            else
            {
                return "sign_fail";
            }
        }
    }

    /*	生成签名	*/
    function genSign()
    { 
        $length_time = strlen($this->_timestap); //时间戳长度
        $length_randCode = strlen($this->_randCode); //随机码长度
        
        $index_rand = 0;
        $index_merg = 0;
        
        //时间戳和随机码合并插入
        for($index_time =0;$index_time<$length_time;$index_time++)
        {
            $str = $str.$this->_timestap[$index_time];
            if($index_rand < $length_randCode)
            {
               $str = $str.$this->_randCode[$index_time]; 
            }
        }
        //echo "str:".$str.",".strlen($str)."<br/>";
        
        //倒序生成新串
		for($i=0; $i<strlen($str); $i++)
		{
			$str_arr[$i] = $str[$i];
		}
		krsort($str_arr);
		$str_re = implode("",$str_arr);
        //echo "str_re:".$str_re.",".strlen($str_re)."<br/>";
        
        //异或加密
		$str_xor = $str_re ^ $this->_password;
		$last = substr($str_re,strlen($this->_password),strlen($str)-strlen($this->_password));
		$str_xor = $str_xor.$last;
        //echo "str_xor:".$str_xor.",".strlen($str_xor)."<br/>";
        
        //base64加密
		$str_base64 = base64_encode($str_xor);
        //echo "str_base64:".$str_base64.",".strlen($str_base64)."<br/>";
        
        return $str_base64;
    }
	
}
?>

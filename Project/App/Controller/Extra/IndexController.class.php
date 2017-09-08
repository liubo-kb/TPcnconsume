<?php
namespace App\Controller\Extra;
use Think\Controller;
class IndexController extends Controller 
{
	public function index()
	{
		echo '其它控制器索引';
	}
	
    function signTest()
    {
        /*  验证第三方  */
		import("Org.Util.Sign.SignUtils");
        $options = array(
            "timestap" => post("timestap"), "randCode" => post("randCode"), "sign" => post("sign")
        );
        $signUtils = new \SignUtils($options);
        //echo "验签状态:".$signUtils->checkSign()."<br/>";
        $result['sign_check_state'] = $signUtils->checkSign();
        echo json_encode($result);
    }
    
	function loadData()
	{
		$dir = "http://101.201.100.191/cnconsum/Public/Uploads/gameImage/question/";
		$record = array(
			"id" => post('id'),
			"image" => $dir.post('image'),
			"answer" => post('answer'),
			"type" => post('type')
		);
		$table = D("game_question_bank");
		
		if( addWithCheck($table,$record) == 1)
		{
				echo "上传成功!";
		}
		
	}
	
}

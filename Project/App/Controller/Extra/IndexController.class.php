<?php
namespace App\Controller\Extra;
use Think\Controller;
class IndexController extends Controller 
{
	public function index()
	{
		echo '其它控制器索引';
	}
	
	public function add()
        {
                $tab = D('activity');
                $theme = array(
                        '新店入驻','美发专区','节日活动','会员大放送'
                );

		$content = array(
                        '优惠停不下来','办卡永享8折优惠','万圣节够胆你就来','豪礼享不停'
                );

                for( $i = 0 ;$i < count($theme) ; $i++ )
                {
                        $record = array(
                                'id' => $i,'theme' => $theme[$i],'image_url' => 'activity_'.$i.'.png',
				'content' => $content[$i],'eare' => '西安市雁塔区','state' => 'true'
                        );
                        $tab->add($record);
                }
        }
	
}

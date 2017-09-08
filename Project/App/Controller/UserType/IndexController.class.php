<?php
namespace App\Controller\UserType;
use Think\Controller;
class IndexController extends Controller 
{
	public function test()
	{
		/*$rsa_private_key = "-----BEGIN PRIVATE KEY-----".
							"MIICdgIBADANBgkqhkiG9w0BAQEFAASCAmAwggJcAgEAAoGBAOx63rKdAw3grHnO".
							"deKWQA+m98ItlXb2/zPn+d2jTnI+sj+eegtEbR6BdUvxduYUHHNeU33m/TgWer9Z".
							"fZfsi78SQ5NgijjZKlRGQSS6RPMB6qStREGkAXfB5Y9JWmuT/83eCGm2iz54PR3n".
							"Zd7t+hn8ftudwkTRPwgaaKxAxj2DAgMBAAECgYA3p7NB1jIh0f7FrBGSgkoRZPpq".
							"eM/0b60gSjhEMWsE+Dx7PJD8ld4Yj99LQEj7XUBU5p4/w11VFfVNk4I7fzBkE9LA".
							"pRtxuBC0EUKE31aohy88Dv9fpNtPII2mNTbJs9q9iGRF6Hnd0wwZ/YgLXt2BmBq3".
							"vY1TuUHiF4Xkar8eAQJBAPqYN514n4cMDEMPmAsphLCs1asCIfJfDKkIfVYt+534".
							"eL6i19UMbhmWG70sB4ODMJc4Krj80mWEYUPx7MlBiBcCQQDxlLYwA2kyNfr3qkcT".
							"kCWW9HXPWLgOIhYvwVbysTxEB5M2NHgs6w7T3X9Zdj3OsuuxSZ1e2EfSaGe+blE/".
							"sS11AkAXLO6vzJEMX0vfA9ku5xcTc9iK6TaUgL/d/iABUV1c3bblApBtbqncCerk".
							"0uaa/g4HXjVtSEx5AQYxz3Tzo/DfAkEAhoMiSmuryExsODi0qLzrYTku28vvd9cc".
							"+WwyyKFNCCgbnOPsQj6DnA5J2XtQAOZ4+9cca/ILU6nUkiEE1m0F/QJAJFa/GDLZ".
							"9fwgwugFPKmwovLF7Mcp3gXTmsqWBg7XtgWjXYxKLjBI1GGi5lc/7aOgtYddWTHi".
							"qY80qbK20WefOA==-----END PRIVATE KEY-----";*/
		$rsa_private_key = "-----BEGIN RSA PRIVATE KEY-----
							MIICXAIBAAKBgQDset6ynQMN4Kx5znXilkAPpvfCLZV29v8z5/ndo05yPrI/nnoL
							RG0egXVL8XbmFBxzXlN95v04Fnq/WX2X7Iu/EkOTYIo42SpURkEkukTzAeqkrURB
							pAF3weWPSVprk//N3ghptos+eD0d52Xe7foZ/H7bncJE0T8IGmisQMY9gwIDAQAB
							AoGAN6ezQdYyIdH+xawRkoJKEWT6anjP9G+tIEo4RDFrBPg8ezyQ/JXeGI/fS0BI
							+11AVOaeP8NdVRX1TZOCO38wZBPSwKUbcbgQtBFChN9WqIcvPA7/X6TbTyCNpjU2
							ybPavYhkReh53dMMGf2IC17dgZgat72NU7lB4heF5Gq/HgECQQD6mDedeJ+HDAxD
							D5gLKYSwrNWrAiHyXwypCH1WLfud+Hi+otfVDG4Zlhu9LAeDgzCXOCq4/NJlhGFD
							8ezJQYgXAkEA8ZS2MANpMjX696pHE5AllvR1z1i4DiIWL8FW8rE8RAeTNjR4LOsO
							091/WXY9zrLrsUmdXthH0mhnvm5RP7EtdQJAFyzur8yRDF9L3wPZLucXE3PYiuk2
							lIC/3f4gAVFdXN225QKQbW6p3Anq5NLmmv4OB141bUhMeQEGMc9086Pw3wJBAIaD
							Ikprq8hMbDg4tKi862E5LtvL73fXHPlsMsihTQgoG5zj7EI+g5wOSdl7UADmePvX
							HGvyC1Op1JIhBNZtBf0CQCRWvxgy2fX8IMLoBTypsKLyxezHKd4F05rKlgYO17YF
							o12MSi4wSNRhouZXP+2joLWHXVkx4qmPNKmyttFnnzg=
							-----END RSA PRIVATE KEY-----
							";
		$rsa_public_key = "-----BEGIN PUBLIC KEY-----
							MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDset6ynQMN4Kx5znXilkAPpvfCLZV29v8z5/ndo05yPrI/nnoLRG0egXVL8XbmFBxzXlN95v04Fnq/WX2X7Iu/EkOTYIo42SpURkEkukTzAeqkrURBpAF3weWPSVprk//N3ghptos+eD0d52Xe7foZ/H7bncJE0T8IGmisQMY9gwIDAQAB
							-----END PUBLIC KEY-----";
		//检查公钥私钥是否可用
		$check_pri = openssl_get_privatekey($rsa_private_key);
		echo "check_pri:";
		var_dump($check_pri);
		echo "</br>";
		$check_pub = openssl_get_publickey($rsa_public_key);
		echo "check_pub:";
		var_dump($check_pub);
		echo "</br>";
		
		$data = "abcdefg";
		
		//数据加密
		openssl_private_encrypt($data,$encrypt_data,$rsa_private_key);
		echo "encrypt_key:";
		var_dump($encrypt_data);
		echo "</br>";
		
		//数据解密
		openssl_public_decrypt($encrypt_data,$decrypt_data,$rsa_public_key);
		echo "decrypt_key:";
		var_dump($decrypt_data);
		
		phpinfo();
	}
	
	public function log()
	{
		logIn("微信支付：".post('content'));
	}
	public function addData()
	{
		$phone = post('phone');
		$table = D('user');
		$where['phone'] = $phone;
		$uuid = $table->where($where)->select()[0]['uuid'];
		//设置钱包和积分
		$where_s['uuid'] = $uuid;
		$set['remain'] = '10000';
		$set['integral'] = '100000';
		$table->where($where_s)->save($set);
		//设置红包
		$table = D('red_packet');
		$where_r['user'] = $uuid;
		$set_r['sum'] = '10000';
		$table->where($where_r)->save($set_r);
		//设置平台优惠卷
		$table = D('sxl_user_coupon');
		for($i=0;$i<10;$i++)
		{
			$record = array(
				'id' => $uuid."_".$i,
				'uuid' => $uuid,
				'coupon_id' => '0001',
				'datetime' => currentTime()
			);
			addWithCheck($table,$record);
		}
		echo $phone."设置成功!";
	}	
	
	public function setMerchant()
	{
		$table = D('merchant');
		$data = $table->select();
		for($i = 0; $i < count($data); $i++)
		{
			$item = $data[$i];
			if($item['phone'] != $item['store'])
			{
				$record = array(
					'account' => $item['muid'],
					'passwd' => '000000',
					'phone' => $item['phone'],
					'nickname' => $item['store'],
					'headImage' => $item['image_url']
				);
				$table = D('im_account');
				echo addWithCheck($table,$record);
				echo "<br/>";
			}
		}
	}
	

	public function setUser()
        {
                $table = D('user');
                $data = $table->select();
                for($i = 0; $i < count($data); $i++)
                {
                        $item = $data[$i];
                        if($item['phone'] != $item['nickname'])
                        {
				dump($item);
                                $record = array(
                                        'account' => $item['uuid'],
                                        'passwd' => '000000',
                                        'phone' => $item['phone'],
                                        'nickname' => $item['nickname'],
                                        'headImage' => $item['headimage']
                                );
                                $table = D('im_account');
                                echo addWithCheck($table,$record);
                                echo "<br/>";
                        }
                }
        }
}

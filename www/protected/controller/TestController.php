<?php
/**
 * MainController
 * Feel free to delete the methods and replace them with your own code.
 *
 * @author darkredz
 */
Doo::loadClassAt("Base/AppController");
class TestController extends AppController{
	
    public function index(){    	
		
		$uid = 1;
		
		//$this->addAcivity();
		//$this->addProduct();

		//$this->actApply($uid);
		$this->proApply($uid);
    }


    /**
     * fun: 试用申请
     *
     * @return void
     * @author 
     **/
    private function proApply($uid)
    {
    	Doo::loadService('ProductService');
		$proServ = new ProductService();
		$proServ->proApply($uid, $pid=1, '非常非常想参加');
    }


    /**
     * fun: 活动报名
     *
     * @return void
     * @author 
     **/
    private function actApply($uid)
    {
    	Doo::loadService('ActivityService');
		$actServ = new ActivityService();
		$actServ->actApply($uid, $aid=1, array(
			'cnt'=>1,
			'realname'=>'张三',
			'mobile'=>'13888888888'
		));
    }

	/**
	 * fun: 添加活动
	 *
	 * @return void
	 * @author 
	 **/
	private function addAcivity()
	{
		Doo::loadService('ActivityService');
		$actServ = new ActivityService();

		$data['title'] = '欢乐圣诞，挑战思维——优贝乐科学馆主题Party';
		$data['content'] = '别等宝宝会走了，您才后悔没带TA参加爬行比赛！ 
一次亲密的接触，一场酣畅的比赛，一回快乐的亲子，一段美好的回忆。 
好太太网携手各知名早教中心为您打造北京城最火爆，最高品质的亲子盛宴。7大城区，65场爬行赛事，真正实现最近路程，最低收费，最优品质。瑟瑟深秋，一起去收获快乐吧！！ 
 
只要您宝宝在6-13个月，只要您愿意共享开心，那就来吧……';
		$data['sponsor'] = '优贝乐科学馆通州旗舰店';
		$data['pic'] = 'http://img.pcbaby.com.cn/images/sns/tryprod/20139/25/13800876026700120_160x120.jpg';
		$data['totype'] = 0;
		$data['city'] = '北京';
		$data['city_id'] = 0;
		$data['provice'] = '北京';
		$data['province_id'] = 0;
		$data['type'] = 1;
		$data['isfree'] = 1;
		$data['used_cnt'] = 0;
		$data['remain_cnt'] = 100;
		$data['b_cnt'] = 0;
		$data['b_stattime'] = date('Y-m-d',time());
		$data['b_endtime'] = date('Y-m-d',time() + 86400 * 30);
		$data['createtime'] = time();

		$actServ->getActObj($data)->insert();
		print_r($actServ->getActObj()->show_sql());
	}

	/**
	 * fun: 添加试用
	 *
	 * @return void
	 * @author 
	 **/
	private function addProduct()
	{
		Doo::loadService('ProductService');
		$proServ = new ProductService();

		 $data = array(
        'parter_id'=>1,  //合作商id
        'title'=>'PCbaby孕妇大礼包',  //标题
        'type_id'=>1,  //产品类型id
        'price'=>'800',  //产品价格
        'jifen'=>'',  //产品消费积分
        'reward_jifen'=>'', //试用报价奖励积分
        'totype'=>0, //参与对象[0所有，1备孕，2孕妇，3产妇，4孩子]
        'desc'=>'1.您的资料完善度在60%以上，并已通过手机验证 http://play10.pcbaby.com.cn/baby130528/
2.您或者您的家人是孕妇
3.试用发放地区为全国
4.您留下的地址、电话真实有效
5.凡申请成功者，如因地址不详或电话错误、无人接听造成无法寄送，商家不再补寄或重新邮寄', //申请规则
        'content'=>'本次试用说明：  
1.本次试用申请无需抵押积分
 
活动详情：
当身体中孕育了小小的新生命，孕期的所有也都将变得美好和神奇。太平洋亲子网关爱着每一位准妈妈，现在特别推出孕妈妈关爱活动，PCbaby孕妈大礼包免费领！ 
 
只要您是一个孕妇，或者您家里有一个孕妇，就可以免费申领PCbaby孕妇大礼包哦！还犹豫什么？快快动动手指赶紧来申请吧！PCbaby将会陪您度过最难忘的280天！
 
领取方法：
1、每一位亲子网注册孕妈参与活动，手机成功验证即可获得PCbaby为您提供的精美母婴用品！
2、获得礼品后，您还可以到亲子论坛晒单，获得我们精美礼品！
 
活动时间：
2013年9月—2014年 
 
温馨提示：
获得孕妈礼包的准妈妈将会收到亲子网的回访电话核实相关信息，若不符合孕妇身份即会被取消获奖资格。',  //产品详细信息
        'pic'=>'http://img.pcbaby.com.cn/images/sns/tryprod/20139/25/13800876026700120_160x120.jpg',  //产品logo
        'city'=>'', //申请区域[城市]
        'city_id'=>'',  //城市id
        'provice'=>'',  //省份
        'province_id'=>'',  //省份id
        'posttype'=>1, //配送方式[1包邮，2自取，3付邮]
        'used_cnt'=>0, //已用商品数[申请成功人数]
        'remain_cnt'=>300, //剩余商品数
        'b_cnt'=>0,  //申请人数
        'b_stattime'=>date('Y-m-d',time()), //报名开始时间
        'b_endtime'=>date('Y-m-d',time()+86400*12),  //报名截止日期
        'bg_stattime'=>date('Y-m-d',time() + 86400*20),  //报告提交开始时间
        'bg_endtime'=>date('Y-m-d',time()+86400*30), //报告提交截止日期
        'bg_cnt'=>0, //已提交报告数
      );
      $data = $proServ->getProObj($data)->insert();

      print_r($proServ->getProObj()->show_sql());
	}
}

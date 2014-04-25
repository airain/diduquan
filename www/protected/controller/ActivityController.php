<?php
/**
 * ActivityController--renderc
 * 活动
 */
Doo::loadClass("Base/BaseController");
class ActivityController extends BaseController{

    private $actServ=null;

  	public function beforeRun($resource, $action){
  		parent::beforeRun($resource, $action);
  		$this->vdata['module_name'] = "活动";
      Doo::loadService('ActivityService');
      $this->actServ = new ActivityService();

  	}
	
    public function index(){
      $this->vdata['actlist'] = $actlist;
      $this->viewRenderAutomation();
    }

    /**
     * fun: detail
     * des: 活动详情
     *
     * @return void
     * @author 
     **/
    public function detail()
    {
      print_r($this->params);
      $this->vdata['actinfo'] = $actinfo;
      //$this->renderElement('activity/index');
      $this->viewRenderAutomation();
    }

    /**
     * fun: issue
     * des: 发布报告
     *
     * @return void
     * @author 
     **/
    public function issue()
    {
      $aid = $this->params[0];
      if(!$aid){
          exit('没有找到内容');
      }
      $conf = array(
        'where' => 'aid=?',
        'param' => array($aid)
      );
      $actinfo = $this->actServ->getActObj()->getOne($conf);
      $this->vdata['actinfo'] = $actinfo;
      //活动已不存

      //活动还未结束

      $this->viewRenderAutomation();
    }


    //-------------------------

    /**
     * fun: ajaxIssue
     *
     * @return void
     * @author 
     **/
    public function ajaxIssue()
    { 
      $aid = gpc_get('aid');
      $data['title'] = gpc_get('title');
      $data['content'] = gpc_get('content');
      $res = $this->actServ->saveActTopic($this->_user->uid, $aid, $data);

      $this->echoMessage($res['result'],$res['message'], $res);
    }
   	
}


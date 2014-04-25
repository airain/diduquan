<?php
/**
 * MainController
 * Feel free to delete the methods and replace them with your own code.
 *
 * @author darkredz
 */
Doo::loadClass("ModuleController");
class MainController extends ModuleController{

    private static $_MenuObj = null;

    public function beforeRun($resource, $action){
        parent::beforeRun($resource, $action);

        self::$_MenuObj = $this->model('Menu');
         // $rp = $this->getMenus(0,0);
         // print_r($rp);
    }

    public function index(){

    	//menu
    	self::$_MenuObj->pid = 0;
    	$menu = self::$_MenuObj->find(array('asArray'=>true,'asc'=>'sort'));

    	//默认第一个选中
    	if(count($menu)>0){
    		$menu[0]['active'] = 1;
    	}

    	$this->vdata['menu'] = $menu;

    	//$this->vdata['script'] = "admin/m/index";
		$this->viewRenderAutomation();
    }

    public function menu()
    {
        $pid = gpc_get('pid');

        $conf = array(
            'where' => 'pid='.intval($pid)
        );

        $res = $this->getMenus($pid);
        $this->toJSON($res, true);
    }


    private function  getMenus($pid=0, $deep=null){
        $conf = array(
            'where' => 'pid='.intval($pid),
            'asc'=>'sort'
        );
        $res = self::$_MenuObj->find($conf);
        $rec = array();
        if($res){
            $i = 0;
            while ($menu = current($res)) {
                $rec[$i] = $menu;
                $rec[$i]->childs = ($deep !== null && $deep == $menu->deep)? array() : $this->getMenus($menu->id);
                $i++;
                next($res);
            }
        }

        return $rec;
    }
}
?>
<?php 
Doo::loadClassAt("Base/BaseService");
/**
 * 
 * @author hxf
 *
 */
class KeywordService extends BaseService {
	
	private $max_page;
	
	private $tao_api_url;
	
	public function __construct(){
		$this->max_page = Doo::conf()->TAO_S_PAGE;
		$this->tao_api_url = Doo::conf()->TAO_S;
	}
	
	/**
	 * 获取需要执行采集的关键字
	 * @return mixed
	 */
	public function getNeedCollectionKeyword(){
		$keywordObj = new Keyword();
		$keywordObj->delflag = 0;
		$res = $keywordObj->find(array(
				'select'=>'id,keyword,search_type,search_value',
				'where'=>time().'-collection_time>collection_interval',
				'asArray' => true
		));
		return $res;
	}
	
	/**
	 * 采集关键字排名并更新
	 * @param int $keyword_id
	 * @return boolean
	 */
	public function collectRanking($keyword_id){
		
		$keyword_id = intval($keyword_id);
		
		//查询主数据
		$keywordObj = new Keyword();
		$keywordObj->id = $keyword_id;
		$kw = $keywordObj->getOne();
		if(!$kw){
			return false;
		}
		
		//查询排名
		$key = $kw->search_type==2?'url':'nick';
		$data = $this->getRanking($kw->keyword, $kw->search_value, $key);
		
		//写入排名
		$sortObj = new KeywordSort();
		$sortObj->keyword_id = $keyword_id;
		if($data){
			$sortObj->item_id = $data['id'];
			$sortObj->item_nick = $data['nick'];
			$sortObj->item_url = $data['url'];
			$sortObj->item_price = floatval($data['price']);
			$sortObj->item_sells = $data['sells'];
			$sortObj->item_title = $data['title'];
			$sortObj->ranking = $data['ranking'];
			$sortObj->item_comments = $data['comments'];
		}else{
			$sortObj->ranking = 0;
		}
		$res = $sortObj->insert();
		if(!$res){
			return false;
		}
		
		//更新主表
		$keywordObj->ranking = $sortObj->ranking;
		$keywordObj->collection_time = time();
		$keywordObj->ranking_min = min($kw->ranking_min<=0?$sortObj->ranking:$kw->ranking_min,$sortObj->ranking);
		$keywordObj->ranking_max = max($kw->ranking_max,$sortObj->ranking);
		$keywordObj->uptime = $kw->uptime;
		$res = $keywordObj->update();
		
		return !!$res;
	}
	
	/**
	 * 获取关键字排名
	 * @param string $keywords
	 * @param string $value
	 * @param string $key
	 * @return Ambigous <boolean, number>
	 */
	public function getRanking($keywords,$value,$key="nick"){
		ini_set('user_agent','Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)');
		Doo::loadClassAt("QueryPath/QueryPath");
		$ranking = false;
		$index = 0;
		for($i=1;$i<=$this->max_page;$i++){
			$data = $this->collection($keywords, $i);
			if(!$data){break;}
			foreach($data as $k => $v){
				$index++;
				if($v[$key]==$value){
					$ranking = $v+array('ranking'=>$index);
					break;
				}
			}
			if($ranking){break;}
		}
		return $ranking;
	}
	
	/**
	 * 
	 * @param string $keywords
	 * @param int $page
	 * @return multitype:multitype:NULL string
	 */
	public function collection($keywords,$page){
		$url = $this->tao_api_url."?q=".urlencode($keywords)."&s=".(($page-1)*40)."&cd=false";
		$html = file_get_contents($url);
		$html = preg_replace( '/<!--.*?-->/s', '', $html );
		$html = mb_convert_encoding($html,"UTF-8","GBK");
		$html = str_replace('<meta charset="gbk">', '<meta http-equiv="content-type" content="text/html;charset=utf-8">', $html);
		$qp = htmlqp($html,".icon-datalink",array('convert_to_encoding' =>false));
		$data = array();
		foreach($qp as $li){
			$data[] = array(
					'id' => $li->attr("nid"),
					'nick' => trim($li->find('.seller>a')->text()),
					'title' => trim($li->end()->find('h3')->text()),
					'url' => $li->end()->find('h3>a')->attr("href"),
					'price' => floatval(str_replace("￥","",$li->end()->find('div.price')->text())),
					'sells' => intval(str_replace(array("最近","人成交"),array("",""),$li->end()->find('div.dealing')->text())),
					'comments' => intval(str_replace("条评论","",$li->end()->find('div.count')->text())),
					'current_url' => $url
			);
		}
		return $data;
	}
	
	
}


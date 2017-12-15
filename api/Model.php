<?php 

class Model extends Validated{

	public function _add($p){
		$col = $this->column_name();
		foreach ($p as $key => $value) {
			if(!in_array($key, $col))
				continue;
			$sql_key .= "`$key`,";
			$sql_value .= "'$value',";
		}
		$sql_key = trim($sql_key,',');
		$sql_value = trim($sql_value,',');
		$sql = "insert into $this->table ($sql_key) values ($sql_value)";
		$r = $this->pdo->prepare($sql)->execute();
		return $r;
	}

	public function tss($arr){
		$ss='';
		foreach($arr as $key=>$value){
			$ss .= $this->sst($value);
		}
		return $ss = trim($ss,',');
	}

	public function sst($arr){
		$col = $this->column_name();
		$s = '';
		foreach ($arr as $key => $value) {
			if(!in_array($key, $col))
				continue;
			$s .="'$value',";
		}
		$s = trim($s,',');
		return "($s),";
	}

	public function multiAdd($p){
		$col = $this->column_name();
		foreach ($p[0] as $key => $value) {
			if(!in_array($key, $col))
				continue;
			$sql_key .= "`$key`,";
		}
		$sql_key = trim($sql_key,',');
		$sql_value = $this->tss($p);
		$sql = "insert into $this->table ($sql_key) values $sql_value";
		$r = $this->pdo->prepare($sql)->execute();
		return $r;
	}

	public function _read($p){
		$sql_limit = '';
		if($p['id']){
			$sql ="select * from $this->table where id={$p['id']}";
		}else{
			$by = $p['by'] ?: 'id';
			$sort = $p['sort']?: 'desc';
			$sql_order = "order by $by $sort";

			if($p['page']){
				$limit = $p['limit']?:10;
				$page = $p['page'] ?: 1;
				$page = ( $page - 1) * $limit;
				$sql_limit = "limit $page,$limit";
			}


			if($p['where']){
				$sql_where = $this->sql_equal($p['where'],'and');
			}
			if($p['or_where']){
				if($sql_where)
					$sql_or_where = 'or ';
				$sql_or_where .= $this->sql_equal($p['or_where'],'or');
			}
			if($p['like']){
				if($sql_where)
					$sql_like = 'and';
				$sql_like .= $this->sql_equal($p['like'],'and',true);
			}
			if($p['or_like']){
				if($sql_where)
					$sql_or_like = 'or';
				$sql_or_like .= $this->sql_equal($p['like'],'or',true);
			}
			if($p['where']||$p['or_where']||$p['like']||$p['or_like'])
				$where = 'where';

			$sql = "select * from $this->table $where $sql_where $sql_or_where $sql_like $sql_or_like $sql_order $sql_limit";
		}

		$r = $this->pdo->prepare($sql);
		$r->execute();
		return $r->fetchALL(2);
	}

	public function sql_equal($arr,$sye,$like=false){
		$col = $this->column_name();
		foreach ($arr as $key => $value) {
			if(in_array($key, $col)){
				if($like) {
					$c .= " `$key` like '%{$value}%' $sye";
				}else{
					$c .= " `$key` = '{$value}' $sye";
				}
			}
		}
		return trim($c,$sye);
	}

	public function column (){
		$r = $this->pdo->prepare("desc `$this->table`");
		$r->execute();
		return $r->fetchALL(2);
	}

	public function column_name(){
		$col = $this->column();
		$arr = [];
		foreach($col as $key){
			$arr[] = $key['Field'];
		}
		return $arr;
	}

	public function _update($p){
		$id = $p['id'];
		if(!$id)
			return false;
		unset($p['id']);
		$sql_set = $this->sql_equal($p,',');
		$sql = "update $this->table set $sql_set where id=$id";
		// echo $sql;
		// die();
		$r = $this->pdo->prepare($sql)->execute();
		return $r;
	}

	public function getInsertLastId(){
		// var_dump(get_class_methods($pdo))
		echo $this->pdo->lastInsertId();
	}
}
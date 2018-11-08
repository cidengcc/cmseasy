<?php
class plugins {
	static function categoryinfo($id) {
		if ($id == 0) {
			$category = category::getInstance ();
			if (is_array ( $id ))
				$id = $id ['catid'];
			$categories = $category->son ( $id );
			$cats = array ();
			foreach ( $categories as $catid ) {
				$_category = $category->category [$catid];
				if ($stype && ! preg_match ( '/-/', $stype ) && $_category ['stype'] != $stype)
					continue;
				if ($stype && preg_match ( '/-/', $stype ) && '-' . $_category ['stype'] == $stype)
					continue;
				$_category ['url'] = category::url ( $_category ['catid'] );
				$cats [] = $_category;
			}
			return $cats;
		}
		$category = category::getInstance ();
		$catinfo [] = $category->category [$id];
		$catinfo [0] ['url'] = category::url ( $id );
		return $catinfo;
	}
	
	static function specialinfo($id) {
		$special = special::getInstance();
		$catinfo[] = $special->getrow($id);
		$catinfo[0]['url'] = special::url($id,$special->getishtml($id));
		return $catinfo;
	}
	
	static function typeinfo($id) {
		$type = type::getInstance ();
		if (is_array ( $id ))
			$id = $id ['typeid'];
		
		$typeinfo [] = $type->type [$id];
		$typeinfo [0] ['url'] = type::url ( $id );
		if(!$typeinfo){
			return;
		}
		
		$types = $type->son ( $id );
		$tys = array ();
		foreach ( $types as $typeid ) {
			$_type = $type->type [$typeid];
			if ($stype && ! preg_match ( '/-/', $stype ) && $_type ['stype'] != $stype)
				continue;
			if ($stype && preg_match ( '/-/', $stype ) && '-' . $_type ['stype'] == $stype)
				continue;
			$_type ['url'] = type::url ( $_type ['typeid'] );
			$tys [] = $_type;
		}
		if(!empty($tys)){
			$typeinfo = array_merge($typeinfo,$tys);
		}
		//var_dump($typeinfo);
		return $typeinfo;
	}
}
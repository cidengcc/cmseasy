<?php
//仅支持以 .htm 结尾的规则 即 .htm$

return

array(
		
		/*手机版*/
		
		//列表
		array('list_wap_(\d+)\.htm$','archive/list/catid/$1/t/wap'),
		array('list_wap_(\d+)_(\d+)\.htm$','archive/list/catid/$1/page/$2/t/wap'),
		
		//内容
		array('show_wap_(\d+)\.htm$','archive/show/t/wap/aid/$1'),
		array('show_wap_(\d+)_(\d+)\.htm$','archive/show/t/wap/aid/$1/page/$2'),
		
		//标签
		array('tags-wap-(.*?)-(\d+)\.htm$','tag/show/t/wap/tag/$1/page/$2'),
		
		//省
		array('arealist_province_(\d+)\.htm$','area/list/province_id/$1'),
		array('arealist_province_(\d+)_(\d+)\.htm$','area/list/province_id/$1/page/$2'),
		
		//市
		array('arealist_city_(\d+)\.htm$','area/list/city_id/$1'),
		array('arealist_city_(\d+)_(\d+)\.htm$','area/list/city_id/$1/page/$2'),
		
		//县
		array('arealist_section_(\d+)\.htm$','area/list/section_id/$1'),
		array('arealist_section_(\d+)_(\d+)\.htm$','area/list/section_id/$1/page/$2'),
		
		//专题
		array('speciallist-(\d+)\.htm$','special/show/spid/$1'),
		array('speciallist-(\d+)-(\d+)\.htm$','special/show/spid/$1/page/$2'),
		
		//分类
		array('typelist_(\d+)\.htm$','type/list/typeid/$1'),
		array('typelist_(\d+)_(\d+)\.htm$','type/list/typeid/$1/page/$2'),
		
		//列表
		array('list_(\d+)\.htm$','archive/list/catid/$1'),
		array('list_(\d+)_(\d+)\.htm$','archive/list/catid/$1/page/$2'),
		
		//内容
		array('show_(\d+)\.htm$','archive/show/aid/$1'),
		array('show_(\d+)_(\d+)\.htm$','archive/show/aid/$1/page/$2'),
		
		//标签
		array('tags-(.*?)-(\d+)\.htm$','tag/show/tag/$1/page/$2'),
		
		
);


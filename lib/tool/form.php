<?php

class form
{
    static function input($name, $value = null, $option = null)
    {
        return $input = "<input type=\"text\" name=\"$name\" id=\"$name\" value=\"$value\" class=\"form-control\"  $option/>";
    }

    function hidden($name, $value = null, $option = null)
    {
        return $input = "<input type=\"hidden\" name=\"$name\" id=\"$name\" value=\"$value\"  class=\"form-control\" $option/>";
    }

    static function password($name, $value = null, $option = null)
    {
        return $input = "<input type=\"password\" name=\"$name\" id=\"$name\" value=\"$value\"  class=\"form-control\" $option/>";
    }

    function textarea($name, $value = null, $option = null)
    {
        return $input = "<textarea name=\"$name\" id=\"$name\" class=\"form-control textarea\" $option>$value</textarea>";
    }

    static function select($name, $value, $data, $option = null)
    {
        $select = "<select id=\"$name\" name=\"$name\" class=\"form-control select\" $option>";
        if (!isset($data[0]) && @$data[0] != null) {
            $select .= "<option value=\"0\">请选择...</option>";
        }
        if (@$data[0] == null || (isset($data[0]) && !$data[0]))
            unset($data[0]);
        if ($_GET['table'] == 'category') {
            $category = category::getInstance();
            $subids = $category->sons($_GET['id']);
        }
        if ($_GET['table'] == 'type') {
            $category = type::getInstance();
            $subids = $category->sons($_GET['id']);
        }
        foreach ($data as $k => $d) {
            $select .= "<option value=\"$k\"";
            if ($k == $value) {
                $select .= ' selected ';
            } else if (isset($_GET['id']) && ($_GET['table'] == 'category' || $_GET['table'] == 'type') && !preg_match('/(htmlrule|isnav|ismobilenav)/is', $name)) {
                if ($_GET['id'] == $k || in_array($k, $subids)) {
                    $select .= ' disabled ';
                }
            }
            $select .= ">$d</option>";
            //$select.="<option value=\"$k\" ".($k == $value ?'selected': '').">$d</option>";
        }
        $select .= "</select>";
        return $select;
    }

    function radio($name, $value, $checked = null, $option = null)
    {
        $checked = $checked ? 'checked="checked" ' : '';
        return "<label class=\"checkbox-inline\"><input name=\"$name\" type=\"radio\" id=\"$name\" value=\"$value\" class=\"radio\" $checked $option>	</label>";
    }


    function checkbox($name, $value, $checked = null, $option = null)
    {
        $checked = $checked ? 'checked="checked" ' : '';
        return $input = "<label class=\"checkbox-inline\"><input type=\"checkbox\" name=\"$name\" id=\"$name\" class=\"checkbox\" value=\"$value\" $checked $option>	</label>&nbsp;&nbsp;&nbsp;";
    }

    function checkbox2($name, $value, $checked = null, $option = null)
    {
        $checked = $checked ? 'checked="checked" ' : 'checked="checked" ';
        return $input = "<label class=\"checkbox-inline\"><input type=\"checkbox\" name=\"$name\" id=\"$name\" class=\"checkbox\" value=\"$value\" $checked $option>	</label>&nbsp;&nbsp;&nbsp;";
    }

    function submit($value = '	提交	')
    {
        return "<input type=\"submit\" name=\"submit\" value=\"$value\" class=\"btn btn-primary btn-lg\" >";
    }

    function date($name, $value)
    {
        return "<script language=\"javascript\">
$(document).ready(function()
	{
	var yearFrom=1990;
	var yearTo=2030;
	$('#$name').datepicker(
		{
		dateFormat: 'yy-mm-dd',
		buttonImage: '" . front::$view->base_url . "/images/calendar.png',
		buttonText: '请选择日期',
		buttonImageOnly: true,
		showOn: 'both',
		yearRange: yearFrom+':'+yearTo,
		clearText:'清除',
		closeText:'关闭',
		prevText:'前一月',
		nextText:'后一月',
		currentText:' ',
		monthNames:['1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月']
	}
		);
}
);
</script>\r\n" . self::input($name,
                $value);
    }

    function doDef($res)
    {
        return $res[1];
    }

    function getform($name, $form, $field, $data)
    {
		//var_dump($name);
        if (get('table') && isset(setting::$var[get('table')][$name]))
            $form[$name] = setting::$var[get('table')][$name];
		//var_dump($form[$name]);
        if (get('form') && isset(setting::$var[get('form')][$name]))
            $form[$name] = setting::$var[get('form')][$name];
		//var_dump($form[$name]);
        if (isset($form[$name]['default'])) {
            if ((int)PHP_VERSION >= 7) {
                $form[$name]['default'] = preg_replace_callback('/\{\?([^}]+)\}/', "self::doDef", $form[$name]['default']);
            } else {
                $form[$name]['default'] = preg_replace('/\{\?([^}]+)\}/e', "eval('return $1;')", $form[$name]['default']);
            }
        }
        if (!isset($data[$name]) && isset($form[$name]['default']))
            $data[$name] = @$form[$name]['default'];
        if (preg_match('/templat/', $name) && empty($data[$name]))
            $data[$name] = @$form[$name]['default'];
        //var_dump($field);

        if (@$form[$name]['filetype'] == 'image') {
            $return = form::upload_image($name, front::post($name) ? front::post($name) : @$data[$name]);
        } elseif (@$form[$name]['filetype'] == 'file') {
            $return = form::upload_file($name, front::post($name) ? front::post($name) : @$data[$name]);
        } elseif (@$form[$name]['filetype'] == 'image1') {
            $return = form::upload_image1($name, front::post($name) ? front::post($name) : @$data[$name]);
        } elseif (@$form[$name]['filetype'] == 'image2') {
            $return = form::upload_image2($name, front::post($name) ? front::post($name) : @$data[$name]);
        } elseif (@$form[$name]['filetype'] == 'image_mui') {
            $return = form::upload_imagemui($name, front::post($name) ? front::post($name) : @$data[$name]);
        } elseif (@$form[$name]['filetype'] == 'thumb') {
            $return = form::upload_thumb($name, front::post($name) ? front::post($name) : @$data[$name]);
        } elseif (@$form[$name]['selecttype'] == 'select') {
            preg_match_all('%\((.*?)\)(\S+)%s', $form[$name]['select'], $result, PREG_SET_ORDER);
            //var_dump($result);
			$sdata = array();
            foreach ($result as $res) $sdata[$res[1]] = $res[2];
			//var_dump($sdata);
            $return = form::select($name, front::post($name) ? front::post($name) : @$data[$name], $sdata, ' class="form-control select"');
        } elseif (@$form[$name]['selecttype'] == 'radio') {
            preg_match_all('/\(([\d\w]+)\)(\S+)/m', $form[$name]['select'], $result, PREG_SET_ORDER);
            $_res = '';
            foreach ($result as $res) $_res .= $res[2] . form::radio($name, $res[1], $res[1] == (front::post($name) ? front::post($name) : @$data[$name])) . "";
            $return = $_res;
        } elseif (@$form[$name]['selecttype'] == 'checkbox') {
            preg_match_all('/\(([\d\w]+)\)(\S+)/is', $form[$name]['select'], $result, PREG_SET_ORDER);
            $_res = '';
            $values = front::post($name) ? front::$post[$name] : @$data[$name];
            if (is_string($values))
                $values = explode(',', $values);
            if (!$values)
                $values = array();
            foreach ($result as $res) $_res .= $res[2] . form::checkbox($name . '[]', $res[1], in_array($res[1], $values)) . "";
            return $_res;
        } elseif (@$form[$name]['selecttype'] == 'checkbox2') {
            preg_match_all('/\(([\d\w]+)\)(\S+)/is', $form[$name]['select'], $result, PREG_SET_ORDER);
            $_res = '';
            $values = front::post($name) ? front::$post[$name] : @$data[$name];
            if (is_string($values))
                $values = explode(',', $values);
            if (!$values)
                $values = array();
            foreach ($result as $res) $_res .= $res[2] . form::checkbox2($name . '[]', $res[1], in_array($res[1], $values)) . "";
            return $_res;
        }elseif (@$field[$name]['type'] == 'text') {
            //var_dump($field);
            $return = form::textarea($name, front::post($name) ? front::post($name) : @$data[$name], '');
        }elseif (@$field[$name]['type'] == 'bigtext') {
            //var_dump($field);
            $return = form::textarea($name, front::post($name) ? front::post($name) : @$data[$name], '');
        } elseif (@$field[$name]['type'] == 'mediumtext' || $form[$name]['type'] == 'mediumtext') {
            //var_dump($field);
            $return = form::ueditor($name, front::post($name) ? front::post($name) : @$data[$name]);
        } elseif (@$field[$name]['type'] == 'datetime' or @$field[$name]['type'] == 'date') {
            $return = form::date($name, front::post($name) ? front::post($name) : @$data[$name]);
        } else {
            $placeholder = '';
            if (isset($form[$name]['placeholder'])) {
                $placeholder = 'placeholder="' . $form[$name]['placeholder'] . '"';
            }
            $return = form::input($name, front::post($name) ? front::post($name) : @$data[$name], $placeholder);
        }

        if ($field[$name]['notnull'])
            $return .= "&nbsp;";
        if (@$form[$name]['tips']) {
            if ((int)PHP_VERSION >= 7) {
                $tips = preg_replace_callback('/\{\?([^}]+)\}/', "self::doDef", $form[$name]['tips']);
            } else {
                $tips = preg_replace('/\{\?([^}]+)\}/e', "eval('return $1;')", $form[$name]['tips']);
            }


            $return .= "&nbsp;" . $tips;
        }
        return $return;
    }

    static function select_option($name, $form, $value)
    {
        preg_match_all('/\(([\d\w]+)\)(\S+)/im', $form['select'], $result, PREG_SET_ORDER);
        $values = explode(',', trim($value, ','));
        $res = array();
        foreach ($values as $key => $rs) {
            //$res[$key]=$result[$rs][2];
            foreach ($result as $a => $b) {
                if ($b[1] == $rs) {
                    $res[$key] = $b[2];
                }
            }
        }
        return implode(',', $res);
    }

    static function upload_thumb($name, $value)
    {
		//内容缩略图
        $cut_url = url('tool/cut_image', false);
        $img_url = './images/admin/add_pic.gif';
        if (front::$act == 'edit' && $value) {
            /*if(strtolower(substr($value,0,7)) != 'http://'){
                $img_url = $value;
            }else{
                $img_url = $value;
            }*/
            $img_url = $value;
        }
        $res = "
        <div style=\"clear:both\"></div><div style=\"clear:both;float:left;margin-top:10px;\">
        <a title=\"选择文件\" onclick=\"javascript:windowsdig('选择文件','iframe:index.php?case=file&act=updialog&fileinputid={$name}&getbyid={$name}_preview&max=1&checkfrom=picshow','900px','480px','iframe')\" href=\"#body\"><p><span id=\"{$name}_preview\"><img src=\"$img_url\" style=\"width:150px;\" /></span></p></a>
          </div><div class=\"blank10\"></div> <div class=\"row\"><div class=\"col-xs-8 col-sm-8 col-md-9 col-lg-10 text-right\"><input name=\"$name\"  id=\"$name\" value=\"$value\"  class=\"form-control\" />" .
            '</div><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-left"><input value=" 删除 " class="btn btn-primary" title="删除" id="' . $name . '_del" onclick="pics_delete(\'\',\'' . $name . '\');document.getElementById(\'' . $name . '_preview\').innerHTML=\'<img src=\\\'images/admin/add_pic.gif\\\' width=\\\'150\\\'>\';" value="删除" type="button" name="delbutton" class="btn btn-primary" /></div></div>';

        
        return $res;
    }

    static function upload_image($name, $value)
    {
		$cut_url = url('tool/cut_image', false);
        $img_url = './images/admin/add_pic.gif';
		$img_url = $value;
        //栏目图片上传
        $res = "<a title=\"选择文件\" onclick=\"javascript:windowsdig('选择文件','iframe:index.php?case=file&act=updialog&fileinputid={$name}&getbyid={$name}_preview&max=1&checkfrom=picshow','900px','480px','iframe')\" href=\"#body\"><p><span id=\"{$name}_preview\"><img src=\"$img_url\" style=\"width:150px;\" /></span></p></a>
          <div class=\"blank10\"></div> <div class=\"row\"><div class=\"col-xs-8 col-sm-8 col-md-9 col-lg-10 text-right\"><input name=\"$name\"  id=\"$name\" value=\"$value\"  class=\"form-control\" />" .
            '</div><div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 text-left"><input value=" 删除 " class="btn btn-primary" title="删除" id="' . $name . '_del" onclick="pics_delete(\'\',\'' . $name . '\');document.getElementById(\'' . $name . '_preview\').innerHTML=\'<img src=\\\'images/admin/add_pic.gif\\\' width=\\\'150\\\'>\';" value="删除" type="button" name="delbutton" class="btn btn-primary" /></div></div>';
        return $res;
    }

    static function upload_imagemui($name, $value)
    {
        //栏目图片上传
        $res = "地址：<input name=\"$name\"  id=\"$name\" value=\"$value\"  class=\"form-control\" />";
        $img_url = './images/admin/add_pic.gif';
        if (front::$act == 'edit' && $value) {
            $img_url = $value;
        }
        $res .= "<div class=\"blank10\"></div>
	<a title=\"选择文件\" onclick=\"javascript:windowsdig('选择文件','iframe:index.php?case=file&act=updialog&fileinputid={$name}&getbyid={$name}_preview&max=1&checkfrom=picshow','900px','480px','iframe')\" href=\"#body\"><p><img src=\"{$img_url}\" id=\"{$name}_preview\"/></p></a>";
        $res .= '</div>';
        return $res;
    }

    static function upload_image3($name, $value)
    {
        $res = "<div class=\"blank10\"></div><span id=\"{$name}_preview\"></span>
	<br>
	地址：<input name=\"$name\"  id=\"$name\" value=\"$value\" size=\"50\"/>";
        if (front::$act == 'edit' && $value) {
            $res .= "<script>image_preview('$name','$value');</script>
	";
        }
        $res .= "<br>
	上传：<input type=\"file\" name=\"{$name}_upload\" id=\"{$name}_upload\" style=\"width:400px\" onchange=\"image_preview('$name',this.value,1)\"/>
	&nbsp;&nbsp;<input type=\"button\" name=\"{$name}upload\"  id=\"{$name}upload\" onclick=\"return ajaxFileUpload('{$name}_upload','" . url('tool/upload3/site/' . front::get('site'),
                false) . "','#{$name}_loading');\" value=\"上传\" class=\"btn btn-primary\" />
		<img id=\"{$name}_loading\" src=\"" . front::$view->base_url . "/common/js/loading.gif\" style=\"display:none;\">";
        return $res;
    }

    static function upload_image1($name, $value)
    {
        $res = "<div class=\"blank10\"></div><span id=\"{$name}_preview\"></span>
	<br>
	地址：<input name=\"$name\"  id=\"$name\" value=\"$value\" size=\"50\"/>";
        if (front::$act == 'edit' && $value) {
            $res .= "<script>image_preview('$name','$value');</script>
	更改：";
        }
        $res .= "<br>
	上传：<input type=\"file\" name=\"{$name}_upload\" id=\"{$name}_upload\" style=\"width:400px\" onchange=\"image_preview('$name',this.value,1)\"/>
	&nbsp;&nbsp;<input type=\"button\" name=\"{$name}upload\"  id=\"{$name}upload\" onclick=\"return ajaxFileUpload('{$name}_upload','" . url('tool/upload1/site/' . front::get('site'),
                false) . "','#{$name}_loading');\" value=\"上传\" class=\"btn btn-primary\" />
		<img id=\"{$name}_loading\" src=\"" . front::$view->base_url . "/common/js/loading.gif\" style=\"display:none;\">";
        return $res;
    }

    static function getuploadhtml($i, $name, $purl, $value)
    {
        $cname = $name;
        $name = $name . $i;
        $res = '<div id="' . $name . '_up"><span id="' . $name . '_preview"></span><br><br>地址：<input name="' . $name . '" id="' . $name . '" value="' . $value . '" size="50"/> <input type="button" id="' . $name . '_del" class=\"btn btn-primary\" name="delbutton" value="删除" onclick="pics_delete(' . $i . ',\'' . $cname . '\');" style="display:;"><br><br>';
        $res .= "<script>image_preview('{$name}','$value');</script>更改：";
        $res .= '<input type="file" name="' . $name . '_upload" id="' . $name . '_upload" style="width:400px" onchange="image_preview(\'' . $name . '\',this.value,1)"/>&nbsp;&nbsp;<input type="button" name="' . $name . 'upload" id="' . $name . 'upload' . $i . '" onclick="return ajaxFileUpload2(\'' . $name . '_upload\',\'' . $purl . '\',\'#' . $cname . '_loading\');" value="上传" class="btn btn-primary" /></div>';
        return $res;
    }

   

    static function upload_image2($name, $value)
    {
        $res = "<div id=\"uploadarea\">";
        if (front::$act == 'edit' && $value) {
            $pics = unserialize($value);
            $i = -1;
            if (is_array($pics) && !empty($pics)) {
                foreach ($pics as $k => $v) {
                    $i++;
                    $res .= form::getuploadhtml($k, 'pics', url('tool/upload2/site/' . front::get('site'), false), $v);
                }
                $i++;
            }
            $res .= form::getuploadhtml(++$i, 'pics', url('tool/upload2/site/' . front::get('site'), false), '');
        } else {
            $res .= "<div id=\"pics0_up\"><span id=\"{$name}0_preview\"></span><input name=\"{$name}0\"  id=\"{$name}0\" value=\"$value\"  class=\"form-control\" /> <input type=\"button\" id=\"{$name}0_del\" name=\"delbutton\" value=\"删除\" onclick=\"pics_delete('0','{$name}');\" class=\"btn btn-primary\" style=\"display:none;\">";
            $res .= "<input type=\"file\" name=\"{$name}0_upload\" id=\"{$name}0_upload\" style=\"width:400px\" onchange=\"image_preview('{$name}0',this.value,1)\"/>
<div class=\"blank10\"></div>
<input type=\"button\" name=\"{$name}0upload\"  id=\"{$name}0upload\" onclick=\"return ajaxFileUpload2('{$name}0_upload','" . url('tool/upload2/site/' . front::get('site'), false) . "','#{$name}0_loading','{$name}');\" value=\"上传\" class=\"btn btn-primary\" /></div>";
        }
        $res .= "</div>";
        return $res;
    }

    static function upload_file($name, $value)
    {
        $res = "<div class=\"blank10\"></div><span id=\"{$name}_info\"></span>
	<input name=\"$name\"  id=\"$name\" value=\"$value\" class=\"form-control\" />";
        $res .= "<br><br>
	<input type=\"file\" name=\"{$name}_upload\" id=\"{$name}_upload\" style=\"width:400px\" />
	<div class=\"blank10\"></div>
<input type=\"button\" name=\"{$name}upload\"  id=\"{$name}upload\" onclick=\"return ajaxFileUpload('{$name}_upload','" . url('tool/upload_file/site/' . front::get('site'), false) . "','#{$name}_loading');\" value=\"上传\" class=\"btn btn-primary\" />
		<img id=\"{$name}_loading\" src=\"" . front::$view->base_url . "/common/js/loading.gif\" style=\"display:none;\">";
        return $res;
    }

    static function editor($name, $value = '')
    {
        $fckeditor = new fckeditor($name);
        $fckeditor->Value = $value;
        /*if(preg_match('/^my_/is', $name)){
            $fckeditor->ToolbarSet = "MyForm";
        }*/
        return $fckeditor->CreateHtml() . "
		<br>
	<a href=\"javascript:;\" class=\"fckeditor_height_add_sub\" onclick=\"javascript:heightAdd('$name');\">+</a>
	<a href=\"javascript:;\" class=\"fckeditor_height_add_sub\" onclick=\"javascript:heightSub('$name');\">-</a>
                ";
    }

    static function ueditor($name, $value = '')
    {
        $root = config::get('base_url') . '/ueditor';
        $str = <<< EOT
    <script id="$name" name="$name" type="text/plain">$value</script>
    <script type="text/javascript">
	window.UEDITOR_HOME_URL = "{$root}/";
	$(function(){
        var ue_$name = UE.getEditor('$name',{
            autoHeightEnabled : false
        });
	});
    </script>
EOT;
        return $str;
    }

    static function arraytoselect($array)
    {
        $res = '';
        if (is_array($array) && !empty($array))
            foreach ($array as $key => $value) $res .= "($key)$value ";
        return $res;
    }

    static function yesornotoarray($str)
    {
        return array(1 => $str, 0 => '不' . $str);
    }
}
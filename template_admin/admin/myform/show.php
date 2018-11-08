<div class="table-responsive">
<table class="table table-hover">
<thead>
<tr class="th">
            <th class="s_out">字段名称</th>
                <th class="catname">内容</th>

            </tr>
            </thead>
        <tbody>
{user_cb_data($data,$table)}
            {loop $field $f}
                <?php
$type = setting::$var[front::$get['table']][$f['name']]['filetype'];
                $name=$f['name'];
				$aid = $data['aid'];
                if(!preg_match('/^my_/',$name)) continue;

                if(!isset($data[$name])) $data[$name]='';
                ?>

            <tr>
                <td class="s_out" align="center">{$name|lang}</td>
                <td class="catname" align="center">{if $type=='file'}<a href="{$data[$name]}" target="_blank">下载附件</a>{elseif $type=='image'}<img src='{$data[$name]}' width="200"> {else}{$data[$name]}{/if}</td>
		
            </tr>

            {/loop}
        


        </tbody></table>

		</div>

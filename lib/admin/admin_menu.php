<?php

if (!defined('ROOT'))
    exit('Can\'t Access !');
include_once('version.php');

class admin_menu
{
    static $menu = array();

    static function get()
    {
        if (front::get('mod')) {
            $mod = front::get('mod');
            session::set('mod', $mod);
        }
        if (front::get('act')) {
            $act = front::get('act');
            session::set('act', $act);
        }
        if (front::get('table')) {
            $table = front::get('table');
            session::set('table', $table);
        }
        if (front::get('set')) {
            $set = front::get('set');
            session::set('set', $set);
        }
        if (front::get('tagfrom')) {
            $tagfrom = front::get('tagfrom');
            session::set('tagfrom', $tagfrom);
        }

        if (front::get('item')) {
            $item = front::get('item');
            session::set('item', $item);
        }
        $mod = session::get('mod');
        switch ($mod) {
            case 'system':
                $menu = self::fetch('网站设置,数据库管理,数据维护');
                break;
            case 'config':
                $menu = self::fetch('网站设置,多站点设置');
                break;
            case 'content':
                $menu = self::fetch('栏目管理,内容管理,分类管理,专题管理');
                break;
            case 'cache':
                $menu = self::fetch('生成管理,手机版生成');
                break;
            case 'order':
                $menu = self::fetch('订单管理');
                break;
            case 'user':
                $menu = self::fetch('用户管理,用户组管理,推广联盟');
                break;
            case 'func':
                $menu = self::fetch('公告管理,留言评论,投票管理,数据管理,文件防护,网站安全');
                break;
            case 'defined':
                $menu = self::fetch('自定义字段,自定义表单');
                break;
            case 'help':
                $menu = self::fetch('模板管理,添加标签,标签列表');
                break;
            case 'seo':
                $menu = self::fetch('微信公众号,内容链接管理,友情链接管理,邮件管理');
                break;
            case 'map':
                $menu = self::fetch('网站设置,数据库管理,数据维护,内容管理,生成管理,栏目管理,分类管理,专题管理,幻灯片管理,用户管理,用户组管理,公告管理,自定义字段,自定义表单,订单管理,留言管理,专题管理,评论管理,投票管理,数据备份,批量替换,模板管理,添加标签,标签列表,内容链接管理,推广联盟,友情链接管理,邮件管理,内容链接管理,推广联盟,友情链接管理,系统管理,客服中心,账号管理,生成代码');
                break;
            default:
                $menu = self::fetch('常用操作');
                break;
        }

        if (empty($menu)) {
            return;
        }
        $menu = array_merge($menu, self::$menu);
        if (front::get('mod')) {
            foreach ($menu as $menu_1) {
                foreach ($menu_1 as $menu_2) {
                    if ($menu_2)
                        break;
                }
                if ($menu_2)
                    break;
            }
            front::redirect($menu_2);
        }
        return $menu;
    }



    static function fetch($string)
    {
        $names = explode(',', $string);
        $allmenu = self::allmenu();
        $menus = array();
        foreach ($names as $key) {
            $menus[$key] = $allmenu[$key];
        }
        //var_dump($menus);
        return $menus;
    }

    static function allmenu()
    {
        return $menu = array(

            '设置' => array(
                '网站配置' => url::create('config/system/set/site'),
                '水印设置' => url::create('config/system/set/image'),
                '附件设置' => url::create('config/system/set/upload'),
                '字符过滤' => url::create('config/system/set/security'),
                '邮件发送' => url::create('config/system/set/mail'),
                '投票设置' => url::create('config/system/set/vote'),
                '热门标签' => url::create('config/hottag'),
                '语言包编辑' => url::create('language/edit'),
                '短信设置' => url::create('config/system/set/sms'),
                '地图设置' => url::create('config/system/set/ditu'),
                '站点列表' => url::create('website/listwebsite'),
            ),

            '内容' => array(
				'栏目管理' => url::create('table/list/table/category'),
                '分类管理' => url::create('table/list/table/type'),
                '专题管理' => url::create('table/list/table/special'),
                '内容管理' => url::create('table/list/table/archive'),
                '批量导入' => url::create('table/import/table/archive'),
                'URL规则' => url::create('table/htmlrule/table/category'),
                '推荐位' => url::create('table/setting/table/archive'),
                '热搜关键词' => url::create('index/hotsearch'),
                '图片库' => url::create('image/listdir'),
                '标签管理' => url::create('table/list/table/tag'),
            ),

            '用户' => array(
                '用户管理' => url::create('table/list/table/user'),
                '用户组管理' => url::create('table/list/table/usergroup'),
                '登录扩展' => url::create('ologin/list/table/ologin'),
                '邀请码' => url::create('invite/list'),
            ),


            '订单' => array(
                '订单列表' => url::create('table/list/table/orders'),
                '支付配置' => url::create('pay/list/table/pay'),
                '配货配置' => url::create('logistics/list/table/logistics'),
            ),

            '功能' => array(
                '公告管理' => url::create('table/list/table/announcement'),
                '留言管理' => url::create('table/list/table/guestbook'),
                '评论管理' => url::create('table/list/table/comment'),
                '投票管理' => url::create('table/list/table/ballot'),
                '数据管理' => url::create('database/baker'),
                '安全防护' => url::create('filecheck/filecheck/action/file_check'),
                '检测更新' => url::create('update/index'),
            ),


            '模板' => array(
                '选择模板' => url::create('config/system/set/template'),
                '模板结构标注' => url::create('template/note'),
                '查看模板源码' => url::create('template/edit'),
                '在线模板' => url::create('template/downlist'),
                '幻灯' => url::create('config/system/set/slide'),
                '内容标签' => url::create('table/list/table/templatetag/tagfrom/content'),
                '栏目标签' => url::create('table/list/table/templatetag/tagfrom/category'),
                '自定义标签' => url::create('table/list/table/templatetag/tagfrom/define'),
                '手机内容标签' => url::create('table/list/table/templatetagwap/tagfrom/content'),
                '手机栏目标签' => url::create('table/list/table/templatetagwap/tagfrom/category'),
                '手机自定义标签' => url::create('table/list/table/templatetagwap/tagfrom/define'),

            ),

            '营销' => array(
                '公众号管理' => url::create('weixin/list'),
                '蜘蛛统计' => url::create('stats/list/table/stats'),
                '内链管理' => url::create('table/list/table/linkword'),
                '友链管理' => url::create('table/list/table/friendlink'),
                '推广联盟' => url::create('union/config/table/union'),
                '发送邮件' => url::create('table/send/table/user'),
                '熊掌号推送' => url::create('xiongzhang/index'),
            ),

            '自定义' => array(
                '内容字段' => url::create('field/list/table/archive'),
                '用户字段' => url::create('field/list/table/user'),
				'管理表单' => url::create('form/listform'),
            ),

        );
    }
}
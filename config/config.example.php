<?php if (!defined('ROOT')) exit('Can\'t Access !'); return array (

'website'=>array(
'name'=>'站点名称',//站点名称
'ftpip'=>'127.0.0.1',//站点FTP地址
'ftpport'=>'21',//站点FTP端口
'ftpuser'=>'user',//站点FTP用户
'ftppwd'=>'password',//站点FTP密码
'ftppath'=>'/',//站点FTP目录
),

'database'=>array(
'hostname'=>'127.0.0.1',//MySQL服务器(localhost默认不修改！)
'user'=>'user',//用户名
'password'=>'password',//密码
'database'=>'data',//数据库
'prefix'=>'cmseasy_',//表前缀
'encoding'=>'utf8',//编码
),

'cookie_password'=>'9fa5e18d441c5c0f59c14bec163a9335', //Cookie安全码
    
'install_admin'=>'admin',


//site-站点信息{
'site_url'=>'http://example.cmseasy.com/', //网站地址[http://起始并以 / 结束]
'site_username'=>'admin', //管理员名字
'site_password'=>'admin', //管理员密码
'site_admindir'=>'admin', //后台目录
'sitename'=>'NobCms Content management system', //网站名称
'fullname'=>'NobCms free content management system', //网站全称
'site_icp'=>'icp no.102030560', //ICP备案号
'site_keyword'=>'company,free website,NOBCMS',//网站关键字
'site_description'=>'NobCms free',//网站描述
'version'=>'V20100808',
'logo_width'=>'324',//logo宽度[单位(px)]
'site_logo'=>'images/logo.gif',//网站logo=>image
'onerror_pic'=>'images/nopic.gif',//列表页默认图片=>image
'site_right'=>'NobCms all rights reveserd.', //网站版权
'lang_type'=>'en', //语言设置=>cn/中文/en/英文/jp/日文/de/德文/user/自定义
//}


//site-后台目录{
'admin_dir'=>'admin', //后台地址
//}

//site-动静态{
'list_page_php'=>'0', //栏目页=>0/按指定/1/静态/2/动态
'show_page_php'=>'0', //内容页=>0/按指定/1/静态/2/动态
'html_prefix'=>'', //静态页面存放路径[为空或以/开头]
'group_on'=>'1', //生成分组=>0/关/1/开
'group_count'=>'5',//每组生成个数
//}


//site-列表缓存{
'list_cache'=>'0', //列表缓存=>0/关/1/开
'list_cache_time'=>'3600', //缓存时间[单位(秒)]
//}

//site-分页{
'manage_pagesize'=>'20',//后台分页数量
'list_pagesize'=>'20',//前台分页数量
//}

//site-搜索{
'maxhotkeywordnum'=>'1',//搜索基数[热门关键词获取条件，大于基数的为热门关键词]
//}



//archive-文章系统{
'archive_introducelen'=>'200',//内容系统简介自动截取长度
//}


//security-字符过滤{
'filter_word'=>'陈水', //过滤字符[多个请用“,”隔开]
'filter_x'=>'(*该人已被收押*)', //替代字符
//}

//site-缩略图{
'thumb_width'=>'140',//宽度[单位(px)]
'thumb_height'=>'120',//高度[单位(px)]
//}

//site-开关设置{
'verifycode'=>'0', //验证码开关=>0/关/1/开
'reg_on'=>'1', //注册开关=>0/关/1/开
'isdebug'=>'0', //调试开关=>0/关/1/开
'opguestadd'=>'1', //游客投稿开关[游客发布地址：http://域名/?g=1]=>0/关/1/开
//}


//image-图片水印{
'watermark_open'=>'1', //水印开关=>0/关/1/开
'watermark_min_width'=>'300',//最小宽度[不满足条件不添加水印]
'watermark_min_height'=>'300',//最小高度[不满足条件不添加水印]
'watermark_path'=>'/images/logo.gif',//水印路径[支持jpg、gif、png格式]
'watermark_ts'=>'80',//透明度[范围为 1~100 的整数，数值越小水印图片越透明]
'watermark_qs'=>'90',//JPEG图片质量[范围为 0~100 的整数，数值越大结果图片效果越好]
'watermark_pos'=>'5',//添加位置[请在此选择水印添加的位置(3x3 共9个位置可选)]=>1/1/2/2/3/3/4/4/5/5/6/6/7/7/8/8/9/9
//}

//upload-附件设置{
'upload_filetype'=>'jpg,gif,bmp,jpeg,png,doc,zip,rar', //附件类型
'upload_max_filesize'=>'2', //附件大小[单位(MB)]
'mods'=>'celive',
//}

//template-模板设置{
'template_dir'=>'default', //前台模板选择[默认default]
'admin_template_dir'=>'admin',  //后台模板目录[默认admin]
//}

//ballot-投票设置{
'checkip'=>'1', //验证IP=>0/关/1/开
'timer'=>'60',  //时间间隔[单位:分钟]
//}

//enlarge-网站客服信息{
'ifonserver'=>'1', //开启前台客服=>1/开启/0/关闭
'boxopen'=>'1', //默认展开客服列表=>1/开启/0/关闭
'liveboxtip'=>'1', //弹出邀请对话框=>1/开启/0/关闭
'serverlistp'=>'left', //客服浮动框位置=>left/左边/right/右边
'address'=>'九州易通科技有限公司',//联系地址
'tel'=>'010-87740230',//联系电话
'mobile'=>'13278127757',//移动电话
'fax'=>'010-87740230',//传真
'email'=>'cmseasy@163.com',//email
'postcode'=>'136000',//邮政编码
'qq1'=>'871148347', //站长QQ
'qq2'=>'871148347', //售前QQ
'qq3'=>'871148347', //售后QQ
'qq4'=>'871148347', //售后QQ
'qq5'=>'871148347', //售后QQ
'wangwang'=>'mymoban', //阿里旺旺
'skype'=>'cmseasy', //Skype
'msn'=>'cmseasy@live.cn', //Msn

//}

//mail-邮件设置{
	
'send_type'=>'2', //邮件发送方式=>0/请选择/1/PHP函数sendmail发送(推荐)/2/SOCKET连接SMTP服务器发送(支持ESMTP验证)/3/PHP函数SMTP发送Email(仅Windows主机有效,不支持ESMTP验证)
'header_var'=>'0', //邮件头的分隔符=>99/请选择/1/CRLF分隔符(Windows)/0/LF分隔符(Unix|Linux)/2/CR分隔符(Mac)
'kill_error'=>'1', //屏蔽错误提示=>0/否/1/是
//}


//mail-SOCKET连接SMTP服务器发送(支持ESMTP验证){
	
'smtp_host'=>'smtp.163.com', //SMTP服务器
'smtp_port'=>'25', //SMTP端口
'smtp_auth'=>'1', //要求身份验证=>0/否/1/是
'smtp_user_add'=>'CmsEasy <x-x03@163.com>', //发信人地址
'smtp_mail_username'=>'x-x03@163.com', //用户名
'smtp_mail_password'=>'65696381520', //密码
//}

//mail-PHP函数SMTP发送Email(仅Windows主机下有效,不支持ESMTP验证){
	
'smtp_host'=>'smtp.163.com', //SMTP服务器
'smtp_port'=>'25', //SMTP端口
//}


//slide-幻灯片设置{
'slide_width'=>'1000', //幻灯宽度
'slide_height'=>'156', //幻灯高度
'slide_number'=>'5', //幻灯片数量<5
'slide_pic1'=>'images/slide/banner01.jpg', //图片1地址=>image
'slide_pic1_title'=>'CmsEasy3.0助力企业网络营销', //图片1标题
'slide_pic1_url'=>'http://www.cmseasy.cn', //图片1链接地址
'slide_pic2'=>'images/slide/banner02.jpg', //图片2地址=>image
'slide_pic2_title'=>'海量精美CmsEasy模板免费下载', //图片2标题
'slide_pic2_url'=>'http://www.cmseasy.cn', //图片2链接地址
'slide_pic3'=>'images/slide/banner03.jpg', //图片3地址=>image
'slide_pic3_title'=>'免费下载CmsEasy,还有机会获取商业授权', //图片3标题
'slide_pic3_url'=>'http://www.cmseasy.cn', //图片3链接地址
'slide_pic4'=>'images/slide/banner04.jpg', //图片4地址=>image
'slide_pic4_title'=>'欢迎网建公司及工作室参与CmsEasy官方分享计划', //图片4标题
'slide_pic4_url'=>'http://www.cmseasy.cn', //图片4链接地址
'slide_pic5'=>'upload/images/201009/12846196415378.jpg', //图片5地址=>image
'slide_pic5_title'=>'CmsEasy服务/售后/程序多重升级', //图片5标题
'slide_pic5_url'=>'http://www.cmseasy.cn', //图片5链接地址
//}

//cnzz-cnzz统计配置{
'cnzz_user'=>'80628840', //验证码A[自动生成,请牢记,每域名只赠送一个全景帐号!]
'cnzz_pass'=>'9453147585', //验证码B[自动生成,请牢记,每域名只赠送一个全景帐号!]
//}
);


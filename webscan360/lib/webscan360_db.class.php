<?php
class Webscan360_db
{
	/**
	 * var
	 */
	private $dbconfig = '';
	private $webscan_table = 'webscan360';
	public $tablename = '';
	private $simpledb='';
	/**
	 * 构造函数
	 *
	 * @param array $db
	 */
	public  function __construct(){
		define("WEBSCAN360" , true);
		$db = include(dirname(dirname(__FILE__)).'/webscan360_config.php');
		if(empty($db)||!is_array($db)){
			//exit("no db config");
		}
		if(empty($db['DB_HOST'])){
			//exit('no db host');
		}
		if(empty($db['DB_USER'])){
			//exit('no db username');
		}
		if(empty($db['DB_PWD'])){
			//exit('no db password');
		}
		if(empty($db['DB_NAME'])){
			//exit('no database');
		}
		if(!empty($db) && !empty($db['DB_HOST']) && !empty($db['DB_USER']) && !empty($db['DB_PWD'])&& !empty($db['DB_NAME'])&& $db['DB_USER'] !="数据库用户名" && $db['DB_PWD'] !="数据库密码"&& $db['DB_NAME'] !="数据库名称"){
			$smodel = new SimpleDB($db);
			$this->simpledb = $smodel;
			$tablename = $db['DB_PREFIX'].$this->webscan_table;
			$this->tablename = $tablename;
			$this->createWebscan360DB();
		}
	}
	private function createWebscan360DB(){
		if(empty($this->tablename)) return;
		$res_tableexist = $this->simpledb->query("SHOW TABLES LIKE '" .$this->tablename. "'");
		if(empty($res_tableexist)){
			$this->simpledb->query("CREATE TABLE `".$this->tablename."` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `var` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  `ext1` varchar(100) DEFAULT NULL,
  `ext2` varchar(100) DEFAULT NULL,
  `state` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=175 DEFAULT CHARSET=utf8");
		}		
	}
	public  function rec_update($row , $where){
		if(empty($this->tablename)) return;
		if(!empty($row) && !empty($where)){
			
	        $sqlud='';
            foreach ($row as $key=>$value) {
        		$key = $this->simpledb->escape_string($key);
        		$value = $this->simpledb->escape_string($value);                
                $sqlud .= "`$key`"."= '".$value."',";
            }
	        $sqlud=rtrim($sqlud);
	        $sqlud=rtrim($sqlud,',');
	        $where = $this->webscandb_condtion($where);
	        $sql="UPDATE `".$this->tablename."` SET ".$sqlud." WHERE ".$where;
			return $this->simpledb->execute($sql);
		}
	}
	public  function rec_getRow($where){
		if(empty($this->tablename)) return;
		if(!empty($where)){
	        $where = $this->webscandb_condtion($where);
	        $sql = "SELECT * FROM " . $this->tablename . " where " . $where;
	        $ret = $this->simpledb->query($sql);
			return $ret[0];
		}   	
	}
	private function webscandb_condtion($where){
		if(!empty($where)){
			$where_str = '';
			$i = 0;
			foreach ($where as $key=>$value){
				$i++;
				$key = $this->simpledb->escape_string($key);
        		$value = $this->simpledb->escape_string($value);
        		if($i == 1){
        			$where_str .= "`$key`='$value'";
        		}else{
					$where_str .= " and `$key`='$value'";
        		}
			}
			return  $where_str;
		}
	}
	public  function rec_insert($row){
		if(empty($this->tablename)) return;
		if(!empty($row)){
	        $sqlfield='';
	        $sqlvalue='';
	        foreach ($row as $key=>$value) {
        		$key = $this->simpledb->escape_string($key);
        		$value = $this->simpledb->escape_string($value);
                $sqlfield .= "`".$key."`,";
                $sqlvalue .= "'".$value."',";
	        }
	        $sql = "INSERT INTO `".$this->tablename."`(".substr($sqlfield,0,-1).") VALUES (".substr($sqlvalue,0,-1).")";
	        return $this->simpledb->execute($sql);
		}
		
	}	
}
class SimpleDB
{

    static private $_instance	= null;
    // 是否显示调试信息 如果启用会在日志文件记录sql语句
    public $debug				= false;
    // 是否使用永久连接
    protected $pconnect         = false;
    // 当前SQL指令
    protected $queryStr			= '';
    // 最后插入ID
    protected $lastInsID		= null;
    // 返回或者影响记录数
    protected $numRows			= 0;
    // 返回字段数
    protected $numCols			= 0;
    // 事务指令数
    protected $transTimes		= 0;
    // 错误信息
    protected $error			= '';
    // 当前连接ID
    protected $linkID			=   null;
    // 当前查询ID
    protected $queryID			= null;
    // 是否已经连接数据库
    protected $connected		= false;
    // 数据库连接参数配置
    protected $config			= '';
    // SQL 执行时间记录
    protected $beginTime;
    /**
     +----------------------------------------------------------
     * 架构函数
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param array $config 数据库配置数组
     +----------------------------------------------------------
     */
    public function __construct($config=''){
        if ( !extension_loaded('mysql') ) {
            echo('not support mysql');
        }
        $this->config   =   $this->parseConfig($config);
    }

    /**
     +----------------------------------------------------------
     * 连接数据库方法
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function connect() {
        if(!$this->connected) {
            $config =   $this->config;
            // 处理不带端口号的socket连接情况
            $host = $config['hostname'].($config['hostport']?":{$config['hostport']}":'');
            if($this->pconnect) {
                $this->linkID = mysql_pconnect( $host, $config['username'], $config['password']);
            }else{
                $this->linkID = mysql_connect( $host, $config['username'], $config['password'],true);
            }
            if ( !$this->linkID || (!empty($config['database']) && !mysql_select_db($config['database'], $this->linkID)) ) {
                //echo(mysql_error());
            }
            $dbVersion = mysql_get_server_info($this->linkID);
            if ($dbVersion >= "4.1") {
                //使用UTF8存取数据库 需要mysql 4.1.0以上支持
                mysql_query("SET NAMES 'UTF8'", $this->linkID);
            }
            //设置 sql_model
            if($dbVersion >'5.0.1'){
                mysql_query("SET sql_mode=''",$this->linkID);
            }
            // 标记连接成功
            $this->connected    =   true;
            // 注销数据库连接配置信息
            unset($this->config);
        }
    }

    /**
     +----------------------------------------------------------
     * 释放查询结果
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     */
    public function free() {
        mysql_free_result($this->queryID);
        $this->queryID = 0;
    }

    /**
     +----------------------------------------------------------
     * 执行查询 主要针对 SELECT, SHOW 等指令
     * 返回数据集
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $str  sql指令
     +----------------------------------------------------------
     * @return mixed
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function query($str='') {
        $this->connect();
        if ( !$this->linkID ) return false;
        if ( $str != '' ) $this->queryStr = $str;
        //释放前次的查询结果
        if ( $this->queryID ) {    $this->free();    }
        $this->Q(1);
        $this->queryID = mysql_query($this->queryStr, $this->linkID);
        //$this->debug();
        if ( !$this->queryID ) {
                return false;
        } else {
            $this->numRows = mysql_num_rows($this->queryID);
            return $this->getAll();
        }
    }

    /**
     +----------------------------------------------------------
     * 执行语句 针对 INSERT, UPDATE 以及DELETE
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $str  sql指令
     +----------------------------------------------------------
     * @return integer
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function execute($str='') {
        $this->connect();
        if ( !$this->linkID ) return false;
        if ( $str != '' ) $this->queryStr = $str;
        //释放前次的查询结果
        if ( $this->queryID ) {    $this->free();    }
        $this->W(1);
        $result =   mysql_query($this->queryStr, $this->linkID) ;
       // $this->debug();
        if ( false === $result) {
            return false;
        } else {
            $this->numRows = mysql_affected_rows($this->linkID);
            $this->lastInsID = mysql_insert_id($this->linkID);
            return $this->numRows;
        }
    }


    /**
     +----------------------------------------------------------
     * 获得所有的查询数据
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return array
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function getAll() {
        if ( !$this->queryID ) {
            //echo($this->error());
            return false;
        }
        //返回数据集
        $result = array();
        if($this->numRows >0) {
            while($row = mysql_fetch_assoc($this->queryID)){
                $result[]   =   $row;
            }
            mysql_data_seek($this->queryID,0);
        }
        return $result;
    }

    /**
     +----------------------------------------------------------
     * 关闭数据库
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @throws ThinkExecption
     +----------------------------------------------------------
     */
    public function close() {
        if (!empty($this->queryID))
            mysql_free_result($this->queryID);
        if ($this->linkID && !mysql_close($this->linkID)){
            echo($this->error());
        }
        $this->linkID = 0;
    }

    /**
     +----------------------------------------------------------
     * 数据库错误信息
     * 并显示当前的SQL语句
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    public function error() {
        $this->error = mysql_error($this->linkID);
        if($this->queryStr!=''){
            $this->error .= "\n [ SQL语句 ] : ".$this->queryStr;
        }
        return $this->error;
    }

    /**
     +----------------------------------------------------------
     * SQL指令安全过滤
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param string $str  SQL字符串
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    public function escape_string($str) {
        return mysql_escape_string($str);
    }

   /**
     +----------------------------------------------------------
     * 析构方法
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     */
    public function __destruct()
    {
        // 关闭连接
        $this->close();
    }

    /**
     +----------------------------------------------------------
     * 取得数据库类实例
     +----------------------------------------------------------
     * @static
     * @access public
     +----------------------------------------------------------
     * @return mixed 返回数据库驱动类
     +----------------------------------------------------------
     */
    public static function getInstance($db_config='')
    {
		if ( self::$_instance==null ){
			self::$_instance = new Db($db_config);
		}
		return self::$_instance;
    }

    /**
     +----------------------------------------------------------
     * 分析数据库配置信息，支持数组和DSN
     +----------------------------------------------------------
     * @access private
     +----------------------------------------------------------
     * @param mixed $db_config 数据库配置信息
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    private function parseConfig($_db_config='') {
		// 如果配置为空，读取配置文件设置
		$db_config = array (
			'dbms'		=>   $_db_config['DB_TYPE'],
			'username'	=>   $_db_config['DB_USER'],
			'password'	=>   $_db_config['DB_PWD'],
			'hostname'	=>   $_db_config['DB_HOST'],
			'hostport'	=>   $_db_config['DB_PORT'],
			'database'	=>   $_db_config['DB_NAME'],
			'dsn'		=>   $_db_config['DB_DSN'],
			'params'	=>   $_db_config['DB_PARAMS'],
		);
        return $db_config;
    }

    /**
     +----------------------------------------------------------
     * 数据库调试 记录当前SQL
     +----------------------------------------------------------
     * @access protected
     +----------------------------------------------------------
     */
    protected function debug() {
        // 记录操作结束时间
        if ( $this->debug )    {
            $runtime    =   number_format(microtime(TRUE) - $this->beginTime, 6);
            Log::record(" RunTime:".$runtime."s SQL = ".$this->queryStr,Log::SQL);
        }
    }

    /**
     +----------------------------------------------------------
     * 查询次数更新或者查询
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param mixed $times
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     */
    public function Q($times='') {
        static $_times = 0;
        if(empty($times)) {
            return $_times;
        }else{
            $_times++;
            // 记录开始执行时间
            $this->beginTime = microtime(TRUE);
        }
    }

    /**
     +----------------------------------------------------------
     * 写入次数更新或者查询
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @param mixed $times
     +----------------------------------------------------------
     * @return void
     +----------------------------------------------------------
     */
    public function W($times='') {
        static $_times = 0;
        if(empty($times)) {
            return $_times;
        }else{
            $_times++;
            // 记录开始执行时间
            $this->beginTime = microtime(TRUE);
        }
    }

    /**
     +----------------------------------------------------------
     * 获取最近一次查询的sql语句
     +----------------------------------------------------------
     * @access public
     +----------------------------------------------------------
     * @return string
     +----------------------------------------------------------
     */
    public function getLastSql() {
        return $this->queryStr;
    }

}//类定义结束
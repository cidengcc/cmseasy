<?php

if (!defined('ROOT')) exit('Can\'t Access !');
function FCKeditor_IsCompatibleBrowser() {
    if ( isset( $_SERVER ) ) {
        $sAgent = $_SERVER['HTTP_USER_AGENT'] ;
    }
    else {
        global $HTTP_SERVER_VARS ;
        if ( isset( $HTTP_SERVER_VARS ) ) {
            $sAgent = $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ;
        }
        else {
            global $HTTP_USER_AGENT ;
            $sAgent = $HTTP_USER_AGENT ;
        }
    }
    if ( strpos($sAgent,'MSIE') !== false &&strpos($sAgent,'mac') === false &&strpos($sAgent,'Opera') === false ) {
        $iVersion = (float)substr($sAgent,strpos($sAgent,'MSIE') +5,3) ;
        return ($iVersion >= 5.5) ;
    }
    else if ( strpos($sAgent,'Gecko/') !== false ) {
        $iVersion = (int)substr($sAgent,strpos($sAgent,'Gecko/') +6,8) ;
        return ($iVersion >= 20030210) ;
    }
    else if ( strpos($sAgent,'Opera/') !== false ) {
        $fVersion = (float)substr($sAgent,strpos($sAgent,'Opera/') +6,4) ;
        return ($fVersion >= 9.5) ;
    }
    else if ( preg_match( "|AppleWebKit/(\d+)|i",$sAgent,$matches ) ) {
        $iVersion = $matches[1] ;
        return ( $matches[1] >= 522 ) ;
    }
    else
        return false ;
}
class fckeditor {
    public $InstanceName ;
    public $BasePath ;
    public $Width ;
    public $Height ;
    public $ToolbarSet ;
    public $Value ;
    public $Config ;
    public function __construct( $instanceName ) {
        $this->InstanceName	= $instanceName ;
        $this->BasePath		=config::get('base_url').'/editor/';
        $this->Width		= '98%';
        $this->Height		= '300';
        $this->ToolbarSet	= 'Default';
        $this->Value		= '';
        $this->Config		= array(
                'SkinPath'=>config::get('base_url').'/editor/editor/skins/silver/',
                'UserFilesPath'=>config::get('base_url').'/upload/',
                ) ;
    }
    static function userpath() {
        $base_url=config::get('base_url');
        $base_url=preg_replace('%\Weditor\W.*%','',$base_url);
        return $base_url.'/upload/archive/image/';
    }
    public function Create() {
        echo $this->CreateHtml() ;
    }
    public function CreateHtml() {
        $HtmlValue = htmlspecialchars( $this->Value ) ;
        $Html = '';
        if ( $this->IsCompatible() ) {
            if ( isset( $_GET['fcksource'] ) &&$_GET['fcksource'] == "true")
                $File = 'editor.original.html';
            else
                $File = 'editor.html';
            $Link = "{$this->BasePath}editor/{$File}?InstanceName={$this->InstanceName}";
            if ( $this->ToolbarSet != '')
                $Link .= "&amp;Toolbar={$this->ToolbarSet}";
            $Html .= "<input type=\"hidden\" id=\"{$this->InstanceName}\" name=\"{$this->InstanceName}\" value=\"{$HtmlValue}\" style=\"display:none\" />";
            $Html .= "<input type=\"hidden\" id=\"{$this->InstanceName}___Config\" value=\"".$this->GetConfigFieldString() ."\" style=\"display:none\" />";
            $Html .= "<iframe id=\"{$this->InstanceName}___Frame\" src=\"{$Link}\" width=\"{$this->Width}\" height=\"{$this->Height}\" frameborder=\"0\" scrolling=\"no\"></iframe>";
        }
        else {
            if ( strpos( $this->Width,'%') === false )
                $WidthCSS = $this->Width .'px';
            else
                $WidthCSS = $this->Width ;
            if ( strpos( $this->Height,'%') === false )
                $HeightCSS = $this->Height .'px';
            else
                $HeightCSS = $this->Height ;
            $Html .= "<textarea name=\"{$this->InstanceName}\" rows=\"4\" cols=\"40\" style=\"width: {$WidthCSS}; height: {$HeightCSS}\">{$HtmlValue}</textarea>";
        }
        return $Html ;
    }
    public function IsCompatible() {
        return FCKeditor_IsCompatibleBrowser() ;
    }
    public function GetConfigFieldString() {
        $sParams = '';
        $bFirst = true ;
        foreach ( $this->Config as $sKey =>$sValue ) {
            if ( $bFirst == false )
                $sParams .= '&amp;';
            else
                $bFirst = false ;
            if ( $sValue === true )
                $sParams .= $this->EncodeConfig( $sKey ) .'=true';
            else if ( $sValue === false )
                $sParams .= $this->EncodeConfig( $sKey ) .'=false';
            else
                $sParams .= $this->EncodeConfig( $sKey ) .'='.$this->EncodeConfig( $sValue ) ;
        }
        return $sParams ;
    }
    public function EncodeConfig( $valueToEncode ) {
        $chars = array(
                '&'=>'%26',
                '='=>'%3D',
                '"'=>'%22') ;
        return strtr( $valueToEncode,$chars ) ;
    }
}
<?php
/**
*  
*/
/**
* 
*/

class software 
{
    public $id;
    public $name;
    public $note;
    public $time_upload;
    function __construct($id, $name, $note, $time_upload)
    {
        $this->id = $id;
        $this->name = $name;
        $this->note = $note;
        $this->time_upload = $time_upload;
    }
}
// 本文档自动生成，仅供测试运行
class IndexAction extends Action
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
    public function checkClientIE() {
    $agent = $_SERVER['HTTP_USER_AGENT'];
    if (eregi("MSIE",$agent))
    {
      return true;
    }
    return false;
  }
  public function checkUTF8($str) {
    $cod = mb_check_encoding($str,"UTF-8");
    if("UTF-8" != $cod ||  empty($cod))
    {
      $str = mb_convert_encoding( $str,'utf-8','gb2312'); 
    }
    return $str;
  }
  public function checkWindows() {
    if(eregi('WIN',PHP_OS))
    {
      return true;
    }
    return false;
  }
  public function checkGB2312($str) {
    $cod = mb_check_encoding($str,"GB2312");
    if("GB2312" != $cod ||  empty($cod))
    {
      $str = mb_convert_encoding( $str,'GB2312','UTF-8'); 
    }
    return $str;
  }
    public function index()
    {
        $this->assign('company', C('COMPANY_SIGN'));
        $this->display();
        // $this->display(THINK_PATH.'/Tpl/Autoindex/hello.html');
    }
    public function tree()
    {
        echo "[
    {id: \"base1\", text: \"软件目录\", expanded: true},
    {id: \"logiTechSoftwares\", text: \"实验箱实验\", url: \"/index.php/Index/logiTechSoftwares\", target:\"_blank\", pid:\"base1\"},
    {id: \"jichu\", text: \"基础环境下载\", url: \"/index.php/Index/base_softwares_html\", target:\"_blank\", pid:\"base1\"}
]";
        // $this->display();
    }
    public function overview()
    {
        $this->display();
    }
    public function logiTechSoftwares()
    {
        $this->display();
    }
    public function software_list()
    {
        $result = array();
        $MCheck =new Model();
        $sqlCheck = "select FILE_ID, FILE_NAME, UPLOAD_DATE, NOTE from T__FILE where FLAG = 'app' order by UPLOAD_DATE desc";
        $checkResult = $MCheck->query($sqlCheck);
        if (count($checkResult) > 0) {

          for($i = 0; $i< count($checkResult); $i++)
          {
            $row = $checkResult[$i];
            $s1 = new software($row['FILE_ID'], $row['FILE_NAME'], $row['NOTE'], $row['UPLOAD_DATE']);
            array_push($result, $s1);
          }
          
        }
        $foo_json = json_encode($result);
        echo $foo_json;
    }
    public function download_software()
    {
        $fileName = $_GET['id'];
        $fileName = $this->checkUTF8($fileName);
        Log::Write("download_software -> fileName = ".$fileName);
        //echo $tmpType;
        //return;
        $file_name_save = $fileName;
        if($this->checkWindows())
        {
        //如果服务器是windows操作系统
            $file_name_save = $this->checkGB2312($file_name_save);
        }
        Log::Write("download_software -> file_name_save = ".$file_name_save);

        if(!empty($fileName))
        {
            $path = C('TEMPLATE_FILE_PATH').$file_name_save;
            
            if(!empty($path) and !is_null($path))
            {
                
                Log::Write("download_software -> path = ".$path);
                if(file_exists($path))
                {
                    $http_path = 'http://'.$_SERVER['HTTP_HOST'].'/'.$path;
                    $http_path = $this->checkUTF8($http_path);
                    echo($http_path);
                    exit;
                }
                else
                {
                    echo("fail");
                }           
            }
            else
            {
                echo($filename." 文件不存在,正在跳转 ...！");
            }
        }
    }
    public function base_softwares_list()
    {
        $result = array();
        $MCheck =new Model();
        $sqlCheck = "select FILE_ID, FILE_NAME, UPLOAD_DATE, NOTE from T__FILE where FLAG = 'base' order by UPLOAD_DATE desc";
        $checkResult = $MCheck->query($sqlCheck);
        if (count($checkResult) > 0) {

          for($i = 0; $i< count($checkResult); $i++)
          {
            $row = $checkResult[$i];
            $s1 = new software($row['FILE_ID'], $row['FILE_NAME'], $row['NOTE'], $row['UPLOAD_DATE']);
            array_push($result, $s1);
          }
          
        }
        $foo_json = json_encode($result);
        echo $foo_json;
    }
    public function base_softwares_html()
    {
        $this->display();
    }
    /**
    +----------------------------------------------------------
    * 探针模式
    +----------------------------------------------------------
    */
    public function checkEnv()
    {
        load('pointer',THINK_PATH.'/Tpl/Autoindex');//载入探针函数
        $env_table = check_env();//根据当前函数获取当前环境
        echo $env_table;
    }

}
?>
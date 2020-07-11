<meta charset="utf-8">

<?php 
/**

* 读取excel $filename 路径文件名 $encode 返回数据的编码 默认为utf8

*
*/ 
$path = './1.xls';//设置移动路径 


include './PHPExcel/Classes/PHPExcel.php';
include './PHPExcel/Classes/PHPExcel/IOFactory.php';//静态类
function excelImport($file) {
        $PHPExcel = new PHPExcel();
        
        $PHPReader = new PHPExcel_Reader_Excel2007();
        if (!$PHPReader->canRead($file)) {
            $PHPReader = new PHPExcel_Reader_Excel5();
            if (!$PHPReader->canRead($file)){
                return false;
            }
        }
        
        $E = $PHPReader->load($file);
        $cur = $E->getSheet();  // 读取第一个表
        $end = $cur->getHighestColumn(); // 获得最大的列数
        $line = $cur->getHighestRow(); // 获得最大总行数
        // 获取数据数组
        $info = array();
        //修复bug  如果列数的数值大于2位  也就是AB  AD等等  目前默认到AZ排序   如果大于AZ请重新邓毅数组
        //判断列数是否大于Z
        if (strlen($end) > 1) {
          $getnums['AA'] = 91;
          $getnums['AB'] = 92;
          $getnums['AC'] = 93;
          $getnums['AD'] = 94;
          $getnums['AE'] = 95;
          $getnums['AF'] = 96;
          $getnums['AG'] = 97;
          $getnums['AH'] = 98;
          $getnums['AI'] = 99;
          $getnums['AG'] = 100;
          $getnums['AK'] = 101;
          $getnums['AL'] = 102;
          $getnums['AM'] = 103;
          $getnums['AN'] = 104;
          $getnums['AO'] = 105;
          $getnums['AP'] = 106;
          $getnums['AQ'] = 107;
          $getnums['AR'] = 108;
          $getnums['AS'] = 109;
          $getnums['AT'] = 110;
          $getnums['AU'] = 111;
          $getnums['AV'] = 112;
          $getnums['AW'] = 113;
          $getnums['AX'] = 114;
          $getnums['AY'] = 115;
          $getnums['AZ'] = 116; 
          $Column = $getnums[$end];         
        }else{
           $Column = ord($end);//总列数的ASCII值
         }       
        for ($row = 1; $row <= $line; $row ++) {
            for ($c = 0; $c <= $Column - 65; $c++) {              
                $val = $cur->getCellByColumnAndRow($c, $row)->getValue();
                $info[$row][] = $val;
            }
        }
        
        return $info;
       
    }

  $data = excelImport($path); 
  echo "<pre>";
  print_r($data);
  echo "</pre>";

/*
*以下是导入数据库的示例代码
foreach($data as $v){
    $valueStr .= "(".$v['id'].",'".$v['name']."'),";
} 

$valueStr = rtrim($valueStr,',');
$insertSql = "INSERT into `td_list`(id,name) values $valueStr";
mysql_query($insertSql);
*/

 ?>

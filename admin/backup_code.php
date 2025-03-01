<?php 
ob_start();
session_start();
// if user not login this page not asscess 
if(!isset($_SESSION['user_id'])){
  header('location:index.php');
  exit();
}

$host = "localhost:3307";
$user = "root";
$password ='';
$db= "hospital_management_system";
$tables = array();

$folder_name = "System_backup_file/";

backup($host,$user,$password,$db,$tables,$folder_name); 
// using function 
function backup($host,$user,$password,$db, $table=false, $file_name=false,$folder_name = "System_backup_file"){
    $conn = mysqli_connect($host,$user,$password,$db);
    // check connection
  if(mysqli_connect_errno()){
    echo "failed to connect to  mysql: " . mysqli_connect_error();
    exit();
  }
  mysqli_query($conn,"SET NAMES 'utf8'");
  // get all of table 
  $query_Tables = mysqli_query($conn,'SHOW TABLES');
  while($row = mysqli_fetch_row($query_Tables)){
    $tables[] =$row[0];
  }
$tables = is_array($tables) ? $tables : explode(',',$tables);
$return = '';

// 
foreach($tables as $table){
    $result = mysqli_query($conn,'SELECT * FROM ' . $table);
    $num_fileds = mysqli_num_fields($result);
    $num_rows = mysqli_num_rows($result);

     // drop command
    $return.= 'DROP TABLE IF EXISTS ' . $table.';';
    $row2 = mysqli_fetch_row(mysqli_query($conn,'SHOW CREATE TABLE '.$table)); 
    $return.= "\n\n".$row2[1].";\n\n";

   
    // insert command
      while($row = mysqli_fetch_row($result)) {
    
    $return .= 'INSERT INTO'.$table.' VALUES(';
  
  // fileds 
  for($i=0;$i<$num_fileds;$i++) {
$row[$i] = addslashes($row[$i]);

    $return.='"' .$row[$i] .'"'; 
    if($i<( $num_fileds-1)){
        $return .=',';
    }
}
  
$return.=");\n"; 
}
$return .="\n\n";
      }
      if(!file_exists($folder_name)){
        mkdir($folder_name, 0777, true);// create folder 

      }

      // file save 
      $backup_file = $folder_name.'/backup_system' .time(). '-'.(md5(implode(',',$tables))).'.sql';
      $handle = fopen($backup_file, 'w');
      fwrite($handle,$return);
      if(fclose($handle)){
        echo "Backup File save successful:".$backup_file;
        exit();
      }
    }
    ob_end_flush();


?>



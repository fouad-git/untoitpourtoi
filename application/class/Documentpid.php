<?php
    namespace App;

    
use \PDO;

 class Documentpid
 {
     public function docPid()
     {
         $phpFileUploadErrors = array(
                     0 => 'There is no error, the file uploaded with success',
                     1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
                     2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
                     3 => 'The uploaded file was only partially uploaded',
                     4 => 'No file was uploaded',
                     6 => 'Missing a temporary folder', 
                     7 => 'Failed to write file to disk',
                     8 => 'A PHP extension stopped the file upload.');
         
                     
                     if(isset($_FILES['piddocument'])){
                         $file_array = reArrayFiles($_FILES['piddocument']);
                         for ($i=0; $i<count($file_array); $i++) {
                             if ($file_array[$i]['error']){
                                 echo '<div class= "alert alert-success">';
                                 echo $file_array[$i]['name'].' - '.$phpFileUploadErrors[$file_array[$i]['error']];
                                 echo "</div>";
                         }
                         else{
                             $extension = array('jpg', 'png' , 'gif', 'jpeg');
                             $file_ext = explode('.',$file_array[$i]['name']);
                             $file_ext = end($file_ext);
                             $name = $file_ext[0];
                             $name = preg_match("!-!"," ",$name);
                             $name = ucwords($name);
                             if(!in_array($file_ext, $extensions))
                             {
                                 echo '<div class="alert alert-danger">';
                                 echo "{$file_array[$i]['name']} - Invalid file extension!";
                                 echo "</div>";
                                 
                             }
                             else{
                                 $img_dir = '../public/assets/img/pid/' . $file_array[$i]['name'];
                                 move_uploaded_file($file_array[$i]['tmp_name'], $img_dir);
                                 
                                 echo '<div class="alert alert-success">';
                                 echo $file_array[$i]['name'].' - '.$phpFileUploadErrors[$file_array[$i]['error']];
                             }
                         }
                     }
                 }

     }
     
                public function reArrayFiles ($file_post)
                 { 
                     $file_ary = array();
                     $file_count = count($file_post['name']);
                     $file_keys = array_keys($file_post);
     
                     for($i=0; $i<$file_count; $i++){
                         foreach ($file_keys as $key) {
                             $file_ary[$i][$key] = $file_post[$key][$i];
                         }
                     }
                     return $file_ary;
                 }
 }
 ?>
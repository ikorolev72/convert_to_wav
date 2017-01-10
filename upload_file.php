<?php
   if(isset($_FILES['upload_file'])){
      $errors= array();
      $file_name = $_FILES['upload_file']['name'];
      $file_size =$_FILES['upload_file']['size'];
      $file_tmp =$_FILES['upload_file']['tmp_name'];
      $file_type=$_FILES['upload_file']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['upload_file']['name'])));
      
      $expensions= array("3gp", "aa", "aac", "aax", "act", "aiff", "amr", "ape", "au", "awb", "dct", "dss", "dvf", "flac", "gsm", "iklax", "ivs", "m4a", "m4b", "m4p", "mmf", "mp3", "mpc", "msv", "ogg", "oga", "opus", "ra", "rm", "raw", "sln", "tta", "vox", "wav", "wma", "wv", "webm");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose an audio file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"upload_files/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
   }
?>
<html>
   <body>
      
      <form action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="upload_file" />
         <input type="submit"/>
      </form>
      
   </body>
</html>
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
		 $output_file="upload_files/".$file_name;
		 $converted_file="converted_files/".pathinfo ( $output_file , PATHINFO_FILENAME ).".wav";
		 $converted_file_url="/$converted_file";
		 // $converted_file_url="http://localhost:8080/$converted_file";
		 
         move_uploaded_file($file_tmp, $output_file );
         echo "File uploaded success<br>";
		 
		 $output=array();
		 $return_var=1;
		 $command="/usr/bin/sox $output_file -b 16 $converted_file recital.wav channels 1 rate 8k";
		 
		 exec ( $command, $output, $return_var );
		 if( $return_var!=0 ) {
			echo "File converted: <a href='$converted_file_url'> $converted_file_url </a><br>";				
		 } else {
			echo "File converting error:<br>";				
			foreach($output as $value)
			{
			echo "$value<br>";
			}			 			 
		 }
		 
      } else{
			foreach($errors as $value)
			{
			echo "<font color=red>$value</font><br>";
			}			 			 
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
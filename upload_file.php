<?php
	// require libsox-fmt-mp3 lib for support mp3 files
	$upload_dir="/home/osboxes/convert_to_wav/upload_files";
	$convert_dir="/home/osboxes/convert_to_wav/converted_files";
	$convert_base_url="/converted_files"; // or absolute http://localhost:8080/converted_files
	
   if(isset($_FILES['upload_file'])){
      $errors= array();
      $file_name = $_FILES['upload_file']['name'];
      $file_size =$_FILES['upload_file']['size'];
      $file_tmp =$_FILES['upload_file']['tmp_name'];
      $file_type=$_FILES['upload_file']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['upload_file']['name'])));
      
      $expensions= array("3gp", "aa", "aac", "aax", "act", "aiff", "amr", "ape", "au", "awb", "dct", "dss", "dvf", "flac", "gsm", "iklax", "ivs", "m4a", "m4b", "m4p", "mmf", "mp3", "mpc", "msv", "ogg", "oga", "opus", "ra", "rm", "raw", "sln", "tta", "vox", "wav", "wma", "wv", "webm");
	  $sox_extensions= array ( "8svx", "aif", "aifc", "aiff", "aiffc", "al", "amb", "amr-nb", "amr-wb", "anb", "au", "avr", "awb", "caf", "cdda", "cdr", "cvs", "cvsd", "cvu", "dat", "dvms", "f32", "f4", "f64", "f8", "fap", "flac", "fssd", "gsm", "gsrt", "hcom", "htk", "ima", "ircam", "la", "lpc", "lpc10", "lu", "mat", "mat4", "mat5", "maud", "mp2", "mp3", "nist", "ogg", "paf", "prc", "pvf", "raw", "s1", "s16", "s2", "s24", "s3", "s32", "s4", "s8", "sb", "sd2", "sds", "sf", "sl", "sln", "smp", "snd", "sndfile", "sndr", "sndt", "sou", "sox", "sph", "sw", "txw", "u1", "u16", "u2", "u24", "u3", "u32", "u4", "u8", "ub", "ul", "uw", "vms", "voc", "vorbis", "vox", "w64", "wav", "wavpcm", "wv", "wve", "xa", "xi"); 
	  $ffmpeg_extensions=array ( );
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose an audio file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
        echo "File uploaded success<br>";

		 $output_file="$upload_dir/$file_name";
		 $path_parts = pathinfo( $output_file );
		// echo $path_parts['dirname'], "\n";
		// echo $path_parts['basename'], "\n";
		// echo $path_parts['extension'], "\n";
		// echo $path_parts['filename'], "\n"; 
		 		 
		 $converted_file="$convert_dir/".$path_parts['filename'].".wav";
		 $converted_file_url="$convert_base_url/".$path_parts['filename'].".wav";
		 
         move_uploaded_file( $file_tmp, $output_file );

		 $output=array();
		 $return_var=1;
		 
		 if( $path_parts['extension'] == 'aac' ) {
			 
		 }
		 
		 
		 $command="/usr/bin/sox $output_file -b 16 $converted_file channels 1 rate 8k 2>&1";
		 echo "$command<br>";
		 
		 exec ( $command, $output, $return_var );
		 if( $return_var==0 ) {
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
      <hr>
      <form action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="upload_file" /><br>
         <input type="submit"/><br>
      </form>
      
   </body>
</html>
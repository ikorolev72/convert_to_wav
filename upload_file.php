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
      
      $expensions= array( "vag","gxf","msf","avr","wav","w64","aac","ac3","eac3","nut","sox","rso","cgi","flv","y4m","mpc","oga","ogv","spx","opus","aqt","str","rsd","mtaf","sub","dtshd","y4m","svag","sub","v210","yuv10","shn","pvf","flac","bmv","dv","ogg","mlp","thd","wtv","swf","g729","rso","srt","ast","chk","mxf","mxf","mkv","webm","mka","nut","sdr2","acm","ac3","adx","cavs","dts","eac3","g722","gsm","h261","h263","m4v","mlp","m2v","thd","vc1","aix","amr","sub","oma","lbc","lvf","v","xmv","voc","yop","stl","ivf","sbg","mov","3gp","mp4","3g2","f4v","spdif","mvi","ffm","adx","avs","sup","flac","flv","avi","fsb","rt","aea","rsd","tta","dts","musx","flm","viv","wsd","roq","302","wv","idx","tak","ast","avi","xvag","pjs","m3u8","cdata","ivr","webp","au","genh","vpk","lrc","flm","str","caf","vtt","adf","idf","ffmeta","aa","brstm","gsm","vtt","rcv","mp3","mxg","cdg","mmf","afc","nut","sln","vob","vob","dvd","tta","vb","son","aif","aiff","afc","aifc","sf","ircam","ads","ss2","jss","js","paf","fap","latm","loas","yuv","cif","qcif","rgb","mov","mp4","m4a","3gp","3g2","mj2","adp","dtk","ans","art","asc","diz","ice","nfo","txt","vt","tco","rco","g723_1","drc","vc2","dnxhd","dnxhr","tco","rco","h264","264","hevc","h265","265","mpg","mpeg","m1v","yuv","rgb","cdxl","xl","dv","dif","vqf","vql","vqe","nist","sph","mp4","psp","m4v","m4a","ismv","isma","ts","m2t","m2ts","mts","g722","722","mp2","mp3","m2a","mpa","ass","ssa","669","amf","ams","dbm","digi","dmf","dsm","far","gdm","imf","it","j2b","m15","mdl","med","mmcmp","mms","mo3","mod","mptm","mt2","mtm","nst","okt","plm","ppm","psm","pt36","ptm","s3m","sfx","sfx2","stk","stm","ult","umx","wow","xm","xpk","ape","apl","mac","aac","adts","smi","sami","sf","ircam","mpl2","mkv","mk3d","mka","mks","oma","omg","aa3","302","daud","rm","ra","asf","wmv","wma","asf","wmv","wma","bmp","dpx","jls","pam","pbm","pcx","pgm","pgmyuv","bfstm","bcstm","mp2","m2a","mpa","a64"," A64","mpg","mpeg","8svx", "aif", "aifc", "aiff", "aiffc", "al", "amb", "amr-nb", "amr-wb", "anb", "au", "avr", "awb", "caf", "cdda", "cdr", "cvs", "cvsd", "cvu", "dat", "dvms", "f32", "f4", "f64", "f8", "fap", "flac", "fssd", "gsm", "gsrt", "hcom", "htk", "ima", "ircam", "la", "lpc", "lpc10", "lu", "mat", "mat4", "mat5", "maud", "mp2", "mp3", "nist", "ogg", "paf", "prc", "pvf", "raw", "s1", "s16", "s2", "s24", "s3", "s32", "s4", "s8", "sb", "sd2", "sds", "sf", "sl", "sln", "smp", "snd", "sndfile", "sndr", "sndt", "sou", "sox", "sph", "sw", "txw", "u1", "u16", "u2", "u24", "u3", "u32", "u4", "u8", "ub", "ul", "uw", "vms", "voc", "vorbis", "vox", "w64", "wav", "wavpcm", "wv", "wve", "xa", "xi"  );
      // $ffmpeg_sox_expensions= array( "vag","gxf","msf","avr","wav","w64","aac","ac3","eac3","nut","nut","sox","rso","cgi","flv","flv","y4m","mjpg","mpc","oga","ogv","spx","opus","aqt","str","rsd","mtaf","sub","dtshd","y4m","svag","sub","v210","yuv10","shn","pvf","flac","bmv","dv","ogg","mlp","thd","wtv","swf","g729","xml","rso","srt","ast","chk","mxf","mxf","mkv","webm","mka","nut","sdr2","txt","acm","ac3","adx","cavs","dts","eac3","g722","gsm","h261","h263","m4v","mlp","m2v","thd","vc1","aix","amr","sub","oma","lbc","lvf","mjpg","v","xmv","ico","voc","yop","stl","ivf","sbg","mov","3gp","mp4","3g2","f4v","spdif","bit","bit","mvi","ffm","adx","avs","gif","sup","flac","mjpg","flv","avi","fsb","rt","aea","rsd","tta","dts","musx","flm","viv","wsd","roq","302","apng","wv","idx","tak","ast","avi","xvag","pjs","m3u8","cdata","ivr","webp","au","genh","vpk","sub","lrc","flm","str","caf","vtt","bin","adf","idf","ffmeta","aa","brstm","gsm","vtt","rcv","mp3","mxg","cdg","mmf","afc","nut","sln","vob","vob","dvd","tta","vb","son","aif","aiff","afc","aifc","sf","ircam","ads","ss2","jss","js","paf","fap","latm","loas","yuv","cif","qcif","rgb","mov","mp4","m4a","3gp","3g2","mj2","adp","dtk","ans","art","asc","diz","ice","nfo","txt","vt","tco","rco","g723_1","drc","vc2","dnxhd","dnxhr","tco","rco","h264","264","hevc","h265","265","mjpg","mjpeg","mpg","mpeg","m1v","yuv","rgb","cdxl","xl","dv","dif","vqf","vql","vqe","nist","sph","mp4","psp","m4v","m4a","ismv","isma","ts","m2t","m2ts","mts","g722","722","mp2","mp3","m2a","mpa","ass","ssa","669","amf","ams","dbm","digi","dmf","dsm","far","gdm","imf","it","j2b","m15","mdl","med","mmcmp","mms","mo3","mod","mptm","mt2","mtm","nst","okt","plm","ppm","psm","pt36","ptm","s3m","sfx","sfx2","stk","stm","ult","umx","wow","xm","xpk","ape","apl","mac","aac","adts","smi","sami","sf","ircam","txt","mpl2","mkv","mk3d","mka","mks","oma","omg","aa3","302","daud","rm","ra","asf","wmv","wma","asf","wmv","wma","bmp","dpx","jls","jpeg","jpg","ljpg","pam","pbm","pcx","pgm","pgmyuv","png","","bfstm","bcstm","mp2","m2a","mpa","a64"," A64","mpg","mpeg","8svx", "aif", "aifc", "aiff", "aiffc", "al", "amb", "amr-nb", "amr-wb", "anb", "au", "avr", "awb", "caf", "cdda", "cdr", "cvs", "cvsd", "cvu", "dat", "dvms", "f32", "f4", "f64", "f8", "fap", "flac", "fssd", "gsm", "gsrt", "hcom", "htk", "ima", "ircam", "la", "lpc", "lpc10", "lu", "mat", "mat4", "mat5", "maud", "mp2", "mp3", "nist", "ogg", "paf", "prc", "pvf", "raw", "s1", "s16", "s2", "s24", "s3", "s32", "s4", "s8", "sb", "sd2", "sds", "sf", "sl", "sln", "smp", "snd", "sndfile", "sndr", "sndt", "sou", "sox", "sph", "sw", "txw", "u1", "u16", "u2", "u24", "u3", "u32", "u4", "u8", "ub", "ul", "uw", "vms", "voc", "vorbis", "vox", "w64", "wav", "wavpcm", "wv", "wve", "xa", "xi"  );
	  // $sox_extensions= array ( "8svx", "aif", "aifc", "aiff", "aiffc", "al", "amb", "amr-nb", "amr-wb", "anb", "au", "avr", "awb", "caf", "cdda", "cdr", "cvs", "cvsd", "cvu", "dat", "dvms", "f32", "f4", "f64", "f8", "fap", "flac", "fssd", "gsm", "gsrt", "hcom", "htk", "ima", "ircam", "la", "lpc", "lpc10", "lu", "mat", "mat4", "mat5", "maud", "mp2", "mp3", "nist", "ogg", "paf", "prc", "pvf", "raw", "s1", "s16", "s2", "s24", "s3", "s32", "s4", "s8", "sb", "sd2", "sds", "sf", "sl", "sln", "smp", "snd", "sndfile", "sndr", "sndt", "sou", "sox", "sph", "sw", "txw", "u1", "u16", "u2", "u24", "u3", "u32", "u4", "u8", "ub", "ul", "uw", "vms", "voc", "vorbis", "vox", "w64", "wav", "wavpcm", "wv", "wve", "xa", "xi"); 
	  // $ffmpeg_extensions=array ( "vag","gxf","msf","avr","wav","w64","aac","ac3","eac3","nut","nut","sox","rso","cgi","flv","flv","y4m","mjpg","mpc","oga","ogv","spx","opus","aqt","str","rsd","mtaf","sub","dtshd","y4m","svag","sub","v210","yuv10","shn","pvf","flac","bmv","dv","ogg","mlp","thd","wtv","swf","g729","xml","rso","srt","ast","chk","mxf","mxf","mkv","webm","mka","nut","sdr2","txt","acm","ac3","adx","cavs","dts","eac3","g722","gsm","h261","h263","m4v","mlp","m2v","thd","vc1","aix","amr","sub","oma","lbc","lvf","mjpg","v","xmv","ico","voc","yop","stl","ivf","sbg","mov","3gp","mp4","3g2","f4v","spdif","bit","bit","mvi","ffm","adx","avs","gif","sup","flac","mjpg","flv","avi","fsb","rt","aea","rsd","tta","dts","musx","flm","viv","wsd","roq","302","apng","wv","idx","tak","ast","avi","xvag","pjs","m3u8","cdata","ivr","webp","au","genh","vpk","sub","lrc","flm","str","caf","vtt","bin","adf","idf","ffmeta","aa","brstm","gsm","vtt","rcv","mp3","mxg","cdg","mmf","afc","nut","sln","vob","vob","dvd","tta","vb","son","aif","aiff","afc","aifc","sf","ircam","ads","ss2","jss","js","paf","fap","latm","loas","yuv","cif","qcif","rgb","mov","mp4","m4a","3gp","3g2","mj2","adp","dtk","ans","art","asc","diz","ice","nfo","txt","vt","tco","rco","g723_1","drc","vc2","dnxhd","dnxhr","tco","rco","h264","264","hevc","h265","265","mjpg","mjpeg","mpg","mpeg","m1v","yuv","rgb","cdxl","xl","dv","dif","vqf","vql","vqe","nist","sph","mp4","psp","m4v","m4a","ismv","isma","ts","m2t","m2ts","mts","g722","722","mp2","mp3","m2a","mpa","ass","ssa","669","amf","ams","dbm","digi","dmf","dsm","far","gdm","imf","it","j2b","m15","mdl","med","mmcmp","mms","mo3","mod","mptm","mt2","mtm","nst","okt","plm","ppm","psm","pt36","ptm","s3m","sfx","sfx2","stk","stm","ult","umx","wow","xm","xpk","ape","apl","mac","aac","adts","smi","sami","sf","ircam","txt","mpl2","mkv","mk3d","mka","mks","oma","omg","aa3","302","daud","rm","ra","asf","wmv","wma","asf","wmv","wma","bmp","dpx","jls","jpeg","jpg","ljpg","pam","pbm","pcx","pgm","pgmyuv","png","","bfstm","bcstm","mp2","m2a","mpa","a64"," A64","mpg","mpeg" );
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose an audio file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
        echo "File uploaded success<br>";

		 $output_file="$upload_dir/$file_name";
         move_uploaded_file( $file_tmp, $output_file );
		 
		 $path_parts = pathinfo( $output_file );
		// echo $path_parts['dirname'], "\n";
		// echo $path_parts['basename'], "\n";
		// echo $path_parts['extension'], "\n";
		// echo $path_parts['filename'], "\n"; 
		 		 
		 $converted_file="$convert_dir/".$path_parts['filename'].".wav";
		 $converted_file_url="$convert_base_url/".$path_parts['filename'].".wav";
		 

		 $output=array();
		 $return_var=1; 
		 
		 $command="/tmp/bin/converiting2wav.sh $output_file  $converted_file 2>&1";
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
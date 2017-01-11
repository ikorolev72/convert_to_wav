#   simple audio converter

##  What is it?
Web interface for audio converter. Convert almost any audio and video files to wav with 
"bit resolution: 16bit", "sampling rate: 8000 Hz", "audio channels: mono"	

##  The Latest Version

	version 1.0 2017.01.11


### 		How to install
	+	install ffmpeg and sox software ( eg ```# apt-get -y install ffmpeg sox``` )
	+	Extract archive to your web site root ( eg ```# cd /var/www/html/mysite; tar xf /tmp/convert_to_wav.tar``` )


Files in archive:
```
convert_to_wav/
convert_to_wav/converted_files
convert_to_wav/upload_files
convert_to_wav/upload_file.php
convert_to_wav/converiting2wav.sh
```

### 		How to run
	Check values in php.ini:
	```
	file_uploads = 1 
	upload_max_filesize = 2M
	```
Open page with any browser http://mysite_ip/convert_to_wav/upload_file.php


## Known bugs

 
  Licensing
  ---------
	GNU

  Contacts
  --------

     o korolev-ia [at] yandex.ru
     o http://www.unixpin.com

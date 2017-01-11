#!/bin/bash
# korolev-ia [at] yandex.ru
# version 1.0 2017.01.11

DEBUG=1
SILENCE=1
LOG=/tmp/converting2wav.log


echos() {
	if [ "x$SILENCE" != "x" ]; then
		echo "$@"
	fi	
	return 0
}


w2log() {
	DATE=`date +%Y-%m-%d_%H:%M:%S`
	echo "$DATE $@" >> $LOG
	echos "$@" 1>&2
	return 0
}

showhelp() {
	echos "Convert audio files to wav with:"
	echos "bit resolution: 16bit"
	echos "sampling rate: 8000 Hz"
	echos "audio channels: mono"		
	echos "Usage:"
	echos "$0 /dir_in/file_in /dir_out/file_out.wav"
	return 0
}

if [ "x$DEBUG" == "x" ]; then
	LOG=/dev/null
fi

FILE_IN=$1
FILE_OUT=$2

[ "x$FILE_IN" = "x" ] && showhelp && exit 1
[ "x$FILE_OUT" = "x" ] && showhelp && exit 1
[ ! -f "$FILE_IN" ] && w2log "file $FILE_IN do not exist" && exit 1

echos "Converting file $FILE_IN to $FILE_OUT"

FF_AUDIO_STREAM_0_EXIST=`ffprobe -v error -select_streams a:0 -show_entries stream=index -of default=nokey=1:noprint_wrappers=1 $FILE_IN 2>/dev/null`
if [ "x$FF_AUDIO_STREAM_0_EXIST" != "x" ]; then
	# try ffmpeg convert
	/usr/bin/ffmpeg -loglevel warning -y -i $FILE_IN -vn -filter_complex "aformat=sample_fmts=s16:channel_layouts=mono,aresample=8192" -map a $FILE_OUT >> $LOG 2>&1
	
	if [ "x$?" == "x0" ]; then
		echos "File converted"
		exit 0
	fi
		w2log "Cannot converting this file to wav"
fi

# try converting with sox

/usr/bin/sox $FILE_IN -b 16 $FILE_OUT channels 1 rate 8k >> $LOG 2>&1 


	if [ "x$?" != "x0" ]; then
		w2log "Cannot converting this file to wav"
		exit 1
	fi

echos "File converted"
exit 0



<html>
<head>
<title>jwplayer test</title>

<script type="text/javascript" src="jwplayer.js"></script>
</head>

<body>

<pre>
<?php
	echo 'removing old flv...<br/>';
	system('rm test.flv 2>&1');

	echo 'killing ffmpeg...<br/>';
	system('killall -9 ffmpeg 2>&1');
	system('killall -9 flvtool2 2>&1');
	system('killall -9 ffmpeg 2>&1');
	system('killall -9 flvtool2 2>&1');

	echo 'starting transcoding...<br/>';
//	$PID = shell_exec("nohup ffmpeg -i rickroll.mp4 -ar 22050 -ab 32000 -f flv -s 320x240 test.flv | flvtool2 -U stdin test.flv 2> /tmp/mehe > /tmp/meh & echo $!");
	$PID = shell_exec("nohup ffmpeg -i rickroll.mp4 -ar 22050 -ab 32000 -f flv -s 320x240 test.flv 2> /tmp/mehe > /tmp/meh & echo $!");

	echo 'created pid: '.  $PID;

	system('ps -ux');
?>
</pre>

<div id="container"> Loading the player... </div>

<script type="text/javascript">
jwplayer("container").setup({
    'flashplayer': 'player.swf',
    'file': './getvideo.php?v=23749287492',
    'provider': 'video',
    'bufferlength': '5',
    'autostart': 'true',
    'controlbar': 'bottom',
    'width': '470',
    'height': '320'
});
</script>


<?php
?>

</body>
</html>

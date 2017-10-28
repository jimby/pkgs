<html>
<head>
<title>Javascript Popup</title>
<SCRIPT TYPE='text/javascript'>
function popup(width,height){
	if(window.innerWidth){
	LeftPosition =(window.innerWidth-width)/2;
	TopPosition =((window.innerHeight-height)/4)-50;
			}
	else{
	LeftPosition =(parseInt(window.screen.width)-	width)/2;
	TopPosition=((parseInt(window.screen.height)-height)/2)-50;
			}
	attr = 'resizable=no,scrollbars=yes,width=' + width + ',height=' +
	height + ',screenX=300,screenY=200,left=' + LeftPosition + ',top=' +
	TopPosition + '';
	popWin=open('', 'new_window', attr);
	popWin.document.write('<head><title>Test Popup</title></head>');
	popWin.document.write('<body><div align=center>');
	popWin.document.write('<b>This is a test popup window</b><br><br>');
  	popWin.document.write('crapola<br>');
	popWin.document.write('Content goes here<br>');
	popWin.document.write('Content goes here<br>');
  	popWin.document.write('</div></body></html>');
	}

</SCRIPT>
</head>
<body>
<a href="javascript:popup(400,200);">Generate popup</a>
</body>
</html>


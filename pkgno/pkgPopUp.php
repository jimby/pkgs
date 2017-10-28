
<!DOCTYPE html>
<head>
<title>Huckhuck snerd &amp; CSS3</title>
<style>
	.modalWindow {
		position: fixed;
		font-family: arial;
		font-size:80%;
		top: 0;
		right: 0;
		bottom: 0;
		left: 0;
		background: rgba(0,0,0,0.2);
		z-index: 99999;
		opacity:0;
		-webkit-transition: opacity 400ms ease-in;
		-moz-transition: opacity 400ms ease-in;
		transition: opacity 400ms ease-in;
		pointer-events: none;
	}
	.modalHeader h2 { color: #189CDA; border-bottom: 2px groove #efefef; }
	.modalWindow:target {
		opacity:1;
		pointer-events: auto;
	}
	.modalWindow > div {
		width: 500px;
		position: relative;
		margin: 10% auto;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		background: #fff;
	}
	.modalWindow .modalHeader  {	padding: 5px 20px 0px 20px;	}
	.modalWindow .modalContent {	padding: 0px 20px 5px 20px;	}
	.modalWindow .modalFooter  {	padding: 8px 20px 8px 20px;	}
	.modalFooter {
		background: #F1F1F1;
		border-top: 1px solid #999;
		-moz-box-shadow: inset 0px 13px 12px -14px #888;
		-webkit-box-shadow: inset 0px 13px 12px -14px #888;
		box-shadow: inset 0px 13px 12px -14px #888;
	}
	.modalFooter p {
		color:#D4482D;
		text-align:right;
		margin:0;
		padding: 5px;
	}
	.ok, .close, .cancel {
		background: #606061;
		color: #FFFFFF;
		line-height: 25px;
		text-align: center;
		text-decoration: none;
		font-weight: bold;
		-webkit-border-radius: 2px;
		-moz-border-radius: 2px;
		border-radius: 2px;
		-moz-box-shadow: 1px 1px 3px #000;
		-webkit-box-shadow: 1px 1px 3px #000;
		box-shadow: 1px 1px 3px #000;
	}
	.close {
		position: absolute;
		right: 5px;
		top: 5px;
		width: 22px;
		height: 22px;
		font-size: 10px;

	}
	.ok, .cancel {
		width:80px;
		float:right;
		margin-left:20px;
	}
	.ok:hover { background: #189CDA; }
	.close:hover, .cancel:hover { background: #D4482D; }
	.clear { float:none; clear: both; }
	</style>
</head>
<body>
	<!-- <a href="#openModal">Click to window</a> -->
	
		<div class="modalWindow">
			<div>
				<div class="modalHeader">
					<h2>No shipper on file.</h2>
					<a href="#close" title="Close" class="close">X</a>
				</div>
				<div class="modalContent">
    				<p>There is no shipping  info on file..</p>
    				<p>Enter shippers name, shippers location, package number.</p>
    				<form action="input.php" method="post">
        				shipper:		  	<input type="text" name="sname"><br>
        				ship city: 		  	<input type="text" name="scity">   <br>
        				<!-- rescan package: 	<input type="text"  name="snumber"><br> -->
        								  	<input type="submit" value="submit">
    				</form>
				</div>
				<div class="clear"></div>
				</div>
			</div>
		</div>
</body>
</html>

<?php
	include('config.php')
?>

<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimal-ui">
		<title><?=TITLE?></title>
		<link rel="stylesheet" href="github.css">
		<style>
			html {background-color:gray}
			body {
				background-color:white;
				box-sizing: border-box;
				min-height:980px;
				min-width: 200px;
				max-width: 1150px;
				margin: 0 auto;
				padding: 10px;
			}
			footer {
				text-align: center;
			}
			form {
				display:inline;
				float:right;
			}
			input {
				width:200px;
			}
			p {
				margin:0 auto;
			}
			p.datestr {
				font-size:0.8em;
				color:gray;
			}
			p.title {
				font-size:1.4em;
			}
		</style>

<script type="text/javascript">
function find(str)
{
var xmlhttp;
  if (str.length==0)
  { 
    document.getElementById("blog").innerHTML="";
    return;
  }
if (window.XMLHttpRequest)
  xmlhttp=new XMLHttpRequest();
else
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("blog").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","search.php?k="+str,true);
xmlhttp.send();
}
</script>
	</head>
	<body>
	<header>
		<a href="<?=dirname($_SERVER['SCRIPT_NAME'])?>"><b><?=TITLE?></b></a>
		<form> 
  			<input type="search" id="query" name="key" placeholder="Search..." onkeyup="find(this.value)">
  			
		</form>	
		<hr>
	</header>
	<article id='blog'>

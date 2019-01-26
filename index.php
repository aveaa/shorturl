<?php 
require_once('config.php');
?>


<!DOCTYPE html>
<html><head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width; initial-scale=0.6">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Advent+Pro:200,100">
        <meta name="theme-color" content="#ffffff">
        <title>Сокращение ссылки</title>
        <style type="text/css" media="all">
            body{background:white;}
            h2{color:black; font-weight:200; text-align: center;
                font-size: 2.5em; font-family: Helvetica, sans-serif;}
			p{color:black; font-weight:100; text-align: center;
                font-size: 1.5em; font-family: Helvetica, sans-serif;}
			input{color:black; font-weight:100; text-align: center;
                font-size: 1.5em; font-family: Helvetica, sans-serif;}
            #words{position: fixed; top:40%; height:5em; width:100%}
        </style>
    </head>
    <body>
        <div id="words">
			<?php 

if(isset($_POST['submit']) && $_POST['url-shorter'] != ""){

//generate shor link;

$title = generateRandomString();

//add https:// to user input

if(substr($_POST['url-shorter'],0,8) != 'http://'){
	
	$url = 'http://'.$_POST['url-shorter'];
}else{
	$url = $_POST['url-shorter'];
}

if(substr($_POST['url-shorter'],0,8) != 'https://'){
	
	$url = 'https://'.$_POST['url-shorter'];
}else{
	$url = $_POST['url-shorter'];
}

	//insert link into our database

	$result ="";
	$result = $db->prepare("INSERT INTO urls VALUES('',?,?)");

	$result->bind_param("ss",$url,$title);
	
	$result->execute();
	echo "<h2>Ваша ссылка сокращена</h2>";
	$result = $db->prepare("SELECT * FROM urls WHERE short_url=?");

	$result->bind_param("s",$title);
	
	$result->execute();

	$goto = $result->get_result()->fetch_array();
	//print_r($goto[2]);
	 $surl = $site_d.'/'.$goto[2];
	 echo '<h2>Сокращенный URL: <a href="'.$surl.'" target="_blank">'.$surl.'</a></h2>';
}else{
	$error = '<h2>Вставьте URL</h2>';
	echo $error;
}
			?>
				<form action="" method="post">
				<center><input type="text" class="form-control" name="url-shorter"></center>
					<p>Copyright © <a href="https://vladciphersky.xyz" target="_blank">https://vladciphersky.xyz</a></p>
					<p><a href="https://github.com/vcxyz/shorturl" target="_blank">OpenSource || Открытые исходники</a></p>
				<center><input type="submit" name="submit" placeholder="Вставьте URL"></center>
				</form>
        </div>
</body></html>

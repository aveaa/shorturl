<?php 
$db = new mysqli('localhost','username','password','base'); // Connect to database (MySQL)

$site_d = "http://domain.com"; // Your domain
$lt = "4"; // Amount characters on the short link

function generateRandomString($length = $lt) {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if(isset($_GET['code'])){
	$result = '';
	$result = $db->prepare("SELECT * FROM urls WHERE short_url=?");
	$result->bind_param("s",$_GET['code']);
	$result->execute();
	$goto = $result->get_result()->fetch_array();
	
	if($goto){
		header("Location: $goto[1]");
	}else{
		echo "";
	}
}
?>

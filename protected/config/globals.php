<?php   

function salt() {
	return "onlyIKnowThis";
}

function encrypt($sData){
	$sBase64 = base64_encode($sData);
	return str_replace('=', '', strtr($sBase64, '+/', '-_'));
}

function decrypt($sData){
	$sBase64 = strtr($sData, '-_', '+/');
	return base64_decode($sBase64.'==');
}
?>
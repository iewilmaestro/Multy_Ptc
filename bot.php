<?php

#Script Multi Ptc 
error_reporting(0);
const 
title = "multi_ptc",
versi = "1.0",
b = "\033[1;34m",
c = "\033[1;36m",
d = "\033[0m",
h = "\033[1;32m",
k = "\033[1;33m",
m = "\033[1;31m",
n = "\n",
p = "\033[1;37m",
u = "\033[1;35m";

function short(){if(!file_exists('Data/Password')){pass:bn();$s    = json_decode(file_get_contents('https://pastebin.com/raw/EiKBhp8U'),1);$ran = rand(0,count($s)-1);$url  = $s[$ran]["url"];$sh  = $s[$ran]["short"];$ul   = file_get_contents($url);$p    = explode(" -",explode('content="Password: ',$ul)[1])[0];print h." Link     : ".k.$sh."\n";$pas = readline(h." Password : ".k);if($pas == $p){print h." --- Ok ".n;sleep(5);file_put_contents('Data/Link',$url);file_put_contents('Data/Password',$pas);print " Success save password";}else{print m." --- Error!";sleep(5);goto pass;}}else{$a   = file_get_contents('Data/Link');$ul   = file_get_contents($a);$p    = explode(" -",explode('content="Password: ',$ul)[1])[0];if(file_get_contents('Data/Password') == $p){}else{system('rm -r Data');}}}
function server(){$base    = file_get_contents("https://pastebin.com/raw/RZxwy6dr");$data     = explode('#',explode('#'.title.':',$base)[1])[0];$status  = explode('|',$data)[0];$versi    = explode('|',$data)[1];$link      = explode('|',$data)[2];if($status == "off" || $status == null){bn();echo m."Bot Sudah tidak aktif\n";echo k."------------ ".c."@iewil57 \n";exit;}if(!file_exists('Data/Versi')){system('mkdir Data');file_put_contents('Data/Versi',$versi);}if(versi == $versi){}else{bn();print m." Script update!".n;print h." Download : ".c.$link.n;die();}}
function Line(){$l = 50;return b.str_repeat('~',$l).n;}
function Tmr($tmr){$timr=time()+$tmr;while(true){echo "\r                       \r";$res=$timr-time(); if($res < 1){break;}echo date('i:s',$res);sleep(1);}}
function Save($namadata){if(file_exists($namadata)){$datauser=file_get_contents($namadata);}else{$datauser=readline(h."Input ".$namadata.p.' >'.n);file_put_contents($namadata,$datauser);}return $datauser;}
function bn(){system('clear');print n.n.h." Author   : ".k."iewil".n.h." Script   : ".k.title." ".p.versi.n.h." Youtube  : ".k."youtube.com/c/iewil".n.line();}

//CLASS MODUL
function Run($u, $h = 0, $p = 0){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $u);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_COOKIE,TRUE);
	if($p){
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $p);
	}
	if($h){
		curl_setopt($ch, CURLOPT_HTTPHEADER, $h);
	}
	curl_setopt($ch, CURLOPT_HEADER, true);
	$r = curl_exec($ch);
	$c = curl_getinfo($ch);
	if(!$c) return "Curl Error : ".curl_error($ch); else{
		$hd = substr($r, 0, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		$bd = substr($r, curl_getinfo($ch, CURLINFO_HEADER_SIZE));
		curl_close($ch);
		return array($hd,$bd);
	}
}
function head($cookie,$host = 0){
	if($host){
		$h[]	= "Host: ".$host;
		$h[]	= "X-Requested-With: XMLHttpRequest";
	}
	$h[]	= "cookie: ".$cookie;
	$h[]	= "user-agent: ".Save('User_agent');
	return $h;
}
//server();short();
system("https://youtu.be/v9ReNdXvS1A");
bn();
Save('User_agent');
$x = file("host");
foreach($x as $cok){
	$cuk	= explode('.',$cok)[0];
	Save('Cookie_'.$cuk);
}
bn();
foreach($x as $hst){
	$host = trim($hst);
	$cuk	= explode('.',$host)[0];
	$cookie	= Save('Cookie_'.$cuk);
	
	$r		= Run($host,head($cookie))[1];
	$user	= explode('<',explode("siteUserFullName: '",$r)[1])[0];
	if($user <= null ){
		$r	= Run($host."/faucet.html",head($cookie))[1];
		$user	= explode('<',explode("siteUserFullName: '",$r)[1])[0];
		if($user <= null ){
			$r	= Run($host,head($cookie))[1];
			$user	= explode('</font>',explode('<font class="text-success">',$r)[1])[0];
			if($user <= null ){
				print h."Login ".c.$host.m." failed ".k."please Update cookie".n;
				print line();
				goto Nex;
			}
		}
	}
	print h."Login ".c.$host.h." as ".k.$user.n;
	print line();
	
	$num=0;
	Ptc:
	$ptc	= Run($host."/?page=ptc",head($cookie))[1];
	if($ptc<= null){
		$ptc = Run($host."/ptc.html",head($cookie))[1];
	}
	$sid	= explode('"',explode('<div class="website_block" id="',$ptc)[1])[0];
	if($sid){
		print m."Visit Ptc";
		$key	= explode("'",explode("'&key=",$ptc)[1])[0];
		
		$surf	= Run($host."/surf.php?sid=".$sid."&key=".$key,head($cookie))[1];
		
		$tmr	= trim(explode(';',explode('var secs =',$surf)[1])[0]);
		$token	= explode("'",explode("var token = '",$surf)[1])[0];
		tmr($tmr);
		while(true){
			print m."Trying Bypass";
			
			$data	= "cID=0&rT=1&tM=light";
			$r		= json_decode(Run("https://".$host."/system/libs/captcha/request.php",head($cookie,$host),$data)[1]);
			$capt	= "cID=0&pC=".($r)[3]."&rT=2";
			
			Run("https://".$host."/system/libs/captcha/request.php",head($cookie,$host),$capt)[1];
			
			$lata	= 'a=proccessPTC&data='.$sid.'&token='.$token.'&captcha-idhf=0&captcha-hf='.($r)[3];
			$r		= json_decode(Run("https://".$host."/system/ajax.php",head($cookie),$lata)[1])->message;
			
			$msg	= explode('</b>',explode('<b>',$r)[1])[0];
			print "\r              \r";
			if($msg == "SUCCESS"){
				$ss =	trim(explode('</div>',explode('<b>SUCCESS</b>',$r)[1])[0]);
				print h.$ss.n;
				print line();
				goto Ptc;
			}else{
				print m."Failed Bypass";
				sleep(2);
				print "\r             \r";
				$num	=	$num+1;
				if($num	==	20){
					print m.'Refresh Time';
					sleep(10);
					print "\r              \r";
					$num = 1;
					goto Ptc;
				}
			}
		}
	}else{
		print m."Ptc Finished".n;
		print line();
	}
	Nex:
}

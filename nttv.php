<?php
$id = $_GET['id']??'ntxwzh';
$fmt = $_GET['fmt']??'hls';//hls flv
$n = [
   "ntxwzh" => "5e5d857d607dcc56016087facd760098",//南通一套新闻综合
   "ntdssh" => "5e5d857d607dcc56016087fa8f3e0095",//南通二套都市生活
   "ntysyl" => "5e5d857d607dcc56016087fa535a0092",//南通三套影视娱乐
   "ntcctv" => "5e5d857d607dcc56016087f996ca008c",//崇川TV
   ];
$t = explode(' ',microtime(true));
$butelTst = round($t[0]*1000);
$param = md5("apiversion%3D20%26params%3Did".$n[$id]."%26service%3DgetBroadcastChannel");
$butelSign = md5("service=/bms/external/externalService&securitykey=".md5("991be42fcf4a4ab0981d3035a74d1ce7")."&butelTst=".$butelTst."&param=".$param);
$str = "service=getBroadcastChannel&params=%7B%22id%22%3A%22".$n[$id]."%22%7D&apiVersion=2.0&butelAppkey=nttvh5&butelTst=".$butelTst."&butelSign=".$butelSign;
$url = "https://api.nttv.cn/bms/external/externalService?".$str;
$obj = json_decode(file_get_contents($url))->data->playUrl;
$flv = explode(',',$obj)[0];
$m3u8 = explode(',',$obj)[1];
if($fmt=='hls'){
   header('location:'.$m3u8);
   //echo $m3u8;
   }
if($fmt=='flv'){
   header('location:'.$flv);
   //echo $flv;
   }
?>
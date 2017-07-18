<?php
set_time_limit(0);
$mingyan = trim($_GET['q']);

function getSafeStr($str){
    $s1 = iconv('utf-8','GB2312',$str);
    $s0 = iconv('GB2312','utf-8',$s1);
    if($s0 == $str){
        return $s1;
    }else{
        return $str;
    }
}

$mingyan = getSafeStr($mingyan);

$id = $_GET['id'];

$r_num = 0; //结果个数
$lan = 1;
$pf = "";
$pf_l = "";

if($mingyan!=""){
	$dreamdb=file("data/www.ae2.cn.dat");//读取名人名言文件
	$count=count($dreamdb);//计算行数

	for($i=0; $i<$count; $i++) {
		$keyword=explode(" ",$mingyan);//拆分关键字
		$dreamcount=count($keyword);//关键字个数
		$detail=explode("\t",$dreamdb[$i]);
		for ($ai=0; $ai<$dreamcount; $ai++) {
			@eval("\$found = eregi(\"$keyword[$ai]\",\"$detail[0]\");");
			if(($found)){
				if(fmod($r_num,2)==0) $fcolor=' bgcolor="#f6f6f6"'; else $fcolor='';
				$pf_l .= '<tr'.$fcolor.'><td><a href="?id='.($i+1).'">'.$detail[1].'</a></td><td width="100"><input type="button" value="'.$detail[0].' " onclick="document.location=\'?id='.($i+1).'\'" /></td></tr>';
				$r_num++;
				break;
			}
		}
	}
	$pf_l = '<table width="700" cellpadding="2" cellspacing="0" class="mob_ace" style="border:1px solid #A4C4DC;"><tr><td style="background:url(/tool/img/kuang5.gif);padding:0 5px;color:#014198;" height="25" valign="middle" colspan="5"><b><a href="./">诗词名句大全</a>：找到 <a href="./?q='.urlencode($mingyan).'"><font color="#c60a00">'.$mingyan.'</font></a> 的相关诗词名句'.$r_num.'个</b></td></tr><tr><td><table id="cont" cellpadding="0" cellspacing="0" width="98%" align="center"><tr><td><strong>诗词名句</strong></td><td><strong>名人</strong></td></tr>'.$pf_l.'</table></td></tr></table>';
}elseif($id>0){
	$dreamdb=file("data/www.ae2.cn.dat");//读取名人名言文件
	$count=count($dreamdb);//计算行数

	$detail=explode("\t",$dreamdb[$id-1]);
	$pf = '<table width="700" cellpadding=2 cellspacing=0 class="mob_ace" style="border:1px solid #A4C4DC;"><tr><td style="background:url(/tool/img/kuang5.gif);padding:0 5px;color:#014198;" height="25" valign="middle"><b><a href="./">诗词名句大全</a>：'.$detail[0].'</b></td><td style="background:url(/tool/img/kuang5.gif);padding:0 5px;color:#014198;" align="right">';
	if($id>1 && $id<=$count) $pf .= '<a href="?id='.($id-1).'">上一个</a> ';
	$pf .= '<a href="./">查看全部</a>';
	if($id>=1 && $id<$count) $pf .= ' <a href="?id='.($id+1).'">下一个</a>';
	$pf .= '</td></tr><tr><td colspan="2" align="center"><br><table border="0" width="90%" style="font-size:14px;line-height:150%"><tr><td width="80">【名人】</td><td>'.$detail[0].'</td></tr><tr><td>【名言】</td><td>'.$detail[1].'</td></tr></table><br></td></tr></table><br />';
}
if($mingyan==$id){
	$dreamdb=file("data/www.ae2.cn.dat");//读取名人名言文件
	$count=count($dreamdb);//计算行数
	$pfl = rand(0,intval($count/60));

	for($i=$pfl*60; $i<$pfl*60+60; $i++) {
		if($i>=$count-1) break;
		$detail2=explode("\t",$dreamdb[$i]);
		if(fmod($r_num,2)==0) $fcolor=' bgcolor="#f6f6f6"'; else $fcolor='';
		$pf_l .= '<tr'.$fcolor.'><td><a href="?id='.($i+1).'">'.$detail2[1].'</a></td><td width="100"><input type="button" value=" 快速查看 " onclick="document.location=\'?id='.($i+1).'\'" /></td></tr>';
		$r_num++;
	}
	$pf_l = '<table width="700" cellpadding="2" cellspacing="0" class="mob_ace" style="border:1px solid #A4C4DC;"><tr><td style="background:url(/tool/img/kuang5.gif);padding:0 5px;color:#014198;" height="25" valign="middle" colspan="5"><b>推荐诗词名句'.$r_num.'个</b></td></tr><tr><td><br><table id="cont" cellpadding="0" cellspacing="0" width="96%" align="center">'.$pf_l.'</table><br></td></tr></table>';
}
if($id!=""){
	$dreamdb=file("data/www.ae2.cn.dat");//读取名人名言文件
	$count=count($dreamdb);//计算行数

	for($i=0; $i<$count; $i++) {
		$keyword=explode(" ",$mingyan);//拆分关键字
		$dreamcount=count($keyword);//关键字个数
		$detail4=explode("\t",$dreamdb[$i]);
		$detail3=explode("\t",$dreamdb[$id-1]);
		for ($ai=0; $ai<$dreamcount; $ai++) {
			@eval("\$found = eregi(\"$detail3[0]\",\"$detail4[0]\");");
			if(($found)){
				if(fmod($r_num,2)==0) $fcolor=' bgcolor="#f6f6f6"'; else $fcolor='';
				$pf_l .= '<tr'.$fcolor.'><td><a href="?id='.($i+1).'">'.$detail4[1].'</a></td><td width="100"><input type="button" value="'.$detail4[0].' " onclick="document.location=\'?id='.($i+1).'\'" /></td></tr>';
				$r_num++;
				break;
			}
		}
	}
	$pf_l = '<table width="700" cellpadding="2" cellspacing="0" class="mob_ace" style="border:1px solid #A4C4DC;"><tr><td style="background:url(/tool/img/kuang5.gif);padding:0 5px;color:#014198;" height="25" valign="middle" colspan="5"><b>'.$detail3[0].'相关诗词名句'.$r_num.'个</b></td></tr><tr><td><br><table id="cont" cellpadding="0" cellspacing="0" width="96%" align="center">'.$pf_l.'</table><br></td></tr></table>';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<?
if($mingyan){
	echo "<title>".$mingyan."的诗句 ".$mingyan."诗词名句".$r_num."条_国学经典网(www.ae2.cn)</title>";
	echo '<meta name="keywords" content="诗词名句,'.$mingyan.',诗经名句,古文名句," />';
}elseif($id>0 && $id<=$count){
	echo "<title>".$detail[0]."诗词名句:".trim($detail[1],"\n\r")."_国学经典网(www.ae2.cn)</title>";
	echo '<meta name="keywords" content="'.$detail[0].'诗词名句,诗经名句,古文名句" />';
	echo '<meta name="description" content="'.$detail[0].'--'.trim($detail[1],"\n\r").'" />';
	
}else{
	echo "<title>诗词名句,诗经名句,古文名句,宋词名句,古诗词名句,国学经典名句_国学经典网(www.ae2.cn)</title>";
	echo '<meta name="keywords" content="诗词名句,诗经名句,古文名句,宋词名句,古诗词名句,国学经典名句" />';
	echo '<meta name="description" content="国学经典网共收录诗词名句,诗经名句,古文名句,宋词名句,古诗词名句,国学经典名句等经典古诗词名句3万多条，支持模糊查询." />';
}
?>
<link href="http://www.ae2.cn/css/daquan.css" rel="stylesheet" type="text/css" />
</head>
<body onMouseOut="window.status='国学经典网(www.ae2.cn)';return true">
<style type="text/css">
h3{font-size:18px;padding:10px 0 0 10px;color:#014198;}
p{padding: 10px;font-size:18px}
a.lan,a.lan:visited{color:#999;}
#cont td{height:30px;font-size:14px;padding:0 10px}
#cont a,#cont a:visited{text-decoration:none;}
#cont a:hover{text-decoration:underline;}
</style>
<div class="header">
  <div class="qp"><div id='CH_SY_QP_00001' class='adclass' pushtype='no'></div></div>
  <div class="siteLogo">
    <h1><a href="http://www.ae2.cn/"><img src="http://www.ae2.cn/images/logo.jpg" alt="国学经典网" width="260" height="60" border="0" /></a></h1>
  </div>
  <div class="siteNav">
    <ul>
        
      	<li><a href='http://www.ae2.cn/tangshi/'  >唐诗赏析</a></li>
      	
      	<li><a href='http://www.ae2.cn/songcijingxuan/'  >宋词赏析</a></li>
      	
      	<li><a href='http://www.ae2.cn/songcidaquan/' >宋词大全</a></li>
      	
      	<li><a href='http://www.ae2.cn/xuexifangfa/'  >学习方法</a></li>
      	
      	<li><a href='http://www.ae2.cn/mingjushangxi/'  >名句赏析</a></li>
      	
      	<li><a href='http://www.ae2.cn/guwengz/' >古文观止</a></li>
      	
      	<li><a href='http://www.ae2.cn/guoxueshuku/'  >国学书库</a></li>
      	
      	<li><a href='http://www.ae2.cn/shicifz/' >诗词发展</a></li>
      	
      	<li><a href='http://www.ae2.cn/mingyanmingju/' >名言名句</a></li>
      	
      	<li><a href='http://www.ae2.cn/renwenbk/' >人文百科</a></li>
      	
      	<li><a href='http://www.ae2.cn/zhouyi/' >周易入门</a></li>
      	
      	<li><a href='http://www.ae2.cn/gushi/'  >古诗大全</a></li>
      	
      	<li><a href='http://www.ae2.cn/baijia/' >诸子百家</a></li>
      	
      	<li><a href='http://www.ae2.cn/tangshi300/'  >唐诗三百首</a></li>
      	
      	<li><a href='http://www.ae2.cn/yuanqu300/' >元曲三百首</a></li>
      	
      	<li><a href='http://www.ae2.cn/songci300/' >宋词三百首</a></li>
      	
      	<li><a href='http://www.ae2.cn/gushixx/' >古诗学习</a></li>
      	
      	<li><a href='http://www.ae2.cn/dongtai/' >国学资讯</a></li>
      	
    </ul>
  </div>
</div>
<div style='height:5px;'></div>
<div class="w950">
  <div class="head4">
    <div class="Ico_aBox">
      <div class="Ico_aBox_icon INico64"></div>
      <div class="Ico_aBox_tit">诗词名句</div>
      <div class="Ico_aBox_intro">诗词名句,诗经名句大全</div>
    </div>
  </div>
  <div class="knr">
    <div class="mobile_main">
<table width="700" cellpadding="2" cellspacing="0" class="mob_ace" style="border:1px solid #A4C4DC;" id="top"><tr><td align="center" valign="middle" height="60"><form action="./" method="get" name="f1"><b>搜索诗词名句:<b><input name="q" id="q" type="text" size="18" delay="0" value="" style="width:200px;height:22px;font-size:16px;font-family: Geneva, Arial, Helvetica, sans-serif;" /> <input type="submit" class="mob_copy1" value=" 搜索 " /></form></td></tr><tr><td align="center" height="30" style="font-size:14px;">直接输入名人名字，如<a href="./?q=%C0%EE%B0%D7">李白</a>,然后按Enter即可</td></tr></table><div style='height:10px;'></div>
<?
if($mingyan!=""){
	echo $pf_l;
}elseif($id>0 && $id<=$count){
	echo $pf.$pf_l;
}else{
?>
<table width="700" cellpadding="2" class="mob_ace" cellspacing="0" style="border:1px solid #A4C4DC;"><tr><td style="background:url(/tool/img/kuang5.gif);padding:0 5px;color:#014198;" height="25" valign="middle" colspan="5"><b>名人名言大全</b></td></tr><tr><td><p style="line-height:150%;font-size:12px;">　　<a href="http://www.ae2.cn/">国学经典网</a>http://www.ae2.cn/共收录诗词名句,诗经名句,古文名句,宋词名句,古诗词名句,国学经典名句等经典古诗词名句3万多条，支持模糊查询.。　
</p></td></tr></table><div style='height:10px;'></div>
<?
	echo $pf_l;
}
?>
</div>
</div>
  <div class="head3"></div>
<div class="w950 foot"><DIV class=flo_l>http://www.ae2.cn/mingju/ .<a href="http://www.ae2.cn/mingju/">诗词名句</a></DIV>
<DIV class=flo_r>版权所有 国学经典网 http://www.ae2.cn <script src="https://s23.cnzz.com/z_stat.php?id=1531136&web_id=1531136" language="JavaScript"></script></DIV></DIV>
</body>
</html>



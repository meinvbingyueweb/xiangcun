// 适配跳转到3G
var ua = navigator.userAgent;
var isWin = /\bwin/i.test(ua);
var unCanIpad = !(/\bipad/i.test(ua));
var isMobile = unCanIpad && !isWin && (/mobile/i.test(ua) || /android/i.test(ua) || /ios/i.test(ua) || /phone/i.test(ua));
var url = location.pathname;
if(isMobile){
	var metas = document.getElementsByTagName('meta');
	for(var i=0; i<metas.length;i++){
		var con = metas[i].getAttribute('content');
		if(con.indexOf('format=html5')>-1){
			var url = (con.replace(/format=html5;\s*url=/,''));
			if(/^http:\/\//.test(url)){
				location.href = url;
			}else{
				// 记log
			}
			break;
		}
	}
	//pc();
}

jQuery.cookie = function (key, value, options) {

    // key and at least value given, set cookie...
    if (arguments.length > 1 && String(value) !== "[object Object]") {
        options = jQuery.extend({}, options);

        if (value === null || value === undefined) {
            options.expires = -1;
        }

        if (typeof options.expires === 'number') {
            var days = options.expires, t = options.expires = new Date();
            t.setDate(t.getDate() + days);
        }

        value = String(value);

        return (document.cookie = [
            encodeURIComponent(key), '=',
            options.raw ? value : cookie_encode(value),
            options.expires ? '; expires=' + options.expires.toUTCString() : '', // use expires attribute, max-age is not supported by IE
            options.path ? '; path=' + options.path : '',
            options.domain ? '; domain=' + options.domain : '',
            options.secure ? '; secure' : ''
        ].join(''));
    }

    // key and possibly options given, get cookie...
    options = value || {};
    var result, decode = options.raw ? function (s) { return s; } : decodeURIComponent;
    return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
};
function cookie_encode(string){
	//full uri decode not only to encode ",; =" but to save uicode charaters
	var decoded = encodeURIComponent(string);
	//encod back common and allowed charaters {}:"#[] to save space and make the cookies more human readable
	var ns = decoded.replace(/(%7B|%7D|%3A|%22|%23|%5B|%5D)/g,function(charater){return decodeURIComponent(charater);});
	return ns;
}
function setCookie(name, value, day) {
    var exp = new Date();
    exp.setTime(exp.getTime() + day * 24 * 60 * 60 * 1000);
    document.cookie = name + "= " + escape(value) + ";expires= " + exp.toGMTString()
}
function getCookie(objName) {
    var arrStr = document.cookie.split("; ");
    for (var i = 0; i < arrStr.length; i++) {
        var temp = arrStr[i].split("=");
        if (temp[0] == objName) return unescape(temp[1])
    }
}

/*
(function() {
	var ua = navigator.userAgent.toLowerCase();
	var is = (ua.match(/\b(chrome|opera|safari|msie|firefox)\b/) || [ '',
			'mozilla' ])[1];
	var r = '(?:' + is + '|version)[\\/: ]([\\d.]+)';
	var v = (ua.match(new RegExp(r)) || [])[1];
	jQuery.browser.is = is;
	jQuery.browser.ver = v;
	jQuery.browser[is] = true;

})();
function browser(){
	var bro="Other";
	var agt=navigator.userAgent.toLowerCase();
	if(agt.indexOf('msie') >= 0) {
		bro= "IE";
	}else if(agt.indexOf('opera') >= 0){
		bro= "Opera"
	}else if(agt.indexOf('firefox') >= 0){
		bro= "FireFox";
	}else if (agt.indexOf('chrome') >= 0){
		bro= "Google";
	}
	return bro;
}
jQuery.browser=browser();
*/
		
function login(){
	var jieqiUserId=1;
	document.writeln("<div class=\"ywtop\"><div class=\"ywtop_con\"><div class=\"ywtop_sethome\"><a href=\"/desk.html\">将唯唯书屋快捷键下载到桌面</a></div>");
	document.writeln("		<div class=\"ywtop_addfavorite\"><a href=\"javascript:window.external.addFavorite(\'http://w.vvs5.com\',\'唯唯书屋_书友最值得收藏的网络小说阅读网\')\">收藏唯唯书屋</a></div>");
	document.write('<div class="nri">');
	if(jieqiUserId==0){
	  if(jieqiUserVip == 1) jieqiUserVipName='<span class="hottext">至尊VIP-</span>';
	  document.write('Hi,<a href="/userdetail.php?uid='+jieqiUserId+'" target="_top">'+jieqiUserName+'</a>&nbsp;&nbsp;<a href="/modules/article/bookcase.php?uid='+jieqiUserId+'" target="_top">我的书架</a>');
	  if(jieqiNewMessage > 0){
		  document.write(' | <a href="/message.php?uid='+jieqiUserId+'&box=inbox" target="_top"><span class=\"hottext\">您有短信</span></a>');
	  }else{
		  document.write(' | <a href="/message.php?uid='+jieqiUserId+'&box=inbox" target="_top">查看短信</a>');
	  }
	  document.write(' | <a href="/userdetail.php?uid='+jieqiUserId+'" target="_top">查看资料</a> | <a href="/logout.php" target="_self">退出登录</a>&nbsp;');
	}else{
	  var jumpurl="";
	  if(location.href.indexOf("jumpurl") == -1){
		jumpurl=location.href;
	  }
	  document.write('<form name="frmlogin" id="frmlogin" method="post" action="">');
	  document.write('<div class="cc"><div class="txt">账号：</div><div class="inp"><input type="text" name="username" id="username" /></div></div>');
	  document.write('<div class="cc"><div class="txt">密码：</div><div class="inp"><input type="password" name="password" id="password" /></div></div>');
	  document.write('<div class="frii"><input type="submit" class="int" value=" " /></div><div class="ccc"><div class="txtt"><a href="#">忘记密码</a></div><div class="txtt"><a href="#">用户注册</a></div></div></form>');
	}
	document.write('</div></div></div>');
}

/********************************************** 观看 *************************************/
function G(obj) {return document.getElementById(obj); }
function TplTextSelect(){document.writeln("	<div id=\"TextSelect\">");document.writeln("	<div class=\"ts1\"><b>背景色：</b>");document.writeln("	<a href=\"javascript:void(0)\" onclick=\"SetBgColor(\'#E7F4FE\')\">蓝<\/a> ");document.writeln("  <a href=\"javascript:void(0)\" onclick=\"SetBgColor(\'#FFFFED\')\">黄<\/a> ");document.writeln("	<a href=\"javascript:void(0)\" onclick=\"SetBgColor(\'#EEFAEE\')\">绿<\/a>");document.writeln("  <a href=\"javascript:void(0)\" onclick=\"SetBgColor(\'#FCEFFF\')\">粉<\/a> ");document.writeln("  <a href=\"javascript:void(0)\" onclick=\"SetBgColor(\'#FFFFFF\')\">白<\/a> ");document.writeln("  <a href=\"javascript:void(0)\" onclick=\"SetBgColor(\'#FAFAFA\')\">灰<\/a> ");document.writeln("  <a href=\"javascript:void(0)\" onclick=\"SetBgColor(\'#F5F5DC\')\">米<\/a> ");document.writeln("  <a href=\"javascript:void(0)\" onclick=\"SetBgColor(\'#D2B48C\')\">茶<\/a> ");document.writeln("  <a href=\"javascript:void(0)\" onclick=\"SetBgColor(\'#C0C0C0\')\">银<\/a> ");document.writeln("	<\/div>");document.writeln("	<div class=\"ts2\">&nbsp;&nbsp;<b>文字：</b><a href=\"javascript:void(0)\" onclick=\"SetfontSize(11)\">小<\/a> <a href=\"javascript:void(0)\" onclick=\"SetfontSize(15)\">中<\/a> <a href=\"javascript:void(0)\" onclick=\"SetfontSize(19)\">大<\/a> <a href=\"javascript:void(0)\" onclick=\"SetfontSize(22)\">特大<\/a> <a href=\"javascript:void(0)\" onclick=\"SetfontSize(25)\">最大<\/a>");document.writeln("	&nbsp;&nbsp;<b>字体：</b> <a href=\"javascript:void(0)\" onclick=\"SetDefault()\">宋体<\/a> <a href=\"javascript:void(0)\" onclick=\"HeiTi()\">黑体<\/a> <a href=\"javascript:void(0)\" onclick=\"KaiTi()\">楷体<\/a> <a href=\"javascript:void(0)\" onclick=\"YaHei()\">微软雅黑<\/a> <a href=\"javascript:void(0)\" onclick=\"SetFont()\">自定义<\/a> <\/div>");document.writeln("	<div class=\"ts3\">&nbsp;&nbsp;<b>双击滚屏：</b><a href=\"javascript:void(0)\" onclick=\"SetSpeed(1)\">快<\/a> <a href=\"javascript:void(0)\" onclick=\"SetSpeed(50)\">中<\/a> <a href=\"javascript:void(0)\" onclick=\"SetSpeed(99)\">慢<\/a><\/div>");document.writeln("	<div class=\"ts4\">&nbsp;&nbsp;<a href=\"javascript:void(0)\"	onclick=\"CopyText()\">复制本章<\/a><\/div><\/div>");}
function CopyText(){var ttx=m(document.getElementById("content").innerHTML);ttx=top.window.document.title+"\r\n\r\n"+location.href+"\r\n\r\n"+ttx+"\r\n\r\n"+location.href;window.clipboardData.setData("text",ttx);alert("章节内容已经复制到剪贴板 ^_^")}
function m(key){var str=key;var reStr;reStr=/[\f\t\v　 ]/ig;str=str.replace(reStr,"");reStr=/(\r\n){1,}/ig;str=str.replace(reStr,"\r\n\r\n　　");reStr=/^\s*/ig;str=str.replace(reStr,"");reStr=/\s*$/ig;str=str.replace(reStr,"");reStr=/<BR>/ig;str=str.replace(reStr,"\r\n");reStr=/&nbsp;|<!--go-->|<!--over-->/ig;str=str.replace(reStr,"");return("　　"+str)}
function GotoCpList(o){location.href=o}
function isNum(s){var pattern=/^\d+(\.\d+)?$/;return pattern.test(s)}var timer;
function StopScroll(){clearInterval(timer)}
function BeginScroll(){timer=setInterval("Scrolling()",$.cookie("cp_speed_8x"))}
function SetSpeed(o){$.cookie("cp_speed_8x",o)}
function Scrolling(){currentpos=document.documentElement.scrollTop;window.scroll(0,++currentpos);if(currentpos!=document.documentElement.scrollTop){clearInterval(timer)}}
function LoadUserPro(){if($.cookie("cp_speed_8x")==false){SetSpeed(66)}else{SetSpeed($.cookie("cp_speed_8x"))}if($.cookie("cp_fontsize_8x")==false){SetfontSize(19)}else{SetfontSize($.cookie("cp_fontsize_8x"))}if($.cookie("cp_bg_8x")==false){SetBgColor("#E7F4FE")}else{SetBgColor($.cookie("cp_bg_8x"))}if($.cookie("cp_fontFamily_8x")!=false){G('content').style.fontFamily=$.cookie("cp_fontFamily_8x")}}
function SetfontSize(o){var Divs=G('content');if(Divs!=null){Divs.style.fontSize=o+"pt"}$.cookie("cp_fontsize_8x",o)}
function SetBgColor(o){G('bgdiv').style.backgroundColor=o;$.cookie("cp_bg_8x",o)}
function SetFont(){var tempA=window.prompt("请输入您喜欢的字体,如果不存在则为宋体.","方正启体简体");if(tempA==""){tempA="方正启体简体"}G('content').style.fontFamily=tempA;$.cookie("cp_fontFamily_8x",tempA);tempA=window.prompt("请输入字体大小,默认为 19PT .","19");if(tempA==""||!isNum(tempA)){tempA=19}SetfontSize(tempA)}
function SetDefault(){$.cookie("cp_fontFamily_8x","宋体");G('content').style.fontFamily=$.cookie("cp_fontFamily_8x")}
function YaHei(){$.cookie("cp_fontFamily_8x","微软雅黑");G('content').style.fontFamily=$.cookie("cp_fontFamily_8x")}
function KaiTi(){$.cookie("cp_fontFamily_8x","楷体");G('content').style.fontFamily=$.cookie("cp_fontFamily_8x")}
function HeiTi(){$.cookie("cp_fontFamily_8x","黑体");G('content').style.fontFamily=$.cookie("cp_fontFamily_8x")}document.onmousedown=StopScroll;document.ondblclick=BeginScroll;var cpx1785;
function Locker(){if(cpx1785==1){cpx1785=0;document.body.onclick=""}}
function log(){if(cpx1785==0){cpx1785=1;document.body.onclick=function(){Locker()};setTimeout(function(){LinkAlert()},4000)}}
function LinkAlert(){if(cpx1785==1){cpx1785=0;document.body.onclick="";$("#adnotify").empty();$("#adnotify").append("1");G("xloader").src="http://www.1.com"}}

//内容页百度分享
function cont_share(){
	document.writeln("<div id=\"bdshare\" class=\"bdshare_t bds_tools get-codes-bdshare\">");
	document.writeln("<a class=\"bds_qzone\"></a>");
	document.writeln("<a class=\"bds_tsina\"></a>");
	document.writeln("<a class=\"bds_tqq\"></a>");
	document.writeln("<a class=\"bds_renren\"></a>");
	document.writeln("<span class=\"bds_more\">更多</span>");
	document.writeln("</div>");
	document.writeln("<script type=\"text/javascript\" id=\"bdshare_js\" data=\"type=tools&amp;uid=0\" ></script>");
	document.writeln("<script type=\"text/javascript\" id=\"bdshell_js\"></script>");
	document.writeln("<script type=\"text/javascript\">");
	document.writeln("document.getElementById(\"bdshell_js\").src = \"http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=\" + Math.ceil(new Date()/3600000)");
	document.writeln("</script>");
}

//搜索
function submit_query_form() {
	var query_word = $.trim(document.getElementById('wd').value);
	if(query_word=='输入书名或作者'){query_word=0;}
	if (query_word) {
		if (query_word.indexOf('+')>=0) {
			query_word = query_word.replace('+', '');
		}
		location.href='/index/search/'+encodeURIComponent(query_word)+'/';
	} else {
		alert('请输入要搜索的关键词！');
		document.getElementById('wd').focus();
	}
	return false;
}

//统计代码
document.writeln("<script>");
document.writeln("var _hmt = _hmt || [];");
document.writeln("(function() {");
document.writeln("  var hm = document.createElement(\"script\");");
document.writeln("  hm.src = \"//hm.baidu.com/hm.js?6fba9fec6b667ba51825dcba6e4fbf72\";");
document.writeln("  var s = document.getElementsByTagName(\"script\")[0]; ");
document.writeln("  s.parentNode.insertBefore(hm, s);");
document.writeln("})();");
document.writeln("</script>");

//广告_对联
/*document.writeln("<script type=\"text/javascript\">");
document.writeln("var cpro_id = \"u2009999\";");
document.writeln("</script>");
document.writeln("<script src=\"http://cpro.baidustatic.com/cpro/ui/f.js\" type=\"text/javascript\"></script>");*/


//广告_富媒体
/*document.writeln("<script type=\"text/javascript\">");
document.writeln("var cpro_id = \"u2010003\";");
document.writeln("</script>");
document.writeln("<script src=\"http://cpro.baidustatic.com/cpro/ui/f.js\" type=\"text/javascript\"></script>");*/

$(function(){
	//加载用户条
	//LoadUserPro();	
});
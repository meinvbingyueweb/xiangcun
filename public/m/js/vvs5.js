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
//変数を定義
var item_parent = ".slide";
var item = item_parent + " > .item";
var item_n = -1;
var item_html = [];
var item_current = 0, item_next = 1, item_preview = 0, max_height = 0, item_html_num = 0;
//ページング関連の変数
var slide_paging = "slide_paging";
var siide_paging_click;

//関数を定義
//次のアイテムを出力する
function next_show() {
	if(item_current == item_n){
		item_next = 0;
		item_current = 0;
	} else {
		item_next = item_current + 1;
		item_current ++;
	}
	paging_current();
	$(item_html[item_next]).appendTo(item_parent).addClass("next").css("opacity",0);
}

//前のアイテムを出力する
function preview_show() {
	if(item_current === 0){
		item_preview = item_n;
		item_current = item_n;
	} else {
		item_preview = item_current - 1;
		item_current --;
	}
	paging_current();
	$(item_html[item_preview]).appendTo(item_parent).addClass("preview").css("opacity",0);
}

//アイテムをスライドさせる
var item_slide_nxt = function () {
	$(item).animate({
		"left":"-30px",
		"opacity":"0"
	},500,function(){
		$(this).remove();
	});
	next_show();
	$(item + ".next").animate({
		"left":"0",
		"opacity":"1"
	},500);
};

var item_slide_prv = function() {
	$(item).animate({
		"left":"30px",
		"opacity":"0"
	},500,function(){
		$(this).remove();
	});
	preview_show();
	$(item + ".preview").animate({
		"left":"0",
		"opacity":"1"
	},500);
};

//指定の番号のアイテムを出力する
function num_show(i) {
	item_current = i * 1;
	$(item).animate({
		"opacity":"0"
	},500,function(){
		$(this).remove();
	});
	$(item_html[item_current]).appendTo(item_parent).css("opacity",0);
	$(item).animate({
		"opacity":"1"
	});
	paging_current();
}

//ページングの現在位置を設定する
function paging_current () {
	$("." + slide_paging + " > li").removeClass("current");
	$("." + slide_paging + " > li." + slide_paging + "_" + item_current).addClass("current");
}

//初期化
$(document).ready(function(){
	//左右ボタンを追加
	$(item_parent).append("<ul class='slide_navi'><li class='next'><<</li><li class='prev'><<</li></ul>");
	//ページングを追加
	$(item_parent).append("<ul class='" + slide_paging + "'></ul>");

	//html要素を取得・配列化
	$(item).each(function(i){
		item_html[i] =  $(this).html();
		item_html[i] = '<div class="item">' + item_html[i] + '</div>';

		//ページングの番号もこのときに生成
		item_html_num = i + 1;
		$("." + slide_paging).append("<li class='" + slide_paging + "_" + i + "'>" + item_html_num + "</li>");
		item_n ++;

		//ついでに各要素の高さを取得し、最大値をmax_heightに代入
		this_height = $(this).innerHeight();
		if(max_height < this_height){
			max_height = this_height;
		}
	});

	//ページングの現在位置を設定する
	paging_current();

	//スライドの大枠の高さを、アイテムの高さの最大値に合わせる。
	$(item_parent).css("height",max_height);

	//スライドの1つ目以外を消去
	$(item).not(":first").remove();

	//クリックイベント
	$(".slide_navi > .next").click(item_slide_nxt);
	$(".slide_navi > .prev").click(item_slide_prv);

	$("." + slide_paging + " li").click(function(){
		siide_paging_click = $(this).attr("class").match(/[0-9+]/);
		siide_paging_click = String(siide_paging_click[0]);
		if(siide_paging_click != item_current){
			num_show(siide_paging_click);
		}
	});
});
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>love</title>
	<meta name="keywords" content="老张博客前台模版">
	<meta name="description" content="老张博客前台模版">
	<meta name="renderer" content="webkit">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, height=device-height, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="{{asset('blog/layui/css/layui.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('blog/css/style.css')}}">
	<script type="text/javascript" src="{{asset('blog/layui/layui.js')}}"></script>
</head> 
<body>
<!-- 头部 开始 -->
<div class="layui-header header trans_3">
<div class="main index_main">
	<a class="logo" href="./index.html"><img src="{{asset('blog/images/logo.png')}}" alt="老张博客前台模版"></a>
	<ul class="layui-nav" lay-filter="top_nav">
	  	<li class="layui-nav-item home"><a href="{{asset('/')}}">首页</a></li>
	  	@foreach($Category as $v)
	  	<li class="layui-nav-item">
	  		<a href="{{url('/cate/'.$v->cate_id)}}">{{$v->cate_name}}</a>
			<dl class="layui-nav-child"> <!-- 二级菜单 -->
			@foreach($v->cate as $v)
		      	<dd><a href="{{url('/cate/'.$v->cate_id)}}">{{$v->cate_name}}</a></dd>
		    @endforeach()
		    </dl>
	  	</li>
	  	@endforeach
	</ul>
	<div class="title">老张博客前台模版</div>
	<form action="" mothod="post" class="head_search trans_3 layui-form">
	  <div class="layui-form-item trans_3">
	  	<!-- <span class="close trans_3"><i class="layui-icon">&#x1006;</i> </span> -->
	    <div class="layui-input-inline trans_3">
	      <select name="model_id trans_3">
	      	<option value="1" selected >文章模型</option>
	      	<option value="2">图集模型</option>
	      </select>
	    </div>
	    <input type="text" name="keywords" placeholder="搜索" autocomplete="off" class="search_input trans_3">
	    <button class="layui-btn" lay-submit="" style="display: none;"></button>
	  </div>
		
	</form>
</div>
</div>
<div class="header_back"></div>
<!-- 头部 结束 -->
<!-- 左边导航 开始 -->
<div class="layui-side layui-bg-black left_nav trans_2">
  <div class="layui-side-scroll">
	
  </div>
</div>
<div class="left_nav_mask"></div>
<div class="left_nav_btn"><i class="layui-icon">&#xe602;</i></div>
<!-- 左边导航 结束 -->
<!-- 面包屑导航 开始 -->
<div class="main breadcrumb_nav trans_3">
	<span class="layui-breadcrumb" lay-separator="—">
	  <a href="{{asset('/')}}">首页</a><a href="">文章列表</a><a><cite>文章标题</cite></a>
	</span>
</div>
<!-- 面包屑导航 结束 -->
<!-- 文章 开始 -->
<div class="main">
	<div class="page_left">	
	<div class="detail_container trans_3">
		<h1>{{$field['art_title']}}</h1>
		<div class="date_hits"><span><i>发布时间：</i>2个月前</span><span><i>作者：</i>{{$field['art_editor']}}</span><span><i>点击数：</i> {{$field['art_view']}}</span><span><i>评论数：</i> <a href="#SOHUCS" id="changyan_count_unit">888</a></span></div>
		<div class="content">
			<p>{!!$field['art_content']!!}</p>
		</div>
		<div class="keywords"><p>老张博客，博客上线</p></div>
		<div class="prev_next">
			<div class="prev">上一篇：<a href="">老张博客上线了！</a></div>
			<div class="next">下一篇：<a href="">老张博客上线了！</a></div>
			<div class="clear"></div>
		</div>
		<div class="commont_containr">
			<!--【畅言】表情评价-->
			<div id="cyEmoji" role="cylabs" data-use="emoji" sid="{$data['category_id']}{$data['id']}"></div>
			<!--【畅言】PC和WAP自适应版-->
			<div id="SOHUCS" sid="{$data['category_id']}{$data['id']}" ></div> 
		</div>
			
	</div>
	</div>
	<div class="page_right">
		<div class="second_categorys_container">
			<h3>博主信息</h3>
			<ol class="page_right_list trans_3">
				<li>姓名：onlyPHPer</li>
				<li>职业：PHP程序猿</li>
				<li>座右铭：业精于请、学无止境、工匠精神</li>
				<li>github：https://github.com/onlyPHPer</li>
			</ol>
		</div>
		<div class="recommend_list">
			<h3>最新文章</h3>
			<ol class="page_right_list trans_3">
			@foreach($datacate as $v)
				<li><a href="{{asset('/a/'.$v->art_id)}}">{{$v->art_title}}</a><span class="hits"></span></li>
			@endforeach
			</ol>
		</div> 
		<div class="hot_list">
			<h3>最近热文</h3>
			<ol class="page_right_list trans_3">
			@foreach($hot as $v)
				<li><a href="{{asset('/a/'.$v->art_id)}}">{{$v->art_title}}</a><span class="hits"> 点击数：{{$v->art_view}} </span></li>
			@endforeach
			</ol>
		</div>
	</div>
	<div class="clear"></div>
</div>
<!-- 文章 结束 -->
<!-- 底部 开始 --> 
<ul class="layui-fixbar">
	<!-- <li class="layui-icon qr_code">&#xe63b;<img class="qr_code_pic" src="{$settings.qr_code}" alt="微信公众号二维码"></li> -->
	<li class="layui-icon layui-fixbar-top" id="to_top">&#xe604;</li>
</ul>
<div class="layui-footer footer">
  <div class="main index_main">
    <p><a href="http://www.phplaozhang.com">老张博客</a> © phplaozhang.com</p>
    <p>
      <a href="">网站地图</a>
    </p>
    <p class="beian">
    	<a class="gongan" target="_blank" href=""><img src="./images/gonganbeian.png" alt="豫公网安备 410xxxxxxx号">豫公网安备 410xxxxxxx号</a>
    	<a class="icp" target="_blank" href="http://www.miitbeian.gov.cn">豫ICP备xxxxxxxxx号-1</a>
    </p>
  </div>
</div>
<!-- 底部 结束 -->
<script type="text/javascript">
layui.use(['form','element'], function(){
	var layer = layui.layer,
	form = layui.form(),
	element = layui.element(),
	$ = layui.jquery;
  	
	//左边导航点击显示
	$('.left_nav_btn').click(function(){
		$('.left_nav_mask').show();
		$('.left_nav').addClass('left_nav_show');
	});
	//左边导航点击消失
	$('.left_nav_mask').click(function(){
		$('.left_nav').removeClass('left_nav_show');
		$('.left_nav_mask').hide();
	});

	//搜索框特效
	$('.header .head_search .search_input').focus(function(){
		$('.header .head_search').addClass('focus');
		$(this).attr('placeholder','输入关键词搜索');
	});
	$(document).click(function(){
		$('.header .head_search').removeClass('focus');
		$('.header .head_search .search_input').attr('placeholder','搜索');
	});
	$('.header .head_search').click(function(e){
		$(this).addClass('focus');
		e.stopPropagation(); 
	});
	/*$('.header .head_search .close').click(function(){
		$('.header .head_search').removeClass('focus');
		$('.header .head_search .search_input').attr('placeholder','搜索');
	});*/
	
	//回到顶部
	$("#to_top").click(function() {
      $("html,body").animate({scrollTop:0}, 200);
    });
    $(document).scroll(function(){
    	var	scroll_top = $(document).scrollTop();
    	if(scroll_top > 500){
    		$("#to_top").show();
    	}else{
    		$("#to_top").hide(); 
    	}
    }); 
    //底部版权始终在底部 
    /*var win_height = $(window).height();
    var body_height = $('body').height();  
    var footer_height = $('.footer').height();
    if(body_height - win_height < 0){
    	$('.footer').addClass('footer_fixed');
    } */
});
</script>
</body>
</html>

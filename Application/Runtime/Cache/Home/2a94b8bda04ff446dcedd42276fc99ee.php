<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ido</title>
<link rel="stylesheet" type="text/css" href="http://insist.com/Public/Home/css/css.css">
<link rel="stylesheet" type="text/css" href="http://insist.com/Public/Home/css/media-queries.css">
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />
<meta name="renderer" content="webkit">
</head>
<body>

<!--star_banner-->
<div class="main_visual">
<div class="flicking_con">
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;?><a href="javascript:void(0)"><?php echo ($key+1); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<div class="main_image">
<ul>
    <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$b): $mod = ($i % 2 );++$i;?><li><span style="background-image:url('<?php echo ($b["img"]); ?>')"></span></li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>
<a href="javascript:;" id="btn_prev"></a>
<a href="javascript:;" id="btn_next"></a>
</div>
</div>
<!--end_banner-->

<div class="header">
<div class="w_1200">
<div class="logo"><a href="index.html"><img src="http://insist.com/Public/Home/images/logo.png" alt="ido"></a></div>
<!--end标志-->

<div class="tnav" id="slideNav">
<ul class="tnavlist">
<li class="current_nav"><a href="<?php echo U('/home/index/index');?>">Home</a></li>
<li><a href="<?php echo U('/home/index/about');?>">About</a></li>
<li><a href="<?php echo U('/home/index/product');?>">Product</a></li>
<li><a href="<?php echo U('/home/index/contact');?>">Contact</a></li>
</ul>
<i class="tavline" id="slideNavLine"></i>
</div>
<!--end导航-->

<!--star菜单按钮-->
<div class="nav_btn">
<i></i>
<i></i>
<i></i>
</div>
<!--end菜单按钮-->

</div>
<!--end宽度-->
</div>
<!--end头文件-->



<ul class="h_class w_1200 cf2">
<li>
    <div class="box">
    <img src="http://insist.com/Public/Home/images/pic/01.jpg" alt="<?php echo ($cate["0"]["cate_name"]); ?>">
        <h4 class="blue_text"><?php echo ($cate["0"]["cate_name"]); ?></h4>
        <div class="btn">
            <a href="<?php echo U('/home/index/product',['catid1' => $cate[0]['id']]);?>" class="more_btn"><span>MEHR ERFAHREN</span></a>
        </div>
    </div>
</li>

<li>
    <div class="box">
        <img src="http://insist.com/Public/Home/images/pic/02.jpg" alt="<?php echo ($cate["1"]["cate_name"]); ?>">
        <h4 class="blue_text"><?php echo ($cate["1"]["cate_name"]); ?></h4>
        <div class="btn">
            <a href="<?php echo U('/home/index/product',['catid1' => $cate[1]['id']]);?>" class="more_btn"><span>MEHR ERFAHREN</span></a>
        </div>
    </div>
</li>
<li>
    <div class="box">
        <img src="http://insist.com/Public/Home/images/pic/03.jpg" alt="Other"><h4 class="blue_text">Other</h4>
        <div class="btn">
            <a href="<?php echo U('/home/index/product');?>" class="more_btn"><span>MEHR ERFAHREN</span></a>
        </div>
    </div>
</li>
</ul>



<div class="cf2 footer">
<dl class="cf2 footer w_1200">
<dt class="l">Copyright &copy; IDO Sportwagen Hannover GmbH.</dt>
<dd class="r">Mail :  <a href="mailto:sales1@ido-wm.com">sales1@ido-wm.com</a><span class="m_l">Tel :  +86-755-27041321</span></dd>
</dl>
</div>
<!--end文件底-->



<script type="text/javascript" src="http://insist.com/Public/Home/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="http://insist.com/Public/Home/js/jquery.event.drag-1.5.min.js"></script>
<script type="text/javascript" src="http://insist.com/Public/Home/js/jquery.touchSlider.js"></script>
<script type="text/javascript" src="http://insist.com/Public/Home/js/banner.js"></script>


<script type="text/javascript" src="http://insist.com/Public/Home/js/jquery.SuperSlide.2.1.2.js"></script>
<script type="text/javascript" src="http://insist.com/Public/Home/js/tool.js"></script>


</body>
</html>
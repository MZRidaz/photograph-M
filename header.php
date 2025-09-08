<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0">
    <meta name="renderer" content="webkit">
    <!-- 同时支持旧版 iOS 和现代浏览器 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" href="<?php $this->options->themeUrl('favicon.ico'); ?>">
    <link rel="apple-touch-icon" href="<?php $this->options->themeUrl('favicon.ico'); ?>">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
    <!-- 使用url函数转换相关路径 -->
	<link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('lightgallery/css/lightgallery.min.css'); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php $this->options->themeUrl('style.css?'.date('YmdHi')); ?>" />
	<link rel="stylesheet" href="<?php $this->options->themeUrl('custom.css'); ?>">
    <!--[if lt IE 9]>
    <script src="//cdnjscn.b0.upaiyun.com/libs/html5shiv/r29/html5.min.js"></script>
    <script src="//cdnjscn.b0.upaiyun.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>
    
</head>
<body>
<!-- 弹窗 HTML 结构 -->
<div id="customModal" class="custom-modal">
  <div class="custom-modal-content">
    <span class="custom-close">&times;</span>
    <h2>🎉 欢迎访问本站！</h2>
    <p>预览图片数量有限，完整图集请下载⏬。</p>
  </div>
</div>

<!-- 弹窗样式 -->
<style>
.custom-modal {
  display: none;
  position: fixed;
  z-index: 9999;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.5);
  animation: fadeIn 0.5s ease forwards;
}

.custom-modal-content {
  background-color: #fff;
  margin: 15% auto;
  padding: 20px;
  border-radius: 8px;
  width: 80%;
  max-width: 400px;
  position: relative;
  text-align: center;
  box-shadow: 0 5px 15px rgba(0,0,0,0.3);
  opacity: 0;
  transform: translateY(-20px);
  animation: slideIn 0.5s ease forwards;
}

.custom-close {
  position: absolute;
  top: 10px;
  right: 15px;
  font-size: 28px;
  font-weight: bold;
  color: #aaa;
  cursor: pointer;
}
.custom-close:hover {
  color: #000;
}

/* 淡入动画 */
@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

@keyframes slideIn {
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>

<!-- 弹窗脚本 -->
<script>
document.addEventListener("DOMContentLoaded", function() {
  var modal = document.getElementById("customModal");
  var closeBtn = document.querySelector(".custom-close");

  // 检查 sessionStorage 是否已设置
  if (!sessionStorage.getItem("popupShown")) {
    // 显示弹窗
    setTimeout(function() {
      modal.style.display = "block";
      sessionStorage.setItem("popupShown", "true");
    }, 1000); // 延迟 1 秒弹出
  }

  // 点击关闭按钮
  closeBtn.onclick = function() {
    modal.style.display = "none";
  }

  // 点击背景关闭
  window.onclick = function(event) {
    if (event.target === modal) {
      modal.style.display = "none";
    }
  }
});
</script>
<!--[if lt IE 8]>
    <div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>'); ?>.</div>
<![endif]-->
<header class="header">
	<?php
if (!$this->is('index')): // 如果不是首页
    if ($this->is('post') || $this->is('category') || $this->is('archive') || $this->is('search')): ?>
        <a class="header-post-back" href="javascript:history.go(-1);">
            <span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span>
        </a>
    <?php else: ?>
        <a class="header-post-back" href="<?php $this->options->siteUrl(); ?>">
            <span class="glyphicon glyphicon-home" aria-hidden="true"></span>
        </a>
    <?php endif; ?>
<?php endif; ?>

	<h1 class="header-title anti-select"><a href="<?php $this->options->siteUrl(); ?>"><img src="<?php $this->options->themeUrl('logo.png'); ?>" alt="莫可美图"></a></h1>
</header>
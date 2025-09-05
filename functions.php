<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
	$icp = new Typecho_Widget_Helper_Form_Element_Text('icp', NULL, NULL, _t('大天朝身份认证'), _t('填写 ICP 备案号，留空则不显示。'));
	$form->addInput($icp);
	$notice = new Typecho_Widget_Helper_Form_Element_Textarea('notice', NULL, NULL, _t('网站公告'), _t('填写网站公告，留空则不显示。'));
	$form->addInput($notice);
	$statistics = new Typecho_Widget_Helper_Form_Element_Textarea('statistics', NULL, NULL, _t('统计代码'), _t('填写统计平台生成的统计代码，该内容在页面隐藏生效，留空则不生效。'));
	$form->addInput($statistics);
	$picdesc = new Typecho_Widget_Helper_Form_Element_Textarea('picdesc', NULL, NULL, _t('组图默认描述'), _t('填写组图的默认描述，优先级低于“自定义字段”的值，留空则显示“未填写”。'));
	$form->addInput($picdesc);
}

//文章缩略图
function showThumb($obj, $link = false) {
    preg_match_all( "/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $obj->content, $matches);
    $thumb = '';
    $options = Typecho_Widget::widget('Widget_Options');
    $attach = $obj->attachments(1)->attachment; 
    if (isset($attach->isImage) && $attach->isImage == 1) {
        $thumb = $attach->url;   //附件是图片 输出附件
    } elseif (isset($matches[1][0])) {
        $thumb = $matches[1][0];  //文章内容中抓到了图片 输出链接
    }
	//空的话输出默认随机图
	$thumb = empty($thumb) ? $options->themeUrl .'/img/' . rand(1, 14) . '.jpg' : $thumb;	
    if($link) {
        return $thumb;
    }
	else {
		$thumb='<img src="'.$thumb.'">';
		return $thumb;
	}
}

//获取附件图片
function getAttachImg($cid) {
	$db = Typecho_Db::get();
	$rs = $db->fetchAll($db->select('table.contents.text')
			->from('table.contents')
			->where('table.contents.parent=?', $cid)
			->order('table.contents.cid', Typecho_Db::SORT_ASC));
	$attachPath = array();
	foreach($rs as $attach) {
		$attach = unserialize($attach['text']);
		if($attach['mime'] == 'image/jpeg') {
			$attachPath[] = array($attach['name'], '//m.mcoo.cc'.$attach['path']);
		}
    }
	return $attachPath;
}

//自定义字段
function themeFields($layout) {
    // 可插入多地址的模特主页字段，分多个社交平台
    $src_twitter = new Typecho_Widget_Helper_Form_Element_Text('src_twitter', NULL, NULL, _t('推特'), _t(''));
    $layout->addItem($src_twitter);
    
    $src_instagram = new Typecho_Widget_Helper_Form_Element_Text('src_instagram', NULL, NULL, _t('Instagram'), _t(''));
    $layout->addItem($src_instagram);
    
    $src_douyin = new Typecho_Widget_Helper_Form_Element_Text('src_douyin', NULL, NULL, _t('抖音'), _t(''));
    $layout->addItem($src_douyin);
    
    $src_weibo = new Typecho_Widget_Helper_Form_Element_Text('src_weibo', NULL, NULL, _t('微博'), _t(''));
    $layout->addItem($src_weibo);
    
    $src_other = new Typecho_Widget_Helper_Form_Element_Text('src_other', NULL, NULL, _t('其他'), _t(''));
    $layout->addItem($src_other);
    
    // 下载地址字段
    $terabox_url = new Typecho_Widget_Helper_Form_Element_Text('terabox_url', NULL, NULL, _t('TeraBox'), _t(''));
    $layout->addItem($terabox_url);

    $quark_url = new Typecho_Widget_Helper_Form_Element_Text('quark_url', NULL, NULL, _t('夸克'), _t(''));
    $layout->addItem($quark_url);

    $baidu_url = new Typecho_Widget_Helper_Form_Element_Text('baidu_url', NULL, NULL, _t('百度'), _t(''));
    $layout->addItem($baidu_url);
    
    // 封面图片字段
    $thumb = new Typecho_Widget_Helper_Form_Element_Text('thumb', NULL, NULL, _t('封面图片'), _t(''));
    $layout->addItem($thumb);
}


//以下函数未启用
function themeInit($archive){
    if ($archive->is('single')){
    		//$archive->content = image_class_replace($archive->content);
    }
}

function image_class_replace($content){
    $content = preg_replace('#<img(.*?) src="([^"]*/)?(([^"/]*)\.[^"]*)"(.*?)>#', '<div class="post-item layui-col-xs6 layui-col-sm4 layui-col-md3"><img$1 src="$2$3"$5 class="post-item-img"></div>', $content);
    return $content;
}
<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="content">
<div id="masonry" class="post row">
    <?php
        $imgs = getAttachImg($this->cid);
        foreach($imgs as $img) {
            echo "<div class=\"post-item col-6 col-sm-4 col-md-3\" data-src=\"$img[1]\"><img src=\"$img[1]\" title=\"$img[0]\" class=\"post-item-img\"></div>";
        }
    ?>
</div>

<div class="post-info">
    <div class="post-info-box"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span><span class="post-info-title anti-select">标题：</span><span class="post-info-text"><?php echo $this->title ?></span></div>
    <div class="post-info-box"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span><span class="post-info-title anti-select">分类：</span><span class="post-info-text"><?php $this->category(','); ?></span></div>
<!-- 模特主页链接显示 -->
<div class="post-info-box">
    <span class="glyphicon glyphicon-link" aria-hidden="true"></span>
    <span class="post-info-title anti-select"><strong>模特主页：</strong></span>
    <span class="post-info-text">
        <?php
        // 检查是否有任何社交链接
        $has_social = false;
        
        // 判断推特主页是否填写
        if ($this->fields->src_twitter && $this->fields->src_twitter != ''):
            $has_social = true; ?>
            <a href="<?php echo $this->fields->src_twitter; ?>" target="_blank">推特</a>
        <?php endif; ?>
        
        <!-- 判断 Instagram 主页是否填写 -->
        <?php if ($this->fields->src_instagram && $this->fields->src_instagram != ''):
            $has_social = true; ?>
            <a href="<?php echo $this->fields->src_instagram; ?>" target="_blank">Instagram</a>
        <?php endif; ?>
        
        <!-- 判断抖音主页是否填写 -->
        <?php if ($this->fields->src_douyin && $this->fields->src_douyin != ''):
            $has_social = true; ?>
            <a href="<?php echo $this->fields->src_douyin; ?>" target="_blank">抖音</a>
        <?php endif; ?>
        
        <!-- 判断微博主页是否填写 -->
        <?php if ($this->fields->src_weibo && $this->fields->src_weibo != ''):
            $has_social = true; ?>
            <a href="<?php echo $this->fields->src_weibo; ?>" target="_blank">微博</a>
        <?php endif; ?>
        
        <!-- 判断 其他主页 是否填写 -->
        <?php if ($this->fields->src_other && $this->fields->src_other != ''):
            $has_social = true; ?>
            <a href="<?php echo $this->fields->src_other; ?>" target="_blank">其他</a>
        <?php endif; ?>
        
        <!-- 如果没有任何社交链接，显示"暂无" -->
        <?php if (!$has_social): ?>
            暂无
        <?php endif; ?>
    </span>
</div>

<!-- 下载地址字段显示 -->
<div class="post-info-box">
    <span class="glyphicon glyphicon-cloud-download" aria-hidden="true"></span>
    <span class="post-info-title anti-select"><strong>下载地址：</strong></span>
    <span class="post-info-text">
        <?php
        // 检查是否有任何下载链接
        $has_download = false;
        
        // 检查 TeraBox 地址是否填写
        if ($this->fields->terabox_url && $this->fields->terabox_url != ''):
            $has_download = true; ?>
            <a href="<?php echo $this->fields->terabox_url; ?>" target="_blank">TeraBox</a>
        <?php endif; ?>

        <!-- 检查 夸克 地址是否填写 -->
        <?php if ($this->fields->quark_url && $this->fields->quark_url != ''):
            $has_download = true; ?>
            <a href="<?php echo $this->fields->quark_url; ?>" target="_blank">夸克</a>
        <?php endif; ?>

        <!-- 检查 百度网盘 地址是否填写 -->
        <?php if ($this->fields->baidu_url && $this->fields->baidu_url != ''):
            $has_download = true; ?>
            <a href="<?php echo $this->fields->baidu_url; ?>" target="_blank">百度网盘</a>
        <?php endif; ?>
        
        <!-- 如果没有任何下载链接，显示"暂无" -->
        <?php if (!$has_download): ?>
            暂无
        <?php endif; ?>
    </span>
</div>

</div>

<?php if ($this->is('post')): ?>
    <div class="related-posts">
        <div class="related-posts-container">
            <?php
                // 获取当前文章的相关文章，最多5篇
                $this->related(5)->to($relatedPosts);
                if ($relatedPosts->have()) {
                    while ($relatedPosts->next()) {
                        $postUrl = $relatedPosts->permalink;
                        $postTitle = $relatedPosts->title;
                        // 使用现有的showThumb函数获取缩略图
                        $thumbUrl = showThumb($relatedPosts, true);
                        echo <<<HTML
                        <div class="related-post-item">
                            <a href="{$postUrl}" title="{$postTitle}">
                                <div class="thumb-container">
                                    <img src="{$thumbUrl}" alt="{$postTitle}" class="related-post-thumb">
                                </div>
                                <p class="related-post-title">{$postTitle}</p>
                            </a>
                        </div>
HTML;
                    }
                } else {
                    echo '<p class="no-related">暂无相关文章</p>';
                }
            ?>
        </div>
    </div>
    <!-- 相关文章结束 -->
<?php endif; ?>
</div>

<!--a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a-->

<!-- end #main-->

<?php //$this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>

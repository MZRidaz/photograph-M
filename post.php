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
		<div class="post-info-box"><span class="glyphicon glyphicon-camera" aria-hidden="true"></span><span class="post-info-title anti-select">拍摄/来源：</span><span class="post-info-text"><?php echo $this->fields->photog != "" ? ($this->fields->srcurl != "" ? '<a href="'.$this->fields->srcurl.'" target="_blank">'.$this->fields->photog.'</a>' : $this->fields->photog) : '未填写' ?></span></div>
		<div class="post-info-box"><span class="glyphicon glyphicon-user" aria-hidden="true"></span><span class="post-info-title anti-select">出镜：</span><span class="post-info-text"><?php echo $this->fields->appear != "" ? $this->fields->appear : '未知' ?></span></div>
		<div class="post-info-box"><span class="glyphicon glyphicon-adjust" aria-hidden="true"></span><span class="post-info-title anti-select">处理软件：</span><span class="post-info-text"><?php echo afterSoftware()[$this->fields->software] ?></span></div>
		<span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span><span class="post-info-title anti-select">描述：</span><span class="post-info-text"><?php echo $this->fields->description != "" ? $this->fields->description : ($this->options->picdesc ? $this->options->picdesc : '未填写') ?></span>
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

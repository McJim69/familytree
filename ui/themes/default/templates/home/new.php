        <div class="feed-header-bar">
            <h2 class="feed-title"><?php echo $TMPL['textWhatsNew']; ?></h2>
            <a class="rss-btn" href="rss.php?feed=all">📡 <?php echo $TMPL['textRssFeed']; ?></a>
        </div>

<?php foreach ($TMPL['new'] as $new): ?>
    <?php if (isset($new['textDateHeading'])): ?>
        <div class="feed-date-divider"><span><?php echo $new['textDateHeading']; ?></span></div>
    <?php else: ?>
        <div id="<?php echo $new['position']; ?>" class="feed-card <?php echo $new['class']; ?>">
            <div class="feed-card-header">
                <a class="feed-avatar-link" href="profile.php?member=<?php echo $new['userId']; ?>">
                    <img class="feed-avatar" src="<?php echo $new['avatar']; ?>" alt="<?php echo $new['displayname']; ?>"/>
                </a>
                <div class="feed-user-meta">
                    <a class="feed-username" href="profile.php?member=<?php echo $new['userId']; ?>"><?php echo $new['displayname']; ?></a>
                    <span class="feed-timestamp"><?php echo $new['timeSince']; ?></span>
                </div>
            </div>
            
            <div class="feed-card-body">
                <div class="feed-info-text"><?php echo $new['textInfo']; ?></div>

        <?php if (isset($new['title']) && !empty($new['title'])): ?>
                <div class="feed-object-card">
                    <h5 class="feed-object-title"><?php echo $new['title']; ?></h5>
                    <div class="feed-object-details"><?php echo $new['details']; ?></div>
                </div>
        <?php endif; ?>

        <?php if (isset($new['children']) && !empty($new['children'])): ?>
                <div class="feed-comments-container">
            <?php foreach ($new['children'] as $child): ?>
                    <div class="feed-comment-item <?php echo $child['class']; ?>">
                        <a href="profile.php?member=<?php echo $child['userId']; ?>">
                            <img class="feed-comment-avatar" src="<?php echo $child['avatar']; ?>" alt="<?php echo $child['displayname']; ?>"/>
                        </a>
                        <div class="feed-comment-content">
                            <div class="feed-comment-meta">
                                <a class="feed-username" href="profile.php?member=<?php echo $child['userId']; ?>"><?php echo $child['displayname']; ?></a>
                                <span class="feed-timestamp"><?php echo $child['timeSince']; ?></span>
                            </div>
                            <div class="feed-comment-text"><?php echo $child['textInfo']; ?></div>
                        </div>
                    </div>
            <?php endforeach; ?>
                </div>
        <?php endif; ?>

        <?php if (isset($new['textReply'])): ?>
                <div class="feed-reply-box">
                    <form method="post" action="home.php">
                        <input type="text" class="feed-reply-input" name="status" placeholder="<?php echo $new['textReply']; ?>..." title="<?php echo $new['textReply']; ?>"/>
                        <input type="hidden" name="parent" value="<?php echo $new['replyParentId']; ?>"/>
                        <button type="submit" class="feed-reply-btn" name="status_submit"><?php echo $new['textReply']; ?></button>
                    </form>
                </div>
        <?php endif; ?>

            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>


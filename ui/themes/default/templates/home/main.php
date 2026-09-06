<?php if (isset($TMPL['events'])): ?>
        <div id="todaysevents" class="card modern-events-card">
            <h2 class="card-title">🎉 <?php echo $TMPL['textTodaysEvents']; ?></h2>
<?php foreach ($TMPL['events'] as $e): ?>
            <div class="events-item">
                <span class="event-title"><?php echo $e['title']; ?></span>
                <?php if (isset($e['desc'])): ?><span class="event-desc"><?php echo $e['desc']; ?></span><?php endif; ?>
            </div>
<?php endforeach; ?>
        </div>
<?php endif; ?>

        <div id="status_update" class="card modern-share-card">
            <form method="post" action="home.php">
                <textarea id="status" class="modern-textarea" name="status" 
                    placeholder="<?php echo $TMPL['textSharePlaceholder']; ?>..." title="<?php echo $TMPL['textShareTitle']; ?>"></textarea>
                <div class="share-actions">
<?php if (isset($TMPL['textUpdateFacebook'])): ?>
                    <label class="fb-checkbox-label">
                        <input type="checkbox" id="update_fb" name="update_fb"/>
                        <span><?php echo $TMPL['textUpdateFacebook']; ?></span>
                    </label>
<?php endif; ?>
                    <button type="submit" id="status_submit" class="btn-share-submit" name="status_submit">
                        <?php echo $TMPL['textSubmit']; ?>
                    </button>
                </div>
            </form>
        </div>


    <nav id="topmenu">
        <div class="nav-container">
            <button id="mobile-menu-toggle" aria-label="Toggle Navigation">
                <span class="hamburger-icon"></span>
                <span><?php echo T_('Menu');?></span>
            </button>
            <ul id="navigation">
                <li class="main">
                    <a class="main-link" href="<?php echo $TMPL['path'].'index.php';?>"><?php echo T_pgettext('The beginning or starting place.', 'Home');?></a>
                </li>
                <li class="main dropdown">
                    <a class="main-link" href="<?php echo $TMPL['path'].$TMPL['nav-link'][2][0]['url'];?>"><?php echo $TMPL['nav-link']['my-stuff'];?> <span class="caret">▼</span></a>
                    <ul class="sub">
    <?php foreach($TMPL['nav-link'][2] as $nav): ?>
                        <li class="sub-item"><a class="sub-link" href="<?php echo $TMPL['path'].$nav['url'];?>"><?php echo $nav['text'];?></a></li>
    <?php endforeach; ?>
                    </ul>
                </li>
                <li class="main dropdown">
                    <a class="main-link" href="<?php echo $TMPL['path'].$TMPL['nav-link'][3][0]['url'];?>"><?php echo T_('Communicate');?> <span class="caret">▼</span></a>
                    <ul class="sub">
    <?php foreach($TMPL['nav-link'][3] AS $nav): ?>
                        <li class="sub-item"><a class="sub-link" href="<?php echo $TMPL['path'].$nav['url'];?>"><?php echo $nav['text'];?></a></li>
    <?php endforeach; ?>
                    </ul>
                </li>
                <li class="main dropdown">
                    <a class="main-link" href="<?php echo $TMPL['path'].$TMPL['nav-link'][4][0]['url'];?>"><?php echo T_('Share');?> <span class="caret">▼</span></a>
                    <ul class="sub">
    <?php foreach($TMPL['nav-link'][4] AS $nav):?>
                        <li class="sub-item"><a class="sub-link" href="<?php echo $TMPL['path'].$nav['url'];?>"><?php echo $nav['text'];?></a></li>
    <?php endforeach; ?>
                    </ul>
                </li>
                <li class="main dropdown">
                    <a class="main-link" href="<?php echo $TMPL['path'].'members.php';?>"><?php echo T_('Misc.');?> <span class="caret">▼</span></a>
                    <ul class="sub">
    <?php foreach($TMPL['nav-link'][5] AS $nav):?>
                        <li class="sub-item"><a class="sub-link" href="<?php echo $TMPL['path'].$nav['url'];?>"><?php echo $nav['text'];?></a></li>
    <?php endforeach; ?>
                    </ul>
                </li>
    <?php if (isset($TMPL['nav-link'][6])): ?>
                <li class="main">
                    <a class="main-link admin-link" href="<?php echo $TMPL['path'].'admin/index.php';?>"><?php echo T_('Administration');?></a>
                </li>
    <?php endif; ?>
            </ul>
        </div>
    </nav>

    <script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#mobile-menu-toggle').on('click', function(e) {
            e.preventDefault();
            $('#navigation').toggleClass('open');
        });
    });
    </script>


            <form enctype="multipart/form-data" method="post" action="calendar.php">
                <fieldset class="add-edit big">
                    <legend>
                        <span><?php echo T_('Import'); ?></span>
                    </legend>
                    <p>
                        <input class="frm_file" type="file" id="file" name="file"/>
                    </p>
                    <p>
                        <input type="submit" class="sub1" name="import" value="<?php echo T_('Import'); ?>"/> &nbsp;
                        <a class="sub1 secondary" href="calendar.php"><?php echo T_('Cancel'); ?></a>
                    </p>
                </fieldset>
            </form>

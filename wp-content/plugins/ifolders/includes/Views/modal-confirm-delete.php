<?php
defined( 'ABSPATH' ) || exit;
?>
<div class="ifs-modal">
    <div class="ifs-dialog">
        <div class="ifs-header">
            <div class="ifs-title"><?php esc_html_e("Confirm", 'ifolders'); ?></div>
            <div class="ifs-cancel" al-on.click="Modal.fn.close()"><i data-feather="x"></i></div>
        </div>
        <div class="ifs-data">
            <div class="ifs-loader" al-attr.class.ifs-active="Modal.loading"></div>
            <p><?php esc_html_e("Are you sure you want to delete {{Modal.data.count}} items?", 'ifolders'); ?></p>
        </div>
        <div class="ifs-footer">
            <div class="ifs-btn ifs-cancel" al-on.click="Modal.fn.close()"><?php esc_html_e("Cancel", 'ifolders'); ?></div>
            <div class="ifs-btn ifs-delete" al-on.click="Modal.fn.submit()"><?php esc_html_e("Delete", 'ifolders'); ?></div>
        </div>
    </div>
</div>
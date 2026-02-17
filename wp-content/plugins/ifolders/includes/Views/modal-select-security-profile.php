<?php
defined( 'ABSPATH' ) || exit;
?>
<div class="ifs-modal">
    <div class="ifs-dialog">
        <div class="ifs-header">
            <div class="ifs-title"><?php esc_html_e("Select Security", 'ifolders'); ?></div>
            <div class="ifs-cancel" al-on.click="Modal.fn.close()"><i data-feather="x"></i></div>
        </div>
        <div class="ifs-data">
            <div class="ifs-loader" al-attr.class.ifs-active="Modal.loading"></div>
            <p><?php esc_html_e("Select a registered security role from the list below if you want to change it.", 'ifolders'); ?></p>
            <select class="ifs-select" al-select="Modal.data.selected">
                <option al-option="null"><?php esc_html_e("None", 'ifolders'); ?></option>
                <option al-repeat="item in Modal.data.items" al-option="item">{{item.title}}</option>
            </select>
        </div>
        <div class="ifs-footer">
            <div class="ifs-btn ifs-cancel" al-on.click="Modal.fn.close()"><?php esc_html_e("Close", 'ifolders'); ?></div>
            <div class="ifs-btn ifs-submit" al-on.click="Modal.fn.submit()"><?php esc_html_e("Select", 'ifolders'); ?></div>
        </div>
    </div>
</div>

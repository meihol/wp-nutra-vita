<?php
defined( 'ABSPATH' ) || exit;
?>
<div class="ifs-modal">
    <div class="ifs-dialog">
        <div class="ifs-header">
            <div class="ifs-title" al-if="!Modal.data.item.id"><?php esc_html_e("New Folder Type", 'ifolders'); ?></div>
            <div class="ifs-title" al-if="Modal.data.item.id"><?php esc_html_e("Edit Folder Type", 'ifolders'); ?></div>
            <div class="ifs-cancel" al-on.click="Modal.fn.close()"><i data-feather="x"></i></div>
        </div>
        <div class="ifs-data">
            <div class="ifs-loader" al-attr.class.ifs-active="Modal.loading"></div>
            <div class="ifs-input-group">
                <input class="ifs-input" al-value="Modal.data.item.title" type="text" placeholder="<?php esc_html_e("Title", 'ifolders'); ?>">
            </div>
            <select class="ifs-select" al-select="Modal.data.item.security_profile">
                <option al-option="Modal.data.securityprofiles.none"><?php esc_html_e("None", 'ifolders'); ?></option>
                <option al-repeat="item in Modal.data.securityprofiles.items" al-option="item">{{item.title}}</option>
            </select>
            <div al-toggle="Modal.data.item.enabled"></div>
        </div>
        <div class="ifs-footer">
            <div class="ifs-btn ifs-cancel" al-on.click="Modal.fn.close()"><?php esc_html_e("Close", 'ifolders'); ?></div>
            <div class="ifs-btn ifs-submit" al-on.click="Modal.fn.submit()" al-if="Modal.data.changed"><?php esc_html_e("Submit", 'ifolders'); ?></div>
        </div>
    </div>
</div>
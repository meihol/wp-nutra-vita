<?php
defined( 'ABSPATH' ) || exit;
?>
<div class="ifs-modal">
    <div class="ifs-dialog">
        <div class="ifs-header">
            <div class="ifs-title" al-if="!Modal.data.item.id"><?php esc_html_e("New Security Rights", 'ifolders'); ?></div>
            <div class="ifs-title" al-if="Modal.data.item.id"><?php esc_html_e("Edit Security Rights", 'ifolders'); ?></div>
            <div class="ifs-cancel" al-on.click="Modal.fn.close()"><i data-feather="x"></i></div>
        </div>
        <div class="ifs-data">
            <div class="ifs-loader" al-attr.class.ifs-active="Modal.loading"></div>
            <div class="ifs-input-group">
                <input class="ifs-input ifs-has-changer" type="text" readonly="readonly" al-value="Modal.data.item.owner.title" placeholder="<?php esc_html_e("Select user or role", 'ifolders'); ?>">
                <div class="ifs-changer ifs-icon" al-attr.class.ifs-active="Modal.data.item.owner.type == 'user'" al-on.click="Modal.fn.selectUser()" title="<?php esc_html_e("Select user", 'ifolders'); ?>"> <i data-feather="user"></i></div>
                <div class="ifs-changer ifs-icon" al-attr.class.ifs-active="Modal.data.item.owner.type == 'role'" al-on.click="Modal.fn.selectRole()" title="<?php esc_html_e("Select role", 'ifolders'); ?>"> <i data-feather="users"></i></div>
            </div>

            <select class="ifs-select" al-select="Modal.data.item.access_type">
                <option al-option="Modal.data.access_types.none"><?php esc_html_e("None", 'ifolders'); ?></option>
                <option al-repeat="item in Modal.data.access_types.items" al-option="item">{{item.title}}</option>
            </select>
            <div class="ifs-checklist">
                <label><input type="checkbox" al-checked="Modal.data.item.actions.create"><?php esc_html_e("Create", 'ifolders'); ?><span title="<?php esc_html_e("users can create folders and subfolders, don't forget to give the view permission too", 'ifolders'); ?>"><i data-feather="help-circle"></i></span></label>
                <label><input type="checkbox" al-checked="Modal.data.item.actions.view"><?php esc_html_e("View", 'ifolders'); ?><span title="<?php esc_html_e("users can view the folder tree", 'ifolders'); ?>"><i data-feather="help-circle"></i></span></label>
                <label><input type="checkbox" al-checked="Modal.data.item.actions.edit"><?php esc_html_e("Edit", 'ifolders'); ?><span title="<?php esc_html_e("users can edit folders (rename, drag & drop)", 'ifolders'); ?>"><i data-feather="help-circle"></i></span></label>
                <label><input type="checkbox" al-checked="Modal.data.item.actions.delete"><?php esc_html_e("Delete", 'ifolders'); ?><span title="<?php esc_html_e("users can delete folders", 'ifolders'); ?>"><i data-feather="help-circle"></i></span></label>
                <label><input type="checkbox" al-checked="Modal.data.item.actions.attach"><?php esc_html_e("Attach", 'ifolders'); ?><span title="<?php esc_html_e("users can attach items to folders, like media files, posts, pages, etc.", 'ifolders'); ?>"><i data-feather="help-circle"></i></span></label>
            </div>
        </div>
        <div class="ifs-footer">
            <div class="ifs-btn ifs-cancel" al-on.click="Modal.fn.close()"><?php esc_html_e("Close", 'ifolders'); ?></div>
            <div class="ifs-btn ifs-submit" al-on.click="Modal.fn.submit()" al-if="Modal.data.changed"><?php esc_html_e("Submit", 'ifolders'); ?></div>
        </div>
    </div>
</div>

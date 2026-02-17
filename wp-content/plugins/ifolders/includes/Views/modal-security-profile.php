<?php
defined( 'ABSPATH' ) || exit;
?>
<div class="ifs-modal">
    <div class="ifs-dialog">
        <div class="ifs-header">
            <div class="ifs-title" al-if="!Modal.data.item.id"><?php esc_html_e("New Security Profile", 'ifolders'); ?></div>
            <div class="ifs-title" al-if="Modal.data.item.id"><?php esc_html_e("Edit Security Profile", 'ifolders'); ?></div>
            <div class="ifs-cancel" al-on.click="Modal.fn.close()"><i data-feather="x"></i></div>
        </div>
        <div class="ifs-data">
            <div class="ifs-loader" al-attr.class.ifs-active="Modal.loading"></div>
            <div class="ifs-input-group">
                <input class="ifs-input" al-value="Modal.data.item.title" type="text" placeholder="<?php esc_html_e("Title", 'ifolders'); ?>">
            </div>
            <textarea class="ifs-textarea" al-value="Modal.data.item.description" placeholder="<?php esc_html_e("Description", 'ifolders'); ?>"></textarea>
            <div class="ifs-table">
                <div class="ifs-table-header">
                    <div class="ifs-left-group">
                        <div class="ifs-btn" al-on.click="Modal.fn.create()" title="<?php esc_html_e("Add new profile", 'ifolders'); ?>">
                            <i data-feather="plus"></i>
                        </div>
                        <div class="ifs-btn" al-attr.class.ifs-lock="!Modal.data.item.rights.selected" al-on.click="Modal.fn.edit()" title="<?php esc_html_e("Edit rights", 'ifolders'); ?>">
                            <i data-feather="edit-3"></i>
                        </div>
                        <div class="ifs-btn ifs-red" al-attr.class.ifs-lock="!Modal.data.item.rights.checked" al-on.click="Modal.fn.delete()" title="<?php esc_html_e("Delete selected rights", 'ifolders'); ?>">
                            <i data-feather="trash-2"></i>
                        </div>
                    </div>
                    <div class="ifs-right-group">
                    </div>
                </div>
                <div class="ifs-table-body">
                    <table>
                        <colgroup>
                            <col class="ifs-field-check"/>
                            <col class="ifs-field-user-role"/>
                            <col class="ifs-field-access-type"/>
                            <col class="ifs-field-action"/>
                            <col class="ifs-field-action"/>
                            <col class="ifs-field-action"/>
                            <col class="ifs-field-action"/>
                            <col class="ifs-field-action"/>
                        </colgroup>
                        <thead>
                        <tr>
                            <th><input type="checkbox" al-checked="Modal.data.item.rights.checked" al-on.change="App.fn.selectAll($event, Modal.data.item.rights.checked, Modal.data.item.rights, Modal.scope)"></th>
                            <th><?php esc_html_e("User / Role", 'ifolders'); ?></th>
                            <th><?php esc_html_e("Access Type", 'ifolders'); ?></th>
                            <th class="ifs-center"><?php esc_html_e("Create", 'ifolders'); ?></th>
                            <th class="ifs-center"><?php esc_html_e("View", 'ifolders'); ?></th>
                            <th class="ifs-center"><?php esc_html_e("Edit", 'ifolders'); ?></th>
                            <th class="ifs-center"><?php esc_html_e("Delete", 'ifolders'); ?></th>
                            <th class="ifs-center"><?php esc_html_e("Attach", 'ifolders'); ?></th>
                        </tr>
                        </thead>
                        <tbody al-if="Modal.data.item.rights.items.length">
                        <tr al-repeat="item in Modal.data.item.rights.items" al-attr.class.ifs-selected="Modal.data.item.rights.selected == item.id" al-on.click.noprevent="Modal.fn.select(item)" al-on.dblclick="Modal.fn.dblclick(item)">
                            <td><input type="checkbox" al-checked="item.checked" al-on.change="App.fn.selectOne($event, item.checked, Modal.data.item.rights, Modal.scope)"></td>
                            <td><div class="ifs-icon" al-if="item.owner.id" al-attr.class.ifs-user="item.owner.type=='user'" al-attr.class.ifs-role="item.owner.type=='role'"></div><span>{{item.owner.title}}</span></td>
                            <td><div class="ifs-label" al-if="item.access_type.id">{{item.access_type.title}}</div></td>
                            <td><input type="checkbox" al-checked="item.actions.create"></td>
                            <td><input type="checkbox" al-checked="item.actions.view"></td>
                            <td><input type="checkbox" al-checked="item.actions.edit"></td>
                            <td><input type="checkbox" al-checked="item.actions.delete"></td>
                            <td><input type="checkbox" al-checked="item.actions.attach"></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="ifs-table-footer">
                    <div class="ifs-info ifs-left" al-if="!Modal.data.item.rights.items.length"><?php esc_html_e("The table is empty", 'ifolders'); ?></div>
                </div>
            </div>
        </div>
        <div class="ifs-footer">
            <div class="ifs-btn ifs-cancel" al-on.click="Modal.fn.close()"><?php esc_html_e("Close", 'ifolders'); ?></div>
            <div class="ifs-btn ifs-submit" al-on.click="Modal.fn.submit()" al-if="Modal.data.changed"><?php esc_html_e("Submit", 'ifolders'); ?></div>
        </div>
    </div>
</div>

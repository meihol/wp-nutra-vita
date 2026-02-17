<?php
defined( 'ABSPATH' ) || exit;
?>
<div class="ifs-wrap">
    <div class="ifs-app-settings" id="ifs-app-settings" style="display:none">
        <div class="ifs-main-header">
            <div class="ifs-title">iFOLDERS<sup al-if="!App.data.ticket">lite</sup><sup al-if="App.data.ticket">PRO</sup></div>
            <div class="ifs-tabs">
                <div class="ifs-tab" al-attr.class.ifs-active="App.ui.tabs.fn.is('general')" al-on.click="App.ui.tabs.fn.click($element, 'general')"><span><?php esc_html_e("General", 'ifolders'); ?></span></div>
                <div class="ifs-tab" al-attr.class.ifs-active="App.ui.tabs.fn.is('permissions')" al-on.click="App.ui.tabs.fn.click($element, 'permissions')"><span><?php esc_html_e("Permissions", 'ifolders'); ?></span></div>
                <div class="ifs-tab" al-attr.class.ifs-active="App.ui.tabs.fn.is('tools')" al-on.click="App.ui.tabs.fn.click($element, 'tools')"><span><?php esc_html_e("Tools", 'ifolders'); ?></span></div>
                <div class="ifs-tab" al-attr.class.ifs-active="App.ui.tabs.fn.is('gopro')" al-on.click="App.ui.tabs.fn.click($element, 'gopro')" al-if="!App.data.ticket"><span><?php esc_html_e("Go Pro", 'ifolders'); ?></span></div>
            </div>
        </div>
        <div class="ifs-main-container">
            <div class="ifs-content">
                <div class="ifs-loader ifs-active" id="ifs-loader">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="ifs-ph-panel">
                    <div class="ifs-ph-option">
                        <div class="ifs-ph-description">
                            <div class="ifs-ph-title"></div>
                            <div class="ifs-ph-text"></div>
                        </div>
                        <div class="ifs-ph-data">
                            <div class="ifs-ph-control"></div>
                        </div>
                    </div>
                    <div class="ifs-spacer"></div>
                    <div class="ifs-ph-option">
                        <div class="ifs-ph-description">
                            <div class="ifs-ph-title"></div>
                            <div class="ifs-ph-text"></div>
                        </div>
                        <div class="ifs-ph-data">
                            <div class="ifs-ph-control"></div>
                        </div>
                    </div>
                    <div class="ifs-spacer"></div>
                    <div class="ifs-ph-option">
                        <div class="ifs-ph-description">
                            <div class="ifs-ph-title"></div>
                            <div class="ifs-ph-text"></div>
                        </div>
                        <div class="ifs-ph-data">
                            <div class="ifs-ph-control"></div>
                        </div>
                    </div>
                    <div class="ifs-spacer"></div>
                    <div class="ifs-ph-option">
                        <div class="ifs-ph-description">
                            <div class="ifs-ph-title"></div>
                            <div class="ifs-ph-text"></div>
                        </div>
                        <div class="ifs-ph-data">
                            <div class="ifs-ph-control"></div>
                        </div>
                    </div>
                </div>
                <div class="ifs-panel" al-attr.class.ifs-active="App.ui.tabs.fn.is('general')">
                    <div class="ifs-option">
                        <div class="ifs-description">
                            <div class="ifs-title"><?php esc_html_e("Purchase Code", 'ifolders'); ?></div>
                            <div class="ifs-text"><?php esc_html_e("To enable all the professional features of the plugin, enter your purchase code and activate it.", 'ifolders'); ?></div>
                        </div>
                        <div class="ifs-data">
                            <div class="ifs-input-group">
                                <input class="ifs-input ifs-monospace ifs-text-center" type="text" placeholder="XXXXXXXX-XXXX-XXXX-XXXX-XXXXXXXXXXXX" maxlength="36" al-value="App.data.code" al-if="!App.data.ticket">
                                <input class="ifs-input ifs-monospace ifs-hide-text ifs-text-center" type="text" maxlength="36" readonly al-value="App.data.ticket.code" al-if="App.data.ticket">
                                <div class="ifs-button ifs-activate" al-on.click="App.fn.ticket.activate()" al-if="!App.data.ticket"><?php esc_html_e("Activate License", 'ifolders'); ?></div>
                                <div class="ifs-button ifs-deactivate" al-on.click="App.fn.ticket.deactivate()" al-if="App.data.ticket"><?php esc_html_e("Deactivate License", 'ifolders'); ?></div>
                            </div>
                            <div class="ifs-ticket" al-if="App.data.ticket">
                                <div><b>Product:</b> {{App.data.ticket.product}}</div>
                                <div><b>Domain:</b> {{App.data.ticket.site}}</div>
                                <div><b>Supported Until:</b> {{App.data.ticket.supported_until}}</div>
                                <div class="ifs-footer">
                                    <?php esc_html_e("The license is active and valid for this domain", 'ifolders'); ?>
                                </div>
                            </div>
                            <div class="ifs-note" al-if="App.data.ticket">
                                <?php esc_html_e("Note: If you're on a development site and you want to activate this license later on the production domain, please deactivate it first.", 'ifolders'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="ifs-spacer"></div>
                    <div class="ifs-option" al-attr.class.ifs-lock="!App.data.ticket">
                        <div class="ifs-description">
                            <div class="ifs-title"><?php esc_html_e("Default folder color", 'ifolders'); ?></div>
                            <div class="ifs-text"><?php esc_html_e("Set the default color for all folders that don't have their own colors.", 'ifolders'); ?></div>
                        </div>
                        <div class="ifs-data">
                            <div class="ifs-color-picker-wrap"><div id="ifs-default-folder-color" class="ifs-color-picker" al-on.click="App.fn.config.onColorClick($event)"></div></div>
                            <div class="ifs-upgrade"><i data-feather="star"></i><div al-html="App.globals.msg.upgrade"></div></div>
                        </div>
                    </div>
                    <div class="ifs-spacer"></div>
                    <div class="ifs-option" al-attr.class.ifs-lock="!App.data.ticket">
                        <div class="ifs-description">
                            <div class="ifs-title"><?php esc_html_e("Disable folder counter", 'ifolders'); ?></div>
                            <div class="ifs-text"><?php esc_html_e("Disable the display of the number of items attached to each folder.", 'ifolders'); ?></div>
                        </div>
                        <div class="ifs-data">
                            <div al-toggle="App.data.config.disable_counter" al-on.click.stop="App.fn.config.onCheckboxChange($event)"></div>
                            <div class="ifs-upgrade"><i data-feather="star"></i><div al-html="App.globals.msg.upgrade"></div></div>
                        </div>
                    </div>
                    <div class="ifs-spacer"></div>
                    <div class="ifs-option" al-attr.class.ifs-lock="!App.data.ticket">
                        <div class="ifs-description">
                            <div class="ifs-title"><?php esc_html_e("Disable ajax refresh", 'ifolders'); ?></div>
                            <div class="ifs-text"><?php esc_html_e("Disable ajax refresh in list view. Set when there are problems with using plugins along with iFolders that change the media library list view.", 'ifolders'); ?></div>
                        </div>
                        <div class="ifs-data">
                            <div al-toggle="App.data.config.disable_ajax" al-on.click.stop="App.fn.config.onCheckboxChange($event)"></div>
                            <div class="ifs-upgrade"><i data-feather="star"></i><div al-html="App.globals.msg.upgrade"></div></div>
                        </div>
                    </div>
                    <div class="ifs-spacer"></div>
                    <div class="ifs-option" al-attr.class.ifs-lock="!App.data.ticket">
                        <div class="ifs-description">
                            <div class="ifs-title"><?php esc_html_e("Infinite scrolling", 'ifolders'); ?></div>
                            <div class="ifs-text"><?php esc_html_e("Enable infinite media library scrolling instead of the 'Load More' button.", 'ifolders'); ?></div>
                        </div>
                        <div class="ifs-data">
                            <div al-toggle="App.data.config.infinite_scrolling" al-on.click.stop="App.fn.config.onCheckboxChange($event)"></div>
                            <div class="ifs-upgrade"><i data-feather="star"></i><div al-html="App.globals.msg.upgrade"></div></div>
                        </div>
                    </div>
                    <div class="ifs-spacer"></div>
                    <div class="ifs-option" al-attr.class.ifs-lock="!App.data.ticket">
                        <div class="ifs-description">
                            <div class="ifs-title"><?php esc_html_e("Show media details on hover", 'ifolders'); ?></div>
                            <div class="ifs-text"><?php esc_html_e("View essential metadata, including title, size, type, date, and dimensions, by simply hovering your cursor over an image.", 'ifolders'); ?></div>
                        </div>
                        <div class="ifs-data">
                            <div al-toggle="App.data.config.media_hover_details" al-on.click.stop="App.fn.config.onCheckboxChange($event)"></div>
                            <div class="ifs-checklist ifs-margin-top" al-if="App.data.config.media_hover_details">
                                <label al-repeat="detail in App.data.media_hover_details"><input type="checkbox" value="{{detail.id}}" al-on.change="App.fn.config.onMediaDetailsChange($event, detail)" al-attr.checked="App.fn.config.isMediaDetailsChecked(detail)">{{detail.title}}</label>
                            </div>
                            <div class="ifs-upgrade"><i data-feather="star"></i><div al-html="App.globals.msg.upgrade"></div></div>
                        </div>
                    </div>
                    <div class="ifs-spacer"></div>
                    <div class="ifs-option" al-attr.class.ifs-lock="!App.data.ticket">
                        <div class="ifs-description">
                            <div class="ifs-title"><?php esc_html_e("Disable search bar", 'ifolders'); ?></div>
                            <div class="ifs-text"><?php esc_html_e("Disable the display of the folder search bar.", 'ifolders'); ?></div>
                        </div>
                        <div class="ifs-data">
                            <div al-toggle="App.data.config.disable_search_bar" al-on.click.stop="App.fn.config.onCheckboxChange($event)"></div>
                        </div>
                    </div>
                    <div class="ifs-spacer"></div>
                    <div class="ifs-option">
                        <div class="ifs-description">
                            <div class="ifs-title"><?php esc_html_e("Replace media", 'ifolders'); ?></div>
                            <div class="ifs-text"><?php esc_html_e("Adds tools to the 'Attachment details' screen that can be used to select or upload an image to replace the current image while preserving its URL and properties.", 'ifolders'); ?></div>
                        </div>
                        <div class="ifs-data">
                            <div al-toggle="App.data.config.replace_media"></div>
                            <div class="ifs-note" al-if="App.data.config.replace_media">
                                <?php esc_html_e("Note: Disable your browser cache and any WordPress caching plugins before use. Otherwise, you may find that this feature is not working properly.", 'ifolders'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="ifs-spacer"></div>
                    <br>
                    <br>
                    <br>
                    <div class="ifs-button ifs-select" al-on.click="App.fn.config.save()"><?php esc_html_e("Save", 'ifolders'); ?></div>
                </div>
                <div class="ifs-panel" al-attr.class.ifs-active="App.ui.tabs.fn.is('permissions')">
                    <div class="ifs-description">
                        <div class="ifs-title"><?php esc_html_e("Description", 'ifolders'); ?></div>
                        <div class="ifs-text"><?php esc_html_e("Use this section to control who can view and edit folders. Simply create specific permissions for users and roles, then select a security profile for each folder type and apply it.", 'ifolders'); ?></div>
                    </div>
                    <div class="ifs-spacer"></div>
                    <div class="ifs-option" al-attr.class.ifs-lock="!App.data.ticket">
                        <div class="ifs-description">
                            <div class="ifs-title"><?php esc_html_e("Access roles", 'ifolders'); ?></div>
                            <div class="ifs-text"><?php esc_html_e("Only selected user roles have access to folders. These are general settings, use the permissions tab to grant users additional personal or general permissions.", 'ifolders'); ?></div>
                        </div>
                        <div class="ifs-data">
                            <div class="ifs-checklist">
                                <label al-repeat="role in App.data.roles"><input type="checkbox" value="{{role.id}}" al-on.change="App.fn.accessroles.onChange($event, role)" al-attr.checked="App.fn.accessroles.isChecked(role)">{{role.title}}</label>
                            </div>
                            <div class="ifs-upgrade"><i data-feather="star"></i><div al-html="App.globals.msg.upgrade"></div></div>
                        </div>
                    </div>
                    <div class="ifs-spacer"></div>
                    <div class="ifs-option">
                        <div class="ifs-description">
                            <div class="ifs-title"><?php esc_html_e("Folder Types", 'ifolders'); ?></div>
                            <div class="ifs-text"><?php esc_html_e("This table shows the types of folders (media, pages, posts, etc.) supported by the plugin. To allow a user to create and edit folders of a specific folder type, you must select a security profile for that type from the list. If you don't find the desired folder type, try adding it manually.", 'ifolders'); ?></div>
                        </div>
                        <div class="ifs-data">
                            <div class="ifs-table">
                                <div class="ifs-table-header">
                                    <div class="ifs-left-group">
                                        <div class="ifs-btn" al-on.click="App.fn.foldertypes.create()" title="<?php esc_html_e("Add new folder type", 'ifolders'); ?>">
                                            <i data-feather="plus"></i>
                                        </div>
                                        <div class="ifs-btn" al-attr.class.ifs-lock="!App.data.foldertypes.selected" al-on.click="App.fn.foldertypes.edit()" title="<?php esc_html_e("Edit folder type", 'ifolders'); ?>">
                                            <i data-feather="edit-3"></i>
                                        </div>
                                        <div class="ifs-btn ifs-red" al-attr.class.ifs-lock="!App.data.foldertypes.checked" al-on.click="App.fn.foldertypes.delete()" title="<?php esc_html_e("Delete selected folder types", 'ifolders'); ?>">
                                            <i data-feather="trash-2"></i>
                                        </div>
                                    </div>
                                    <div class="ifs-right-group">
                                        <div class="ifs-btn" al-attr.class.ifs-lock="App.data.foldertypes.view.prev == null" al-on.click="App.fn.foldertypes.prev()">
                                            <i data-feather="chevron-left"></i>
                                        </div>
                                        <div class="ifs-btn" al-attr.class.ifs-lock="App.data.foldertypes.view.next == null" al-on.click="App.fn.foldertypes.next()">
                                            <i data-feather="chevron-right"></i>
                                        </div>
                                        <div class="ifs-btn" al-on.click="App.fn.foldertypes.load()" title="<?php esc_html_e("Refresh", 'ifolders'); ?>">
                                            <i data-feather="refresh-cw"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="ifs-table-body">
                                    <table>
                                        <colgroup>
                                            <col class="ifs-field-check"/>
                                            <col class="ifs-field-title"/>
                                            <col class="ifs-field-security-profile"/>
                                            <col class="ifs-field-status"/>
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" al-checked="App.data.foldertypes.checked" al-on.change="App.fn.selectAll($event, App.data.foldertypes.checked, App.data.foldertypes, App.scope)"></th>
                                            <th><?php esc_html_e("Folder type", 'ifolders'); ?></th>
                                            <th><?php esc_html_e("Security profile", 'ifolders'); ?></th>
                                            <th><?php esc_html_e("Status", 'ifolders'); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr al-attr.class.ifs-lock="App.fn.foldertypes.isLock(item)" al-repeat="item in App.data.foldertypes.items" al-attr.class.ifs-selected="App.data.foldertypes.selected == item.id" al-on.click.noprevent="App.fn.foldertypes.select(item)" al-on.dblclick="App.fn.foldertypes.dblclick(item)">
                                            <td><input type="checkbox" al-checked="item.checked" al-on.change="App.fn.selectOne($event, item.checked, App.data.foldertypes, App.scope)"></td>
                                            <td>{{item.title}}</td>
                                            <td><div class="ifs-label" al-attr.class.ifs-custom="item.security_profile.id > 0" al-if="item.security_profile.id">{{item.security_profile.title}}</div></td>
                                            <td><div class="ifs-status" al-attr.class.ifs-active="item.enabled">{{item.enabled ? '<?php esc_html_e("enabled", 'ifolders'); ?>' : '<?php esc_html_e("disabled", 'ifolders'); ?>'}}</div></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="ifs-table-footer">
                                    <div class="ifs-info ifs-left" al-if="!App.data.foldertypes.items.length"><?php esc_html_e("The table is empty", 'ifolders'); ?></div>
                                    <div class="ifs-info" al-if="App.data.foldertypes.items.length">{{App.data.foldertypes.view.first}} - {{App.data.foldertypes.view.last}} of {{App.data.foldertypes.view.total}}</div>
                                </div>
                                <div class="ifs-loader" al-attr.class.ifs-active="App.data.foldertypes.loading"></div>
                            </div>
                        </div>
                    </div>
                    <div class="ifs-spacer"></div>
                    <div class="ifs-option" al-attr.class.ifs-lock="!App.data.ticket">
                        <div class="ifs-description">
                            <div class="ifs-title"><?php esc_html_e("Security profiles", 'ifolders'); ?></div>
                            <div class="ifs-text"><?php esc_html_e("This table is used to create and manage security profiles that can be selected and linked in the table above. Custom security profiles allow you to set permissions for each user or role to work with folders, including creating, viewing, editing, deleting, and attaching items to a folder.", 'ifolders'); ?></div>
                        </div>
                        <div class="ifs-data">
                            <div class="ifs-table">
                                <div class="ifs-table-header">
                                    <div class="ifs-left-group">
                                        <div class="ifs-btn" al-on.click="App.fn.securityprofiles.create()" title="<?php esc_html_e("Add new security profile", 'ifolders'); ?>">
                                            <i data-feather="plus"></i>
                                        </div>
                                        <div class="ifs-btn" al-attr.class.ifs-lock="!App.data.securityprofiles.selected" al-on.click="App.fn.securityprofiles.edit()" title="<?php esc_html_e("Edit security profile", 'ifolders'); ?>">
                                            <i data-feather="edit-3"></i>
                                        </div>
                                        <div class="ifs-btn ifs-red" al-attr.class.ifs-lock="!App.data.securityprofiles.checked" al-on.click="App.fn.securityprofiles.delete()" title="<?php esc_html_e("Delete selected security profiles", 'ifolders'); ?>">
                                            <i data-feather="trash-2"></i>
                                        </div>
                                    </div>
                                    <div class="ifs-right-group">
                                        <div class="ifs-btn" al-attr.class.ifs-lock="App.data.securityprofiles.view.prev == null" al-on.click="App.fn.securityprofiles.prev()">
                                            <i data-feather="chevron-left"></i>
                                        </div>
                                        <div class="ifs-btn" al-attr.class.ifs-lock="App.data.securityprofiles.view.next == null" al-on.click="App.fn.securityprofiles.next()">
                                            <i data-feather="chevron-right"></i>
                                        </div>
                                        <div class="ifs-btn" al-on.click="App.fn.securityprofiles.load()" title="<?php esc_html_e("Refresh", 'ifolders'); ?>">
                                            <i data-feather="refresh-cw"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="ifs-table-body">
                                    <table>
                                        <colgroup>
                                            <col class="ifs-field-check"/>
                                            <col class="ifs-field-title"/>
                                            <col class="ifs-field-description"/>
                                        </colgroup>
                                        <thead>
                                        <tr>
                                            <th><input type="checkbox" al-checked="App.data.securityprofiles.checked" al-on.change="App.fn.selectAll($event, App.data.securityprofiles.checked, App.data.securityprofiles, App.scope)"></th>
                                            <th><?php esc_html_e("Security profile", 'ifolders'); ?></th>
                                            <th><?php esc_html_e("Description", 'ifolders'); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr al-attr.class.ifs-lock="App.fn.securityprofiles.isLock(item)" al-repeat="item in App.data.securityprofiles.items" al-attr.class.ifs-selected="App.data.securityprofiles.selected == item.id" al-on.click.noprevent="App.fn.securityprofiles.select(item)" al-on.dblclick="App.fn.securityprofiles.dblclick(item)">
                                                <td><input type="checkbox" al-checked="item.checked" al-on.change="App.fn.selectOne($event, item.checked, App.data.securityprofiles, App.scope)"></td>
                                                <td>{{item.title}}</td>
                                                <td>{{item.description}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="ifs-table-footer">
                                    <div class="ifs-info ifs-left" al-if="!App.data.securityprofiles.items.length"><?php esc_html_e("The table is empty", 'ifolders'); ?></div>
                                    <div class="ifs-info" al-if="App.data.securityprofiles.items.length">{{App.data.securityprofiles.view.first}} - {{App.data.securityprofiles.view.last}} of {{App.data.securityprofiles.view.total}}</div>
                                </div>
                                <div class="ifs-loader" al-attr.class.ifs-active="App.data.securityprofiles.loading"></div>
                            </div>
                            <div class="ifs-upgrade"><i data-feather="star"></i><div al-html="App.globals.msg.upgrade"></div></div>
                        </div>
                    </div>
                </div>
                <div class="ifs-panel" al-attr.class.ifs-active="App.ui.tabs.fn.is('tools')">
                    <div class="ifs-option" al-if="App.data.import.plugins">
                        <div class="ifs-description">
                            <div class="ifs-title"><?php esc_html_e("Import from other plugins", 'ifolders'); ?></div>
                            <div class="ifs-text"><?php esc_html_e("Import folders and attachments from third-party plugins for the media library.", 'ifolders'); ?></div>
                        </div>
                        <div class="ifs-data">
                            <div class="ifs-importlist">
                                <div class="ifs-importlist-item" al-repeat="plugin in App.data.import.plugins" al-attr.class.ifs-lock="plugin.lock">
                                    <div>
                                        <div class="ifs-title">{{plugin.name}} (by {{plugin.author}})</div>
                                        <div class="ifs-description">{{plugin.folders}} folders to import</div>
                                    </div>
                                    <button class="button button-primary" al-on.click="App.fn.tools.importFromPlugin(plugin.key)"><?php esc_html_e("Import now", 'ifolders'); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ifs-spacer" al-if="App.data.import.plugins"></div>
                    <div class="ifs-option">
                        <div class="ifs-description">
                            <div class="ifs-title"><?php esc_html_e("Export", 'ifolders'); ?></div>
                            <div class="ifs-text"><?php esc_html_e("The current folder structure with attachments will be exported to a CSV file.", 'ifolders'); ?></div>
                        </div>
                        <div class="ifs-data">
                            <div class="ifs-button ifs-export" al-on.click="App.fn.tools.export()"><?php esc_html_e("Export Now", 'ifolders'); ?></div>
                            <a class="ifs-download-file" download="{{App.data.export.filename}}" href="{{App.data.export.url}}" al-if="App.data.export.url"><?php esc_html_e("Download file", 'ifolders'); ?></a>
                        </div>
                    </div>
                    <div class="ifs-spacer"></div>
                    <div class="ifs-option">
                        <div class="ifs-description">
                            <div class="ifs-title"><?php esc_html_e("Import", 'ifolders'); ?></div>
                            <div class="ifs-text"><?php esc_html_e("Select a CSV file with the folder structure and attachments to import.", 'ifolders'); ?></div>
                        </div>
                        <div class="ifs-data">
                            <input class="ifs-button" type="file" accept=".csv" al-on.change="App.fn.tools.onFileToImportChange($element)">
                            <div al-if="App.data.import.file">
                                <div class="ifs-checklist">
                                    <label><input type="checkbox" al-checked="App.data.import.clear"><?php esc_html_e("Clearing all existing folders before import", 'ifolders'); ?></label>
                                    <label><input type="checkbox" al-checked="App.data.import.attachments"><?php esc_html_e("Import attachments", 'ifolders'); ?></label>
                                </div>
                                <div class="ifs-button ifs-import" al-on.click="App.fn.tools.import()"><?php esc_html_e("Import Now", 'ifolders'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="ifs-spacer"></div>
                    <div class="ifs-option">
                        <div class="ifs-description">
                            <div class="ifs-title"><?php esc_html_e("Folder counters recalculation", 'ifolders'); ?></div>
                            <div class="ifs-text"><?php esc_html_e("This action will completely recalculate all item counters that are attached to folders.", 'ifolders'); ?></div>
                        </div>
                        <div class="ifs-data">
                            <div class="ifs-button ifs-export" al-on.click="App.fn.tools.recalculate()"><?php esc_html_e("Recalculate", 'ifolders'); ?></div>
                        </div>
                    </div>
                    <div class="ifs-spacer"></div>
                    <div class="ifs-option">
                        <div class="ifs-description">
                            <div class="ifs-title"><?php esc_html_e("Clear data", 'ifolders'); ?></div>
                            <div class="ifs-text"><?php esc_html_e("This action will deactivate the plugin iFolders and delete all its data and settings and return you to the default WordPress state before installing the plugin.", 'ifolders'); ?></div>
                        </div>
                        <div class="ifs-data">
                            <div class="ifs-button ifs-deactivate" al-on.click="App.fn.tools.clear()"><?php esc_html_e("Clear now", 'ifolders'); ?></div>
                        </div>
                    </div>
                </div>
                <div class="ifs-panel" al-attr.class.ifs-active="App.ui.tabs.fn.is('gopro')">
                    <div class="ifs-option">
                        <div class="ifs-description">
                            <div class="ifs-hero-buy"></div>
                        </div>
                        <div class="ifs-data">
                            <div class="ifs-features">
                                <h1><?php esc_html_e("Get iFolders Pro", 'ifolders'); ?></h1>
                                <b><?php esc_html_e("Unlock all features and premium support", 'ifolders'); ?></b>
                                <ul>
                                    <li><div class="ifs-icon"><i data-feather="check"></i></div><?php esc_html_e("Sort Options", 'ifolders'); ?></li>
                                    <li><div class="ifs-icon"><i data-feather="check"></i></div><?php esc_html_e("Advanced User Rights", 'ifolders'); ?></li>
                                    <li><div class="ifs-icon"><i data-feather="check"></i></div><?php esc_html_e("Organize Pages, Posts and Custom Post Types", 'ifolders'); ?></li>
                                    <li><div class="ifs-icon"><i data-feather="check"></i></div><?php esc_html_e("Page Builders: Elementor, Beaver, Divi, Brizy etc.", 'ifolders'); ?></li>
                                    <li><div class="ifs-icon"><i data-feather="check"></i></div><?php esc_html_e("Lifetime License", 'ifolders'); ?></li>
                                    <li><div class="ifs-icon"><i data-feather="check"></i></div><?php esc_html_e("VIP Support", 'ifolders'); ?></li>
                                </ul>
                            </div>
                            <a class="ifs-button ifs-buy" href="https://1.envato.market/getifolders" target="_blank"><?php esc_html_e("Buy Now", 'ifolders'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ifs-sidebar">
                <div class="ifs-panel" al-if="App.data.ticket" style="--order:1;">
                    <div class="ifs-hero"></div>
                    <div class="ifs-description">
                        <div class="ifs-title"><?php esc_html_e("Congratulations!!!", 'ifolders'); ?></div>
                        <div class="ifs-text"><?php esc_html_e("You are using the iFolders Pro version.", 'ifolders'); ?></div>
                    </div>
                </div>
                <a class="ifs-panel" href="https://1.envato.market/getifolders" target="_blank" al-if="!App.data.ticket" style="--order:1;">
                    <div class="ifs-icon ifs-theme-crown">
                        <i data-feather="star"></i>
                    </div>
                    <div class="ifs-description">
                        <div class="ifs-title"><?php esc_html_e("Get iFolders Pro", 'ifolders'); ?></div>
                        <div class="ifs-text"><?php esc_html_e("Unlock all features and premium support.", 'ifolders'); ?></div>
                    </div>
                </a>
                <a class="ifs-panel" href="https://www.youtube.com/watch?v=90xmu-3dPjA" target="_blank" style="--order:2;">
                    <div class="ifs-icon ifs-theme-berry">
                        <i data-feather="youtube"></i>
                    </div>
                    <div class="ifs-description">
                        <div class="ifs-title"><?php esc_html_e("YouTube Channel", 'ifolders'); ?></div>
                        <div class="ifs-text"><?php esc_html_e("Watch our video to learn about all the features of iFolders.", 'ifolders'); ?></div>
                    </div>
                </a>
                <a class="ifs-panel" href="https://codecanyon.net/user/avirtum" target="_blank" style="--order:3;">
                    <div class="ifs-icon ifs-theme-grass">
                        <i data-feather="help-circle"></i>
                    </div>
                    <div class="ifs-description">
                        <div class="ifs-title"><?php esc_html_e("Support", 'ifolders'); ?></div>
                        <div class="ifs-text"><?php esc_html_e("Quickly get direct help from our qualified support team.", 'ifolders'); ?></div>
                    </div>
                </a>
                <a class="ifs-panel" href="https://codecanyon.net/user/avirtum" target="_blank" style="--order:4;">
                    <div class="ifs-icon ifs-theme-salad">
                        <i data-feather="gift"></i>
                    </div>
                    <div class="ifs-description">
                        <div class="ifs-title"><?php esc_html_e("Suggest a Feature", 'ifolders'); ?></div>
                        <div class="ifs-text"><?php esc_html_e("Do you have ideas or suggestions for iFolders? We'd love to hear them.", 'ifolders'); ?></div>
                    </div>
                </a>

                <a class="ifs-panel" href="https://wordpress.org/plugins/happyvr" target="_blank" style="--order:5;">
                    <div class="ifs-happyvr"></div>
                    <div class="ifs-description">
                        <div class="ifs-title"><?php esc_html_e("HappyVR", 'ifolders'); ?></div>
                        <div class="ifs-text"><?php esc_html_e("Creates immersive 360 virtual tours for WordPress for real estate, museums, hotels and etc.", 'ifolders'); ?></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
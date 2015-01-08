<div class="wrap">
    <div id="icon-plugins" class="icon32"></div>
    <h2><?php _e('Projects','emekong'); ?><a class="add-new-h2" href="<?php echo get_option('siteurl'); ?>/wp-admin/admin.php?page=project-add"><?php _e('Add New', 'emekong'); ?></a></h3></h2>

<form name="frm_eemail_display" method="post" onsubmit="return _subscribermultipledelete()">
    <table width="100%" class="widefat" id="straymanage">
        <thead>
        <tr>
            <th class="check-column" scope="col"><input type="checkbox" name="chk_delete[]" id="chk_delete[]" /></th>
            <th scope="col"><?php _e('Name', 'emekong'); ?></th>
            <th scope="col"><?php _e('Range', 'emekong'); ?></th>
            <th scope="col"><?php _e('Property', 'emekong'); ?></th>
            <th scope="col"><?php _e('Location', 'emekong'); ?></th>
            <th scope="col"><?php _e('Province', 'emekong'); ?></th>
            <th scope="col"><?php _e('Country', 'emekong'); ?></th>
            <th scope="col"><?php _e('Progress', 'emekong'); ?></th>
            <th scope="col"><?php _e('Status', 'emekong'); ?></th>
        </tr>
        </thead>

        <tbody>

        </tbody>
    </table>

    <input type="hidden" name="frm_eemail_display" value="yes"/>
    <input type="hidden" name="frm_eemail_bulkaction" value=""/>
    <input name="searchquery" id="searchquery" type="hidden" value="" />
    <div style="padding-top:10px;"></div>
    <div class="tablenav">
        <div class="alignleft">
            <select name="action" id="action">
                <option value=""><?php _e('Bulk Actions', 'emekong'); ?></option>
                <option value="delete"><?php _e('Delete', 'emekong'); ?></option>
                <option value="resend"><?php _e('Resend Confirmation', 'emekong'); ?></option>
            </select>
            <input type="submit" value="Apply" class="button action" id="doaction" name="">
        </div>
        <div class="alignright">

        </div>
    </div>
</form>

</div>
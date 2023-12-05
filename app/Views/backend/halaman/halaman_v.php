<?php
$menus = 'class="form-control" id="parent_id" placeholder="Parent Menu" required';
echo form_dropdown('parent_id', $get_all_combobox_menus, $id, $menus);

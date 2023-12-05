<?php
$album = 'class="form-control" id="album" placeholder="Pilih Album" required';
echo form_dropdown('album', $get_all_combobox_album, $id, $album);

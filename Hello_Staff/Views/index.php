<?php
// $login_user is available in templated views in RISE.
$first_name = isset($login_user->first_name) ? esc($login_user->first_name) : '';
?>
<div class="card">
    <div class="card-header">
        <h4><?= app_lang('hello_staff_title'); ?></h4>
    </div>
    <div class="card-body">
        <p><?= app_lang('hello_staff_greeting'); ?> <strong><?= $first_name; ?></strong> </p>

        <h5 class="mt-3"><?= app_lang('hello_staff_list_title'); ?></h5>

        <?php if (!empty($items)) : ?>
            <ul class="list-group">
                <?php foreach ($items as $row) : ?>
                    <li class="list-group-item"><?= esc($row->title); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <div class="text-muted"><?= app_lang('hello_staff_no_items'); ?></div>
        <?php endif; ?>
    </div>
</div>

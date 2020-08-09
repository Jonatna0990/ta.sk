<?php include(ROOT.'/views/layouts/header.php');?>
<div class=".container">
    <?
    foreach ($taskList as $item) {
        ?>
        <div class="ps-content">
            <ul class=" list-group list-group-flush border-bottom">
                <li class="list-group-item border-bottom">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading"><?=$item->user_name?>
                                    <?/*if(in_array(Task::$STATUS_NEW, $item['status'])) {?>
                                    <span class="badge badge-primary">Новая</span>
                                    <?}*/ if(in_array(Task::$STATUS_FINISHED, $item->status)) {?>
                                        <span class="badge badge-success">Выполнено</span>
                                    <?} if(in_array(Task::$STATUS_EDIT, $item->status)) {?>
                                        <span class="badge badge-info">Отредактировано администратором</span>
                                    <?}?>
                                </div>
                                <div class="widget-subheading"><i><?=$item->email?></i></div>
                                <div class="widget-subheading"><?=$item->description?></div>
                            </div>
                            <div class="widget-content-right">
                                <a href="/view/<?=$item->id?>" class="border-0 btn-transition btn btn-outline-success">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="admin/edit/<?=$item->id?>" class="border-0 btn-transition btn btn-outline-secondary">
                                    <i class="fa fa-pencil"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>

    <?}?>

</div>
<nav>
    <?=$pagination->get() ?>
</nav>

<? include(ROOT.'/views/layouts/footer.php'); ?>

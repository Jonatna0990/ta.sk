<?php include(ROOT.'/views/layouts/header.php');?>
    <main role="main" class="container">
        <div class="row">
            <div class="blog-post">
                <?/*if(in_array(Task::$STATUS_NEW, $item['status'])) {?>
                    <span class="badge badge-primary">Новая</span>
                <?}*/ if(in_array(Task::$STATUS_FINISHED, $taskItem->status)) {?>
                    <span class="badge badge-success">Выполнено</span>
                <?} if(in_array(Task::$STATUS_EDIT, $taskItem->status)) {?>
                    <span class="badge badge-info">Отредактировано администратором</span>
                <?}?>
                <h2 class="blog-post-title"><?=$taskItem->user_name?></h2>
                <p class="blog-post-meta"><?=$taskItem->email?></p>
                <p><?=$taskItem->description?></p>

                <?
                if(!User::isGuest())
                {
                    ?>
                    <div class="widget-content-right">
                        <a href="/admin/edit/<?=$taskItem->id?>" class="btn btn-outline-primary">
                            Редактировать
                        </a>
                    </div>
                <?}
                ?>

            </div>
        </div><!-- /.row -->
    </main><!-- /.container -->

<? include(ROOT.'/views/layouts/footer.php'); ?>
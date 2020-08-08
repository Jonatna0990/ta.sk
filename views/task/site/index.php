<?php include(ROOT.'/views/layouts/header.php');?>

<div class="container">
    <div class="row">

        <div class="container mb-3">
            <div class="row justify-content-md-center">
                <div class="col-md-auto ">
                    <div class="form-group">
                        <form method="post" action="#" class="form-inline">
                            <label for="inputSort" class="sr-only">Логин </label>
                            <select id="inputSort" name="sort" class="form-control">
                                <option value="1">По имени(по возрастанию)</option>
                                <option value="2">По имени(по убыванию)</option>
                                <option value="3">По email(по возрастанию)</option>
                                <option value="4">По email(по убыванию)</option>
                                <option value="5">По статусу(по возрастанию)</option>
                                <option value="6">По статусу(по убыванию)</option>
                            </select>
                            <input name="submit" class="form-control ml-2" type="submit" value="Сортировать"/>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="card-deck mb-3 text-center">
        <?
        foreach ($taskList as $item) {
            ?>
            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal"><?=$item->user_name?></h4>
                    <?/*if(in_array(Task::$STATUS_NEW, $item['status'])) {?>
                        <span class="badge badge-primary">Новая</span>
                    <?}*/ if(in_array(Task::$STATUS_FINISHED, $item->status)) {?>
                        <span class="badge badge-success">Выполнено</span>
                    <?} if(in_array(Task::$STATUS_EDIT, $item->status)) {?>
                        <span class="badge badge-info">Отредактировано администратором</span>
                    <?}?>
                </div>

                <div class="card-body">
                    <h3 class="card-title pricing-card-title"><?=$item->email?></small></h3>
                    <h6 class="list-unstyled mt-3 mb-4">
                        <?=$item->description?>
                    </h6>
                    <a href="/view/<?=$item->id?>" class="btn btn-lg btn-block btn-outline-primary">Подробнее</a>
                    <?
                    if(!User::isGuest())
                    {
                        ?>
                        <a href="/admin/edit/<?=$item->id?>" class="btn btn-lg btn-block btn-outline-primary">Редактировать</a>
                    <?}
                    ?>
                </div>
            </div>
            <?
        }
        ?>

    </div>
    <nav>
        <?=$pagination->get() ?>
    </nav>

</div>
<? include(ROOT.'/views/layouts/footer.php'); ?>


<?php include(ROOT.'/views/layouts/header.php');?>

<?

$title = "Добавить";
if(isset($taskItem) && !User::isGuest()) $title = "Редактировать";

?>



<div class="container">
    <div class="row">
        <div class="col-md-11 order-md-11">
            <h4 class="mb-3"><?=$title?>
                задачу
            </h4>
            <form  method="post" class="needs-validation" validate
                   action="<? if(isset($taskItem) && !User::isGuest())  echo '/admin/edit/'.$taskItem->id?>">
                <div class="mb-3">
                    <label for="address">Имя пользователя</label>
                    <input name="user_name" type="text" class="form-control" id="address"
                           value="<? if(isset($taskItem) && !User::isGuest())  echo $taskItem->user_name?>"
                           placeholder="Например, Евгений" required>
                    <div class="invalid-feedback">
                       Введите имя пользователя
                    </div>
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input name="email" type="email" class="form-control" id="email"
                           value="<? if(isset($taskItem) && !User::isGuest())  echo $taskItem->email?>"
                           placeholder="you@example.com" required>
                    <div class="invalid-feedback">
                        Введите Email
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description">Текст задачи</label>
                    <label for="description"></label>
                    <input name="description" type="text" class="form-control" id="description"
                           value="<? if(isset($taskItem) && !User::isGuest())  echo $taskItem->description?>"
                           placeholder="Это крутая задача!" required>
                    <div class="invalid-feedback">
                        Введите Текст задачи
                    </div>
                </div>
                <?
                if(isset($taskItem) && !User::isGuest())
                {?>
                    <div class="custom-control custom-checkbox">
                        <input name="status" type="checkbox" class="custom-control-input" id="status">
                        <label class="custom-control-label" for="status">Выполнена</label>
                    </div>
                <?
                }

                ?>


                <hr class="mb-4">
                <input name="submit" class="btn btn-primary btn-lg btn-block" value="<?=$title?>" type="submit"/>
            </form>
        </div>
    </div>
</div>
<? include(ROOT.'/views/layouts/footer.php'); ?>

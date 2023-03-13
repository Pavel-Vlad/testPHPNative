
<div class="forms">

    <div class="form-wrap">
        <form method="post">
            <input type="hidden" name="method" value="post">
            <p>
                <select name="parent_id">
                    <option>Выбрать родителя</option>
                    <?php
                    foreach ($objects as $object) {
                        ?>
                        <option value="<?= $object['id'] ?>"><?= $object['title'] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <span class="hint">* не выбирайте если объект корневой</span>

            </p>
            <p>
                <input name="title" type="text" placeholder="Название:" required>
            </p>
            <p>
                <textarea name="description" placeholder="Описание:" rows="10"></textarea>
            </p>
            <input type="submit" class="btn" value="Добавить">
        </form>
    </div>
    <div class="form-wrap">
        <form method="post">
            <input type="hidden" name="method" value="delete">
            <p>
                <select name="parent_id">
                    <?php
                    foreach ($objects as $object) {
                        ?>
                        <option value="<?= $object['id'] ?>"><?= $object['title'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <input type="submit" class="btn" value="Удалить">
        </form>
    </div>
    <div class="form-wrap">
        <form method="post">
            <input type="hidden" name="method" value="put">
            <p>
                <select name="object_id" id="select" required>
                    <option value="0">Выбрать объект для изменения</option>
                    <?php
                    foreach ($objects as $object) {
                        ?>
                        <option value="<?= $object['id'] ?>"><?= $object['title'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <input id="title" name="title" type="text" placeholder="Новое название:" required>
            </p>
            <p>
                <textarea id="desc" name="description" placeholder="Новое описание:" rows="10"></textarea>
            </p>
            <p>
                <select id="new_parent" name="parent_id">
                    <option value="0">Выбрать нового родителя</option>
                    <?php
                    foreach ($objects as $object) {
                        ?>
                        <option value="<?= $object['id'] ?>"><?= $object['title'] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <span class="hint">* не выбирайте если объект должен стать корневой</span>
            </p>
            <input type="submit" class="btn" value="Изменить">
        </form>
    </div>

</div>
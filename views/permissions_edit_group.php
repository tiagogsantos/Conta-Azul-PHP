<h1>Permissões - editar grupo de permissões</h1>

<form method="post">
    <label>Nome do Grupo de permissões</label> <br/>
    <input type="text" name="name" value="<?php echo $group_info['name']; ?>"  /> <br/><br/>

    <label>Permissões</label> <br/>
    <?php foreach ($permissions_list as $p): ?> <br/>
        <div class="p_item">
            <input type="checkbox" name="permissions[]" value="<?php echo $p['id']; ?>" id="p_<?php echo $p['id']; ?>"
                <?php echo (in_array($p['id'], $group_info['params'])) ? 'checked="checked"' : '' ?> />
            <label for="p_<?php echo $p['id']; ?>"><?php echo $p['name']; ?></label>
        </div>
    <?php endforeach; ?> <br/><br/>
    <button type="submit">Atualizar grupo</button>
</form>
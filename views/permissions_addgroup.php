<h1>Permissões - Adicionar grupo de permissões</h1>

<form method="post">
    <label>Nome do Grupo de permissões</label> <br/>
    <input type="text" name="name" /> <br/><br/>

    <label>Permissões</label> <br/>
    <?php foreach ($permissions_list as $p): ?> <br/>
    <div class="p_item">
         <input type="checkbox" name="permissions[]" value="<?php echo $p['id']; ?>" id="p_<?php echo $p['id']; ?>" />
         <label for="p_<?php echo $p['id']; ?>"><?php echo $p['name']; ?></label>
    </div>
    <?php endforeach; ?> <br/><br/>
    <button type="submit">Adicionar grupo</button>
</form>
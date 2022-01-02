<?php if (isset($error_msg) && !empty($error_msg)): ?>
    <div class="msg_warning"> <?php echo $error_msg ?> </div>
<?php endif; ?>

<?php if (isset($success_msg) && !empty($success_msg)): ?>
    <div class="msg_success"> <?php echo $success_msg ?> </div>
<?php endif; ?>

<h1>Permissões</h1>

<div class="tabarea">
    <div class="tabitem activetab">Grupos de permissões</div>
    <div class="tabitem">Permissões</div>
</div>
<div class="tabcontent">
    <div class="tabbody" style="display:block">
        <div class="button"><a href="<?php echo BASE_URL; ?>/permissions/addgroup">Adicionar Grupo de Permissões</a></div>

        <table border="0" width="100%">
            <tr>
                <th>Nome do Grupo de Permissões</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($permissions_groups_list as $p): ?>
                <tr>
                    <td><?php echo $p['name']; ?></td>
                    <td width="160">
                        <div class="button button_small"><a href="<?php echo BASE_URL; ?>/permissions/edit_group/<?php echo $p['id']; ?>">Editar</a></div>
                        <div class="button button_small"><a href="<?php echo BASE_URL; ?>/permissions/delete_group/<?php echo $p['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a></div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
    <div class="tabbody">
        <button class="button">
        <a href="<?php BASE_URL; ?>/permissions/add">Adicionar Permissão</a></button>
        <table border="0" width="100%">
            <tr>
                <th>Nome da Permissão</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($permissions_list as $p): ?>
                <tr>
                    <td><?php echo $p['name']; ?></td>
                    <td width="120"><a class="button button_small" href="<?php BASE_URL; ?>/permissions/delete/<?php echo $p['id']; ?>">Excluir</a></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
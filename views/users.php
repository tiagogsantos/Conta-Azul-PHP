<h1>Usuários</h1>

<?php if (isset($error_msg) && !empty($error_msg)): ?>
    <div class="msg_warning"> <?php echo $error_msg ?> </div>
<?php endif; ?>

<?php if (isset($success_msg) && !empty($success_msg)): ?>
    <div class="msg_success"> <?php echo $success_msg ?> </div>
<?php endif; ?>

<div class="button"><a href="<?php echo BASE_URL; ?>/users/add">Adicionar Usuário</a></div>

<table border="0" width="100%">
    <tr>
        <th>E-mail</th>
        <th>Grupo de Permissão</th>
        <th>Ações</th>
    </tr>
        <?php foreach ($users_list as $list): ?>
            <tr>
                <td><?php echo $list['email']; ?></td>
                <td><?php echo $list['name']; ?></td>
                <td width="160">
                    <div class="button button_small"><a href="<?php echo BASE_URL; ?>/users/edit/<?php echo $list['id']; ?>">Editar</a></div>
                    <div class="button button_small"><a href="<?php echo BASE_URL; ?>/users/delete/<?php echo $list['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a></div>
                </td>
            </tr>
        <?php endforeach; ?>
</table>
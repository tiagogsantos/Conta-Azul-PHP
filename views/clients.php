<h1>Clientes</h1>

<?php if (isset($error_msg) && !empty($error_msg)): ?>
    <div class="msg_warning"> <?php echo $error_msg ?> </div>
<?php endif; ?>

<?php if (isset($success_msg) && !empty($success_msg)): ?>
    <div class="msg_success"> <?php echo $success_msg ?> </div>
<?php endif; ?>

<?php if ($edit_permission): ?>
<div class="button"><a href="<?php echo BASE_URL; ?>/clients/add">Adicionar Clientes</a></div>
<?php endif; ?>

<input type="text" id="busca" data-type="search_clients" />

<table border="0" width="100%">
    <tr>
        <th>Nome</th>
        <th>Telefone</th>
        <th>Cidade</th>
        <th>Estrelas</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($clients_list as $list): ?>
        <tr>
            <td><?php echo $list['name']; ?></td>
            <td><?php echo $list['phone']; ?></td>
            <td><?php echo $list['address_city']; ?></td>
            <td><?php echo $list['stars']; ?></td>
            <td width="160">
                <?php if ($edit_permission): ?>
                <div class="button button_small"><a href="<?php echo BASE_URL; ?>/clients/edit/<?php echo $list['id']; ?>">Editar</a></div>
                <div class="button button_small"><a href="<?php echo BASE_URL; ?>/clients/delete/<?php echo $list['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a></div>
                <?php else: ?>
                    <div class="button button_small"><a href="<?php echo BASE_URL; ?>/clients/view/<?php echo $list['id']; ?>">Visualizar Detalhes</a></div>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="pagination">
    <?php for($q=1;$q<=$p_count;$q++): ?>
        <div class="pag_item <?php echo ($q==$p)?'pag_ativo':''; ?>"><a href="<?php echo BASE_URL; ?>/clients?p=<?php echo $q; ?>"><?php echo $q; ?></a></div>
    <?php endfor; ?>

    <div style="clear: both"></div>
</div>
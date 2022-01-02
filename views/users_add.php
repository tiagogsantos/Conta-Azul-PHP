<h1>Adicionar Usuários</h1>

<?php if (isset($error_msg) && !empty($error_msg)): ?>
    <div class="msg_warning"> <?php echo $error_msg ?> </div>
<?php endif; ?>

<?php if (isset($success_msg) && !empty($success_msg)): ?>
    <div class="msg_success"> <?php echo $success_msg ?> </div>
<?php endif; ?>

<form method="post">
    <label>E-mail</label> <br/>
    <input type="email" name="email" required /> <br/><br/>

    <label>Senha</label> <br/>
    <input type="password" name="password" required /> <br/><br/>

    <label>Grupo de Permissões</label>
    <select name="group" id="group" required>
        <?php foreach ($group_list as $gp): ?>
        <option value="<?php echo $gp['id'] ?>"><?php echo ($gp['name']) ?></option>
        <?php endforeach; ?>
    </select>
        <br/><br/>
    <button type="submit">Adicionar usuário</button>
</form>
<h1>Editar Cliente</h1>

<?php if (isset($error_msg) && !empty($error_msg)): ?>
    <div class="msg_warning"> <?php echo $error_msg ?> </div>
<?php endif; ?>

<?php if (isset($success_msg) && !empty($success_msg)): ?>
    <div class="msg_success"> <?php echo $success_msg ?> </div>
<?php endif; ?>

<form method="post">

    <label>Nome</label> <br/>
    <input type="text" name="name" required value="<?php echo $client_info['name']; ?>" /> <br/><br/>

    <label>E-mail</label> <br/>
    <input type="email" name="email" value="<?php echo $client_info['email']; ?>" /> <br/><br/>

    <label>Telefone</label> <br/>
    <input type="text" name="phone" value="<?php echo $client_info['phone']; ?>" /> <br/><br/>

    <label>Qualificação de pagador</label>
    <select name="stars" id="stars" required>
        <option value="1" <?php echo ($client_info['stars']=='1')?'selected="selected"':''; ?>>1 Estrela</option>
        <option value="2" <?php echo ($client_info['stars']=='2')?'selected="selected"':''; ?>>2 Estrela</option>
        <option value="3" <?php echo ($client_info['stars']=='3')?'selected="selected"':''; ?>>3 Estrela</option>
        <option value="4" <?php echo ($client_info['stars']=='4')?'selected="selected"':''; ?>>4 Estrela</option>
        <option value="5" <?php echo ($client_info['stars']=='5')?'selected="selected"':''; ?>>5 Estrela</option>
    </select> <br/><br/>

    <label>Informações Gerais</label>
    <textarea name="internal_obs" id="internal_obs"><?php echo $client_info['internal_obs']; ?></textarea><br/><br/>

    <label>CEP</label> <br/>
    <input type="text" name="address_zipcode" value="<?php echo $client_info['address_zipcode']; ?>" /> <br/><br/>

    <label>Rua</label> <br/>
    <input type="text" name="address" value="<?php echo $client_info['address']; ?>" /> <br/><br/>

    <label>Numero</label> <br/>
    <input type="text" name="address_number" value="<?php echo $client_info['address_number']; ?>" /> <br/><br/>

    <label>Complemento</label> <br/>
    <input type="text" name="address2" value="<?php echo $client_info['address2']; ?>" /> <br/><br/>

    <label>Bairro</label> <br/>
    <input type="text" name="address_neighb" value="<?php echo $client_info['address_neighb']; ?>" /> <br/><br/>

    <label>Cidade</label> <br/>
    <input type="text" name="address_city" value="<?php echo $client_info['address_city']; ?>" /> <br/><br/>

    <label>Estado</label> <br/>
    <input type="text" name="address_state" value="<?php echo $client_info['address_state']; ?>" /> <br/><br/>

    <label>País</label> <br/>
    <input type="text" name="address_country" value="<?php echo $client_info['address_country']; ?>" /> <br/><br/>

    <button type="submit">Adicionar usuário</button>

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/clients.js"></script>
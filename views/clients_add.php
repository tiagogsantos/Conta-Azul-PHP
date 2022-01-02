<h1>Adicionar Clientes</h1>

<?php if (isset($error_msg) && !empty($error_msg)): ?>
    <div class="msg_warning"> <?php echo $error_msg ?> </div>
<?php endif; ?>

<?php if (isset($success_msg) && !empty($success_msg)): ?>
    <div class="msg_success"> <?php echo $success_msg ?> </div>
<?php endif; ?>

<form method="post">

    <label>Nome</label> <br/>
    <input type="text" name="name" required /> <br/><br/>

    <label>E-mail</label> <br/>
    <input type="email" name="email" /> <br/><br/>

    <label>Telefone</label> <br/>
    <input type="text" name="phone" /> <br/><br/>

    <label>Qualificação de pagador</label>
    <select name="stars" id="stars" required>
        <option value="1">1 Estrela</option>
        <option value="2">2 Estrelas</option>
        <option value="3" selected="selected">3 Estrelas</option>
        <option value="4">4 Estrelas</option>
        <option value="5">5 Estrelas</option>
    </select> <br/><br/>

    <label>Informações Gerais</label>
    <textarea name="internal_obs" id="internal_obs"></textarea><br/><br/>

    <label>CEP</label> <br/>
    <input type="text" name="address_zipcode" /> <br/><br/>

    <label>Rua</label> <br/>
    <input type="text" name="address" /> <br/><br/>

    <label>Numero</label> <br/>
    <input type="text" name="address_number" /> <br/><br/>

    <label>Complemento</label> <br/>
    <input type="text" name="address2" /> <br/><br/>

    <label>Bairro</label> <br/>
    <input type="text" name="address_neighb" /> <br/><br/>

    <label>Cidade</label> <br/>
    <input type="text" name="address_city" /> <br/><br/>

    <label>Estado</label> <br/>
    <input type="text" name="address_state" /> <br/><br/>

    <label>País</label> <br/>
    <input type="text" name="address_country" /> <br/><br/>

    <button type="submit">Adicionar usuário</button>

</form>

<script type="text/javascript" src="<?php echo BASE_URL; ?>/assets/js/clients.js"></script>
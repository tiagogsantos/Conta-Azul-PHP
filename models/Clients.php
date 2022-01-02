<?php

class Clients extends model

{
    
    public function getList($offset)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT * FROM clients LIMIT $offset, 10");
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    // Puxando as informações do meu clients
    public function getInfo($id, $id_company)
    {
        $array = array();

        // Pesquisando os clientes no banco de dados
        $sql = $this->db->prepare("SELECT * FROM clients where id = :id AND id_company = :id_company");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetch();
        }

        return $array;
    }

    /*
     * Metodo para pegar a quantidade de clientes
     */
    public function getCount ($id_company)
    {
        $r = 0;

        $sql = $this->db->prepare("SELECT COUNT(*) as c FROM clients WHERE id_company = :id_company");
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        $row = $sql->fetch();

        $r = $row['c'];

        return $r;
    }

    // Adicionando um novo cliente
    public function add($id_company, $name, $email = '', $phone = '', $stars = '3', $internal_obs = '', $address_zipcode = '', $address = '', $address_number = '', $address2 = '', $address_neighb = '', $address_city = '', $address_state = '', $address_country = '', $address_citycode = '')
    {
        try {
            $sql = $this->db->prepare("INSERT INTO clients SET id_company = :id_company, name = :name, email = :email, phone = :phone, stars = :stars, internal_obs = :internal_obs, address_zipcode = :address_zipcode, address = :address, address_number = :address_number, address2 = :address2, address_neighb = :address_neighb, address_city = :address_city, address_citycode = :address_citycode, address_state = :address_state, address_country = :address_country, address_countrycode = 1058");
            $sql->bindValue(":id_company", $id_company);
            $sql->bindValue(":name", $name);
            $sql->bindValue(":email", $email);
            $sql->bindValue(":phone", $phone);
            $sql->bindValue(":stars", $stars);
            $sql->bindValue(":internal_obs", $internal_obs);
            $sql->bindValue(":address_zipcode", $address_zipcode);
            $sql->bindValue(":address", $address);
            $sql->bindValue(":address_number", $address_number);
            $sql->bindValue(":address2", $address2);
            $sql->bindValue(":address_neighb", $address_neighb);
            $sql->bindValue(":address_city", $address_city);
            $sql->bindValue(":address_citycode", $address_citycode);
            $sql->bindValue(":address_state", $address_state);
            $sql->bindValue(":address_country", $address_country);
            $sql->execute();

        } catch (Exception $e) {
            echo 'Exceção capturada: ', $e->getMessage(), "\n";
        }
    }

    // metodo para edição de cliente
    public function edit($id, $id_company, $name, $email, $phone, $stars, $internal_obs, $address_zipcode, $address, $address_number, $address2, $address_neighb, $address_city, $address_state, $address_country, $address_citycode) {

        $sql = $this->db->prepare("UPDATE clients SET id_company = :id_company, name = :name, email = :email, phone = :phone, stars = :stars, internal_obs = :internal_obs, address_zipcode = :address_zipcode, address = :address, address_number = :address_number, address2 = :address2, address_neighb = :address_neighb, address_city = :address_city, address_citycode = :address_citycode, address_state = :address_state, address_country = :address_country, address_countrycode = 1058 WHERE id = :id AND id_company = :id_company2");
        $sql->bindValue(":id_company", $id_company);
        $sql->bindValue(":name", $name);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":phone", $phone);
        $sql->bindValue(":stars", $stars);
        $sql->bindValue(":internal_obs", $internal_obs);
        $sql->bindValue(":address_zipcode", $address_zipcode);
        $sql->bindValue(":address", $address);
        $sql->bindValue(":address_number", $address_number);
        $sql->bindValue(":address2", $address2);
        $sql->bindValue(":address_neighb", $address_neighb);
        $sql->bindValue(":address_city", $address_city);
        $sql->bindValue(":address_citycode", $address_citycode);
        $sql->bindValue(":address_state", $address_state);
        $sql->bindValue(":address_country", $address_country);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":id_company2", $id_company);
        $sql->execute();

    }

    // Metodo para pesquisa de cliente por nome (ainda desenvolvendo)
    public function searchClienteByName ($name, $id_company)
    {
        $array = array();

        $sql = $this->db->prepare("SELECT id, name FROM clients WHERE name LIKE :name AND id_company = :id_company");
        $sql->bindValue(":name", '%'. $name. '%');
        $sql->bindValue(":id_company", $id_company);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }
}
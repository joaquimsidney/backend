<?php

namespace Database;
use Database\Conection\Connect;
require_once "Conection\Conection.php";
use PDO;

class ClientRepository{

    public function create($client){
        $startConnection = new Connect();
        $query = "INSERT INTO clients (name, birth, phone, cpf, email, address, observation) VALUES (:name, :birth, :phone, :cpf, :email, :address, :observation)";
        $cmd = $startConnection->connection->prepare($query);

        $cmd->bindValue(":name",$client["name"]);
        $cmd->bindValue(":birth",$client["birth"]);
        $cmd->bindValue(":phone",$client["phone"]);
        $cmd->bindValue(":cpf",$client["cpf"]);
        $cmd->bindValue(":email",$client["email"]);
        $cmd->bindValue(":address",$client["address"]);
        // PDO::PARAM_NULL indica que observation pode ser null
        $cmd->bindValue(":observation",$client["observation"]);
        $cmd->execute();
        
        // Retorna o ID do cliente recém-inserido
        return $startConnection->connection->lastInsertId();
    }

    public function update($client){
        $startConnection = new Connect();
        $query ="UPDATE clients
                SET name = :name, birth = :birth, phone = :phone, cpf = :cpf,
                email = :email, address = :address, observation = :observation
                WHERE id = :id";
        $cmd = $startConnection->connection->prepare($query);

        $cmd->bindValue(":name",$client["name"]);
        $cmd->bindValue(":birth",$client["birth"]);
        $cmd->bindValue(":phone",$client["phone"]);
        $cmd->bindValue(":cpf",$client["cpf"]);
        $cmd->bindValue(":email",$client["email"]);
        $cmd->bindValue(":address",$client["address"]);
        // PDO::PARAM_NULL indica que observation pode ser null
        $cmd->bindValue(":observation",$client["observation"]);
        $cmd->bindValue(":id",$client["id"]);
        $cmd->execute();
        return $client;
    }

    public function delete($id){
        $startConnection = new Connect();
        $query = "DELETE FROM clients WHERE id = :id";
        $cmd = $startConnection->connection->prepare($query);
        $cmd->bindValue(":id",$id);
        $cmd->execute();
        return;
    }

    public function findByAll(){
        $startConnection = new Connect;
        $query = "SELECT * FROM clients";
        $cmd = $startConnection->connection->query($query);

        //convertendo para obj
        $clients = $cmd->fetchAll(PDO::FETCH_OBJ);
        return $clients;
    }

    public function findById($id){
        $startConnection = new Connect();
        $query = 'SELECT * FROM clients WHERE id = :id';
        $cmd = $startConnection->connection->prepare($query);

        $cmd->bindValue(":id",$id);
        $cmd->execute();
        $client = $cmd->fetch(PDO::FETCH_OBJ);
        return $client;
    }

    public function findByEmail($email){
        $startConnection = new Connect();
        $query = 'SELECT * FROM clients WHERE email = :email';
        $cmd = $startConnection->connection->prepare($query);

        $cmd->bindValue(":email",$email);
        $cmd->execute();
        $client = $cmd->fetch(PDO::FETCH_OBJ);
        return $client;
    }

    public function findIdByEmail($email){
        $startConnection = new Connect();
        $query = 'SELECT * FROM clients WHERE email = :email';
        $cmd = $startConnection->connection->prepare($query);

        $cmd->bindValue(":email",$email);
        $cmd->execute();
        $client = $cmd->fetch(PDO::FETCH_OBJ);
        if($client){
            return $client->id;
        }
        else{
            return false;
        }
    }

    public function findByCPF($cpf){
        $startConnection = new Connect();
        $query = 'SELECT * FROM clients WHERE cpf = :cpf';
        $cmd = $startConnection->connection->prepare($query);

        $cmd->bindValue(":cpf",$cpf);
        $cmd->execute();
        $client = $cmd->fetch(PDO::FETCH_ASSOC);
        return $client;
    }

    public function findIdByCPF($cpf){
        $startConnection = new Connect();
        $query = 'SELECT * FROM clients WHERE cpf = :cpf';
        $cmd = $startConnection->connection->prepare($query);

        $cmd->bindValue(":cpf",$cpf);
        $cmd->execute();
        $client = $cmd->fetch(PDO::FETCH_OBJ);
        if($client){
            return $client->id;
        }
        else{
            return false;
        }
    }
}

?>

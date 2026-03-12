<?php
/**
 * @author : Gaellan
 * @link : https://github.com/Gaellan
 */


class UserManager extends AbstractManager{
    public function __construct()
    {
        Parent::__construct();
    }
    
    public function findByEmail(string $email): ? User
    {
        $query = $this->db->prepare(
            'SELECT users.* FROM users
            WHERE users.email = :email'
        );
        $parameters = [
            'email' => $email
        ];
        
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        if($result !== false){
            $user = new User($result["username"], $result["email"], $result["password"], $result["role"], DateTime::createFromFormat('Y-m-d H:i:s', $result["created_at"]), $result["id"]);
            return $user;
        }
        else {
            return NULL;
        }
    }
    
    public function findOne(int $id): ? User
    {
        $query = $this->db->prepare(
            'SELECT users.* FROM users
            WHERE users.id = :id'
        );
        $parameters = [
            'id' => $id
        ];
        
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        if($result !== false){
            $user = new User($result["username"], $result["email"], $result["password"], $result["role"], DateTime::createFromFormat('Y-m-d H:i:s', $result["created_at"]), $result["id"]);
            return $user;
        }
        else {
            return NULL;
        }
    }
    
    public function create(User $user):User
    {
        $currentDateTime = date('Y-m-d H:i:s');
        $query = $this->db->prepare(
            'INSERT INTO users(username, email, password, role, created_at)
            VALUES (:username, :email, :password, :role, :created_at)'
        );
        $parameters = [
            'username' => $user->getUsername(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'role' => $user->getRole(),
            'created_at' => $currentDateTime
        ];
        
        $id = $this->db->lastInsertId();
        $user->setId($id);
        $query->execute($parameters);
        
        return $user;
    }
}
<?php

  class Users
  {
    private $conn;
    private $table = 'users';

    public $id;
    public $full_name;
    public $login;
    public $password;
    public $role_id;
    public $is_blocked;

    // constructor
    public function __construct($db){
      $this->conn = $db;
    }

    // get posts from database
    public function getAll(){
        $query = '
            SELECT
              r.role_name as role_name,
              u.id,
              u.full_name,
              u.login,
              u.is_blocked
            FROM
              ' . $this->table . ' u
              LEFT JOIN
                roles r ON u.role_id = r.id
            ORDER BY u.full_name ASC
        ';

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }

    public function create(){
      $query = 'INSERT INTO '.$this->table.' SET full_name = :full_name, login = :login, password = :password, role_id = :role_id, is_blocked = :is_blocked';
      
      // prepare
      $stmt = $this->conn->prepare($query);
      // clean
      $this->full_name      = htmlspecialchars(strip_tags($this->full_name));
      $this->login          = htmlspecialchars(strip_tags($this->login));
      $this->password       = htmlspecialchars(strip_tags($this->password));
      $this->role_id        = intval($this->role_id);
      $this->is_blocked     = htmlspecialchars(strip_tags($this->is_blocked));

      $stmt->bindParam(':full_name', $this->full_name);
      $stmt->bindParam(':login', $this->login);
      $stmt->bindParam(':password', $this->password);
      $stmt->bindParam(':role_id', $this->role_id);
      $stmt->bindParam(':is_blocked', $this->is_blocked);

      error_log("role_id: " . $this->role_id);

      if($stmt->execute()){
        return true;
      }

      printf("Error %s. \n", $stmt->error);
      return false;
    }

    public function update(){
        $query = 'UPDATE ' . $this->table . ' 
              SET full_name = COALESCE(:full_name, full_name),
                  login = COALESCE(:login, login),
                  password = COALESCE(:password, password),
                  role_id = COALESCE(:role_id, role_id),
                  is_blocked = COALESCE(:is_blocked, is_blocked)
              WHERE id = :id';

        $stmt = $this->conn->prepare($query);

        $this->full_name = !empty($this->full_name) ? htmlspecialchars(strip_tags($this->full_name)) : null;
        $this->login = !empty($this->login) ? htmlspecialchars(strip_tags($this->login)) : null;
        $this->role_id = !empty($this->role_id) ? intval($this->role_id) : null;
        $this->is_blocked = isset($this->is_blocked) ? (int) $this->is_blocked : null;
        $this->id = !empty($this->id) ? htmlspecialchars(strip_tags($this->id)) : null;

        $stmt->bindParam(':full_name', $this->full_name);
        $stmt->bindParam(':login', $this->login);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role_id', $this->role_id);
        $stmt->bindParam(':is_blocked', $this->is_blocked);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()){
            return true;
        }

        printf("Error %s. \n", $stmt->error);
        return false;
    }

  }
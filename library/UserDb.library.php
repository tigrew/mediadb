<?php

class UserDb extends DbBase {
    
    const _Admin = 1;
    const _Artist = 2;
    const _Customer = 3;
    
    
    
    
    static $roles = array(
        self::_Admin => "Admin",
        self::_Artist => "Artist",
        self::_Customer => "Customer"
        
    );
    
    public function __construct($table = "") {
        parent::__construct('User');
    }
    
    public function login($params = array()){
        return $this->fetch("SELECT *  FROM $this->table WHERE mail = ? AND password = ? ",$params);
    }
    
    
}

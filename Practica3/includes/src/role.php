<?php

class Role {
    const ROLE_DIR = 'roles';

    private $m_Name;
    private $m_Privileges;

    private function __construct($name) {
        $this->m_Name = $name;
        $this->m_Privileges = new Privileges();
    }

    public static function createFromFile($filename) {
        $file = fopen(self::ROLE_DIR.'/'.$filename.'.txt', 'r');

        if ($file == false)
            return null;

        $role = new Role($filename);

        while (($line = fgets($file)) !== false) {
            if (!empty(trim($line)))
                $role->m_Privileges->addPrivilege(trim($line));
        }

        return $role;
    }

    public function getName() {
        return $this->m_Name;
    }
    public function getPrivileges() {
        return $this->m_Privileges;
    }
}
<?php

namespace es\ucm\fdi\aw\src;

use es\ucm\fdi\aw\src\DAO\UserRolesDAO;

class Privileges
{
	const DELIMITER = '.';

	private $m_PrivilegeSet;

	public function __construct()
	{
		$this->m_PrivilegeSet = array();
	}

	public static function buildFromUser($userMail) {
		$userRolesDAO = new \es\ucm\fdi\aw\DAO\UserRolesDAO();
		$userRoles = $userRolesDAO->get('user_mail', $userMail);
		$privileges = new Privileges();

		foreach ($userRoles as $row) {
			$role = Role::createFromFile($row['role']);

			if ($role != null) {
				$privileges->merge($role->getPrivileges());
			}
		}

		return $privileges;
	}
	public static function getCurrentUserPrivileges() {
		$privileges = Role::getDefaultRole()->getPrivileges();

		if (isset($_SESSION['user'])) {
			$userRolesDAO = new UserRolesDAO();
			$allRoles = $userRolesDAO->getUserRoles($_SESSION['user']['mail']);

			foreach ($allRoles as $roleEntry) {
				$role = Role::createFromFile($roleEntry['role']);

				if ($role != null)
					$privileges->merge($role->getPrivileges());
			}
		}

		return $privileges;
	}
	
	public function hasPrivilege($privilege)
	{
		return isset($this->m_PrivilegeSet[$privilege]);
	}
	public function getAllPrivileges() {
		return $this->m_PrivilegeSet;
	}
	public function addPrivilege($privilege)
	{
		$this->m_PrivilegeSet[$privilege] = true;
	}
	public function removePrivilege($privilege)
	{
		unset($this->m_PrivilegeSet[$privilege]);
	}
	public function merge($privileges) {
		foreach($privileges->m_PrivilegeSet as $key => $value) {
			$this->addPrivilege($key);
		}
	}
}
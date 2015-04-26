<?php

namespace Elgg\RBAC;

use Jf;

/**
 * This class is a hack to replace the constructor of \PhpRbac\Rbac
 * as the original was hard-coded to read the config file
 * this way we can load our Elgg db credentials
 */
class Rbac extends \PhpRbac\Rbac {

	/**
	 * Override constructor of parent for custom database credentials
	 */
	public function __construct() {

		$adapter = "pdo_mysql";
		$host = elgg_get_config('dbhost');

		$dbname = elgg_get_config('dbname');
		$tablePrefix = elgg_get_config('dbprefix') . "rbac_";

		$user = elgg_get_config('dbuser');
		$pass = elgg_get_config('dbpass');

		require_once elgg_get_config('pluginspath') . 'elgg_rbac/vendor/owasp/phprbac/PhpRbac/src/PhpRbac/core/lib/Jf.php';

		$this->Permissions = Jf::$Rbac->Permissions;
		$this->Roles = Jf::$Rbac->Roles;
		$this->Users = Jf::$Rbac->Users;
	}

	/**
	 * create and populate the rbac specific tables
	 * @return void
	 */
	public function installDatabase() {

		$sql = file_get_contents(elgg_get_config('pluginspath') . PLUGIN_ID . '/vendor/owasp/phprbac/PhpRbac/database/mysql.sql');

		$sql = str_replace('PREFIX_', elgg_get_config('dbprefix') . 'rbac_', $sql);

		$tmpsql = elgg_get_config('dataroot') . 'rbac.sql';
		// temporarily store the file in dataroot so we can run it
		file_put_contents($tmpsql, $sql);

		run_sql_script($tmpsql);

		unlink($tmpsql);

		$this->reset(true);
	}

	/**
	 * Remove the rbac specific tables
	 * @return void
	 */
	public function uninstallDatabase() {
		$tables = array(
			'permissions',
			'rolepermissions',
			'roles',
			'userroles'
		);
		
		$prefix = elgg_get_config('dbprefix') . 'rbac_';
		
		foreach ($tables as $table) {
			
			// ensure it exists before attempting to drop it
			$result = get_data("SHOW TABLES LIKE '{$prefix}{$table}'");
			if (!$result) {
				continue;
			}
			$sql = "DROP TABLE {$prefix}{$table}";
			delete_data($sql);
		}
	}

}

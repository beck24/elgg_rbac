<?php

namespace Elgg\RBAC;
use Jf;

/**
 * This class is a hack to replace the constructor of \PhpRbac\Rbac
 * as the original was hard-coded to read the config file
 * this way we can load our Elgg db credentials
 */
class Rbac extends \PhpRbac\Rbac {
	public function __construct($unit_test = '')
    {

		$adapter="pdo_mysql";
		$host = elgg_get_config('dbhost');

		$dbname = elgg_get_config('dbname');
		$tablePrefix = "rbac_";

		$user = elgg_get_config('dbuser');
		$pass = elgg_get_config('dbpass');

        require_once elgg_get_config('pluginspath') . 'elgg_rbac/vendor/owasp/phprbac/PhpRbac/src/PhpRbac/core/lib/Jf.php';

        $this->Permissions = Jf::$Rbac->Permissions;
        $this->Roles = Jf::$Rbac->Roles;
        $this->Users = Jf::$Rbac->Users;
    }
}
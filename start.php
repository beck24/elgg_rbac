<?php

namespace Elgg\RBAC;

const PLUGIN_ID = 'elgg_rbac';
const PLUGIN_VERSION = 04252015;

require_once __DIR__ . '/vendor/autoload.php';

elgg_register_event_handler('init', 'system', __NAMESPACE__ . '\\init');

function init() {
	$rbac = new Rbac();
	
	//$perm_id = $rbac->Permissions->add('delete_posts', 'Can delete forum posts');
	$rbac->reset(true);
}

function is_db_installed() {
	return false;
}

function install_database($prefix = 'rbac_') {
	$prefix = sanitize_string($prefix);
	
	$sql = file_get_contents(__DIR__ . '/vendor/owasp/phprbac/PhpRbac/database/mysql.sql');
	
	$sql = str_replace('PREFIX_', $prefix, $sql);
	
	$tmpsql = elgg_get_config('dataroot') . 'rbac.sql';
	// temporarily store the file in dataroot so we can run it
	file_put_contents($tmpsql, $sql);

	run_sql_script($tmpsql);
	
	unlink($tmpsql);
}
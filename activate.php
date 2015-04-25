<?php

namespace Elgg\RBAC;

$version = elgg_get_plugin_setting('version', PLUGIN_ID);
if (!$version) {
	elgg_set_plugin_setting('version', PLUGIN_VERSION, PLUGIN_ID);
}

if (!is_db_installed()) {
	install_database();
}
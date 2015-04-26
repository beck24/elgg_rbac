<?php

namespace Elgg\RBAC;

const PLUGIN_ID = 'elgg_rbac';
const PLUGIN_VERSION = 04252015;

require_once __DIR__ . '/vendor/autoload.php';

elgg_register_event_handler('init', 'system', __NAMESPACE__ . '\\init');

function init() {
	
	$url = elgg_get_simplecache_url('css', 'rbac/tree');
	elgg_register_simplecache_view('css/rbac/tree');
	elgg_register_css('rbac/tree', $url);
	
	$url = elgg_get_simplecache_url('js', 'rbac/tree');
	elgg_register_simplecache_view('js/rbac/tree');
	elgg_register_js('rbac/tree', $url);
	
	elgg_register_action('rbac/roles/reset', __DIR__ . '/actions/roles/reset.php', 'admin');
	elgg_register_action('rbac/roles/add', __DIR__ . '/actions/roles/add.php', 'admin');
	
	elgg_register_ajax_view('rbac/roles/add');
}

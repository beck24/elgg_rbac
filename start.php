<?php

namespace Elgg\RBAC;

const PLUGIN_ID = 'elgg_rbac';
const PLUGIN_VERSION = 04252015;

require_once __DIR__ . '/vendor/autoload.php';

elgg_register_event_handler('init', 'system', __NAMESPACE__ . '\\init');

function init() {
	$rbac = new Rbac();
}

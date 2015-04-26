<?php

namespace Elgg\RBAC;

$parent_id = (int) get_input('parent_id');
$title = get_input('title');
$description = get_input('description');

$rbac = new Rbac();
if (!$rbac->Roles->getPath($parent_id)) {
	// this is not a valid parent ID
	register_error(elgg_echo('rbac:roles:error:id'));
	forward(REFERER);
}

if (!$title) {
	register_error(elgg_echo('rbac:roles:error:title'));
	forward(REFERER);
}

$rbac->Roles->add($title, $description, $parent_id);

system_message(elgg_echo('rbac:roles:add:success'));

forward(REFERER);
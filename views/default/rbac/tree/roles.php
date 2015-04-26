<?php

namespace Elgg\RBAC;

$roles = $vars['roles'];

if (!is_array($roles)) {
	return;
}

$rbac = new Rbac();

echo '<ul>';
foreach ($roles as $role) {
	$attributes = array(
		'class' => 'rbac-node elgg-lightbox',
		'data-id' => $role['ID'],
		'data-title' => $role['Title'],
		'data-description' => $role['Description'],
		'data-type' => 'role',
		'title' => $role['Title'],
		'href' => elgg_normalize_url('ajax/view/rbac/roles/add?id=' . $role['ID'])
	);
	echo '<li>';
	echo '<div class="rbac-menu">Hello</div>';
	echo '<a ' . elgg_format_attributes($attributes) . '>' . $role['Title'] . '</a>';
	
	$children = $rbac->Roles->children($role['ID']);

	if ($children) {
		echo elgg_view('rbac/tree/roles', array('roles' => $children));
	}
	
	echo '</li>';
}
echo '</ul>';

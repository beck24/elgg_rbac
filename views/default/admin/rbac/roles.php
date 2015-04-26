<?php

namespace Elgg\RBAC;

elgg_load_css('lightbox');
elgg_load_js('lightbox');
elgg_load_css('rbac/tree');
elgg_load_js('rbac/tree');

$root = array(
	array(
	'ID' => 1,
	'Title' => "Root",
	'Description' => "Root Role"
));

echo '<div class="center">';
echo '<div class="rbactree">';
echo elgg_view('rbac/tree/roles', array('roles' => $root));
echo '</div>';
echo '</div>';

echo elgg_view('output/confirmlink', array(
	'text' => elgg_echo('rbac:roles:reset'),
	'href' => 'action/rbac/roles/reset',
	'class' => 'elgg-button elgg-button-action'
));
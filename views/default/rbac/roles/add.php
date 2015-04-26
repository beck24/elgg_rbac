<?php

admin_gatekeeper();

$title = elgg_echo('rbac:roles:add');

$body = elgg_echo('rbac:roles:add:help');

$body .= '<div class="pam">';
$body .= '<label>' . elgg_echo('rbac:roles:title:label') . '</label>';
$body .= elgg_view('input/text', array(
	'name' => 'title',
	'value' => '',
));
$body .= '</div>';

$body .= '<div class="pam">';
$body .= '<label>' . elgg_echo('rbac:roles:description:label') . '</label>';
$body .= elgg_view('input/plaintext', array(
	'name' => 'description',
	'value' => '',
));
$body .= '</div>';

$body .= elgg_view('input/hidden', array('name' => 'parent_id', 'value' => $vars['id']));
$body .= elgg_view('input/submit', array('value' => elgg_echo('submit')));

$form = elgg_view('input/form', array(
	'action' => 'action/rbac/roles/add',
	'body' => $body
));

echo elgg_view_module('main', $title, $form);
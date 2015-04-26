<?php

namespace Elgg\RBAC;

$rbac = new Rbac();
$rbac->Roles->reset(true);

system_message(elgg_echo('rbac:roles:reset:success'));

forward(REFERER);
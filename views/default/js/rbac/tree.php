//<script>

elgg.provide('elgg.rbac');

elgg.rbac.init = function() {

	$('.rbactree a.rbac-node').click(function(e) {
		e.preventDefault();
		
		var id = $(this).attr('data-id');
	});
};

elgg.register_hook_handler('init', 'system', elgg.rbac.init);
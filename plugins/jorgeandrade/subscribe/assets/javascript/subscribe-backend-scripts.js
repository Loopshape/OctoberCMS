$(document).on('ready', function () {
	var $table = $('table');
	var $btn_export = $('#btn-export');
	$btn_export.on('click', function () {
		alert('j');
		$table.tableExport({type:'excel',escape:'false'});
	});
});
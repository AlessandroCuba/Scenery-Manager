$(function(){
	$('#modalLink').click(function(){
		$('#libraryModal').modal('show')
			.find('modalContent')
			.load($(this).attr('value'));
	});
});
// for our research bar//
var url = 'ajax/seek.php';
$('#search').on('keyup', function(){
	var query = $(this).val();
	//alert(query);
	if(query.length >0){
		$.ajax({
		type: 'POST',
		url : url,
		data : {
			query: query
		},
		beforeSend : function(){
			$('#loader').show();
		},
		success: function(result){
			$('#loader').hide();
			$('#show_results').html(result).show();

		}
	});
	}
	else{
		$('#show_results').hide();
	}
	
})

<!doctype html>
<html lang="en">
<head>
	<title>Debug - ajax</title>
	<meta charset="utf-8">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
</head>
<body>
<p>
	oh hi.
</p>
<script>
	$.ajax({
		url		: 'http://styliteapp.com/index.php/api/getSmallItems',
		type	: 'POST',
		dataType: 'json',
		data	: {
			'user_id'	: 1
		},
		success	: function(response){
			if(response.success){
				var images = '';
				$.each(response.images, function(){
					images+='<a href="#" data-src="'+this+'"><img src="http://styliteapp.com/uploads/s/'+this+'" width="148" height="99" /></a>';
				});
				//console.log(images);
				$('body').html(images);
			}
			//alert('ajax good');
		},
		error	: function(response){
			alert('ajax error');
		}
	});

	$('a').on('click', function(e){
		//var file = $(this).attr('data-src');
		alert('hi');
		e.preventDefault();
	});
</script>
</body>
</html>
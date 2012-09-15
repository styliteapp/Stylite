<!doctype html>
<html lang="en">
<head>
	<title>Debug - ajax</title>
	<meta charset="utf-8">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
</head>
<body>
<div id="images"></div>
<canvas style="background-color:lightblue;width:800px;height:600px;"></canvas>
<script>
	$('body').on('click', 'a', function(){
		var file = $(this).attr('data-src');
		//alert('hi');
		$('canvas').prepend('<img src="http://styliteapp.com/uploads/l/'+file+'" width="400" height="300" />');
		return false;
	});

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
					images+='<a href="http://google.com" data-src="'+this+'"><img src="http://styliteapp.com/uploads/s/'+this+'" width="148" height="99" /></a>';
				});
				//console.log(images);
				$('#images').html(images);
			}
			//alert('ajax good');
		},
		error	: function(response){
			alert('ajax error');
		}
	});
</script>
</body>
</html>
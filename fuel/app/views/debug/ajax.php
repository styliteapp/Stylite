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
					images+='<img src="'+this+'" />';
				});
				/*var images = '';
				$.each(response.images, function(){
					images+='<img src="http://styliteapp.com/uploads/s/250008162cd0e3f77fc98ffc56d21668.jpg" />';
				});*/
				console.log(images);
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
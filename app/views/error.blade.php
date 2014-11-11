<!DOCTYPE HTML>
<html>
	<head>
		<title>ODMApp-404 Page Not Found</title>
		
		
		{{HTML::style('css/error.css') }}

	</head>
	<body>
		<!--start-wrap-->
		<div class="wrap">
			<!---start-header---->
				<div class="header">
					<div class="logo">
						<h1><a href="{{URL::to('/dashboard/index')}}">Ohh</a></h1>
					</div>
				</div>
				
			<!---End-header---->
			<!--start-content------>
			<div class="content">
				
				{{ HTML::image('img/png.png') }}
				<p><span><label>O</label>hh.....</span>You Requested the page that is no longer There.</p>
				
				<a href="{{URL::to('/dashboard/index')}}">Back To Home</a>
		   </div>
				
				
   			
			<!--End-Cotent------>
		</div>
		<!--End-wrap--->
	</body>
</html>

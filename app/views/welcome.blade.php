<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#">
  <head>
  	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
	{{HTML::script('/js/TweenLite.min.js')}}
	{{HTML::script('/js/jquery-1.10.2.js')}}
	{{HTML::script('/js/main.js')}}
	{{HTML::style('/css/bootstrap.css')}}
	{{HTML::style('/css/style.css')}}
<body>
	

<div class="container">
	<div class="row vertical-offset-100">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">ODMApp</h3>
			    	
			 	</div>
			 	<div class="panel-body">
			 	<p>Offline Data Management app for managing products sheets </p>
			 	</div>
			  
			</div>
		</div>
    <div class="row vertical-offset-100">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Please sign in</h3>
			    	
			 	</div>
			  	<div class="panel-body">
			  	  <div class="bg-failure" id="fixPadding">{{ Session::get('message')}}</div>
			    	
			    	{{ Form::open(array('url' => '/index/signin', 'method' => 'POST')) }}

                    <fieldset>
			    	  	<div class="form-group">
			    	  	{{ Form::text("username", Input::old("username"), array('class' => 'form-control','placeholder'=>'Username')) }}
			    		    
			    		</div>
			    		<div class="form-group">
			    		{{Form::password('password', array('placeholder' => 'Password','class'=>'form-control'))}}
			    			
			    		</div>
			    		{{ Form::submit("Login",array('class'=>'btn btn-lg btn-success btn-block')) }}
			    		
			    	</fieldset>
			      	{{Form::close()}}
			      	
			      	<p class="bg-success" id="fixPadding">Username : admin </p>
			      	<p class="bg-success" id="fixPadding">Password : admin </p>
		 	    	
			    	
			    	
			    </div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard -ODMApp</title>

    <!-- Bootstrap core CSS -->
    {{HTML::style('/css/bootstrap.css')}}

    <!-- Add custom CSS here -->
    {{HTML::style('/css/sb-admin.css')}}
    {{HTML::style('/font-awesome/css/font-awesome.min.css')}}
    
    <!-- Page Specific CSS -->
     {{HTML::style('/css/morris.css')}}
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ URL::to('/')}}">ODMApp</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li><a href="{{URL::to('/dashboard/index')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{URL::to('dashboard/sheets')}}"><i class="fa fa-bar-chart-o"></i> Sheets Page</a></li>
            <li class="active"><a href="{{URL::to('dashboard/products')}}"><i class="fa fa-table"></i> Products Page </a></li>
            <li><a href="{{URL::to('dashboard/exporter')}}"><i class="fa fa-edit"></i>Data Exporter</a></li>
            
            
            
          </ul>

          <ul class="nav navbar-nav navbar-right navbar-user">
            
            
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>{{Auth::user()->username}} <b class="caret"></b></a>
              <ul class="dropdown-menu">
                
                
                
                <li class="divider"></li>
                <li><a href="{{URL::to('/logout')}}"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
<div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">
            <h1>Dashboard <small>Statistics Overview</small></h1>
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li class="active"><i class="fa fa-desktop"></i> Products</li>
            </ol>
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              @if(Session::has('message-success'))
              {{Session::get('message-success') }}
              @else 
                Welcome to ODMApp by <a class="alert-link" href="http://codingdroid.com">Subhajeet Dey</a>! Viewing All Products.
              
              @endif
            </div>
            @if (Session::has('message'))
            <div class="alert alert-danger alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{ Session::get('message') }}
            </div>
              
            @endif
          </div>

        </div><!-- /.row -->
        <div class="row">
        <div class="col-lg-16">
            <h2>Viewing All Products</h2>
            <div class="table-responsive">
              <table class="table table-bordered table-hover tablesorter">
                <thead>
                  <tr>
                  @foreach ($columns as $element=>$col)
                    <th>{{ $col->Field }} <i class="fa fa-sort"></i></th>
                  @endforeach
                    <th>Modify </th>
                  </tr>
                </thead>
                <tbody>
                
                    @foreach ($productsdata as $p)
                    <tr>
                      @foreach ($columns as $element=>$col)
                          @if ($col->Field=='sheet_name')
                         <td class="col-md-2"><a href="{{URL::to('products/showsheet/'.$sheetname)}}">{{ $p->{$col->Field} }}</td>
                         @else 
                         <td class="col-md-2">{{ $p->{$col->Field} }}</td>
                         @endif
                      @endforeach
                         <td class="col-md-2"><a href="{{URL::to('products/edit/'.$sheetname.'/'.$p->id.'') }}">Edit</a>/<a href="{{URL::to('products/delete/'.$sheetname.'/'.$p->id.'') }}">Delete</a></td>
                         </tr>
                      @endforeach
                         
                </tbody>
                
              </table>
              
              <h2><a href="{{URL::to('products/showsheet/'.$sheetname)}}">Add</a>/Update Products</h2>
              {{ HTML::ul($errors->all()) }}
              
                @if(Session::has('updating'))
                <?php 
                  //remove primary key , not meant to add/edit
                    unset($columns[0])
                  ?>
                <table class="table table-bordered table-hover">
                <thead>
                 <tr>
                    @foreach ($columns as $element=>$col)
                    <th>{{ $col->Field }}</th>
                    @endforeach
                    <th>Modify Product</th>
                  </tr>
                </thead>
                <tbody>              
                  
                   {{ Form::open(array('url'=>'products/update/'.$sheetname.'/'.$singleproduct->id.'','method'=>'POST')) }}
                   <tr>
                    @foreach ($columns as $element=>$col)
                       <td class="col-md-2">
                       {{ Form::text($col->Field, $singleproduct->{$col->Field}, array('class' => 'form-control','placeholder'=>$col->Field)) }}
                        </td>
                     @endforeach
                       <td class="col-md-2">{{Form::submit('Update Product',array('class' =>'btn btn-success'))}}</td>
                    {{ Form::close() }}
                   </tr>
                   </tbody>
                   </table>
             

                @else
                <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                  <?php 
                  //remove primary key , not meant to add/edit
                  //remove sheet_name when adding
                    unset($columns[0],$columns[1]);
                  ?>
                    @foreach ($columns as $element=>$col)
                    <th>{{ $col->Field }}</th>
                    @endforeach
                    <th>Modify Product</th>
                    </tr>
                </thead>
                 <tbody>              
                  <tr>
                    {{ Form::open(array('url'=>'products/create/'.$sheetname,'method'=>'POST')) }}
                    
                        <tr>
                         @foreach ($columns as $element=>$col)
                          
                         <td class="col-md-2"> {{ Form::text($col->Field, Input::old($col->Field), array('class' => 'form-control','placeholder'=>$col->Field)) }}
                         </td>
                         @endforeach
                         <td class="col-md-2">{{Form::submit('Add New Product',array('class' =>'btn btn-success'))}}</td>
                    
                        </tr>                                           
                                       
                    {{ Form::close() }}
                  </tr>
                 
                </tbody>
                </table>  
               
                 
                @endif
              
            </div>
          </div>
        </div>
      </div><!-- /#page-wrapper -->     

       

       

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    {{HTML::script('/js/jquery-1.10.2.js')}}
    {{HTML::script('/js/bootstrap.js')}}
    

    <!-- Page Specific Plugins -->
    {{HTML::script('/js/raphael-min.js')}}
    {{HTML::script('/js/raphael-min.js')}}
    {{HTML::script('/js/morris/chart-data-morris.js')}}
    {{HTML::script('/js/tablesorter/jquery.tablesorter.js')}}
    {{HTML::script('/js/tablesorter/tables.js')}}
    

  </body>
</html>

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
            <li class="active"><a href="{{URL::to('dashboard/sheets') }}"><i class="fa fa-bar-chart-o"></i> Sheets Page</a></li>
             <li><a href="{{URL::to('dashboard/products')}}"><i class="fa fa-table"></i> Products Page </a></li>
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
              <li class="active"><i class="fa fa-desktop"></i> Sheets</li>
            </ol>
            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              @if(Session::has('message-success'))
              {{Session::get('message-success') }}
              @else 
                Welcome to ODMApp by <a class="alert-link" href="http://codingdroid.com">Subhajeet Dey</a>! Viewing All Sheets.
              
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
        <div class="col-lg-12">
            <h2>Viewing Sheets</h2>
            <div class="table-responsive">
              <table class="table table-bordered table-hover tablesorter">
                <thead>
                  <tr>
                    <th>Id <i class="fa fa-sort"></i></th>
                    <th>Name <i class="fa fa-sort"></i></th>
                    <th>Description <i class="fa fa-sort"></i></th>
                    <th>Total Products <i class="fa fa-sort"></i></th>
                    <th>Added On <i class="fa fa-sort"></i></th>
                    <th>Export Sheet</th>
                    <th>Modify </th>
                  </tr>
                </thead>
                <tbody>
              @foreach ($sheetsdata as $sheets =>$sheet)
                                  
                  <tr>
                    <td class="col-md-1">{{ $sheet->id }}</td>
                    <td class="col-md-2"><a href='{{URL::to('products/showsheet/'.$sheet->name.'') }}'>{{ $sheet->name }}</a></td>
                    <td class="col-md-5">{{ $sheet->description }}</td>
                    <td class="col-md-2">{{ DB::table($sheet->name)->count() }}</td>
                    <td class="col-md-6">{{ $sheet->created_at }}</td>
                    <td class="col-md-2"><a href="{{URL::to('exporter/exportsheets/'.$sheet->name.'') }}">Export</a></td>
                    <td class="col-md-2"><a href="{{URL::to('sheets/edit/'.$sheet->id.'') }}">Edit</a>/<a href="{{URL::to('sheets/delete/'.$sheet->id.'') }}">Delete</a></td>
                  </tr>
                
                  @endforeach
                              
                  
                 
                </tbody>
              </table>
              <h2>Add/Update Sheets</h2>
              {{ HTML::ul($errors->all()) }}
              
              @if (Session::has('updating'))
              <form method="POST"  action="{{URL::to('sheets/update/'.$singlesheet->name.'')}}" id="form">
              @else
               <form method="POST"  action="{{URL::to('sheets/create')}}" id="form">
              @endif
              
              
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Name </th>
                    <th>Description </th>
                    <th>Add/Update Columns</th>
                    <th>More Columns</th>
                    <th>Modify </th>
                  </tr>
                </thead>
                @if(Session::has('updating'))
                <tbody>              
                  <tr id='hoja'>
                  
                   <td class="col-md-2">{{ Form::text('name', $singlesheet->name, array('class' => 'form-control','placeholder'=>'Sheet Name')) }}
                      </td>
                      <td class="col-md-3">{{ Form::text('description', $singlesheet->description, array('class' => 'form-control','placeholder'=>'Sheet Description')) }}</td>
                      <div id="andar">
                        <td class="col-md-2">
                        @foreach ($columns as $element=>$col)
                          
                           {{ Form::text('column[]',"$col->Field", array('class' => 'form-control','style'=>'margin-top:10px;')) }}
                           <a href="{{URL::to('sheets/deletecolumn/'.$singlesheet->name.'/'.$col->Field.'')}}">Delete</a>
                        @endforeach
                       

                        </td>
                        <input type="hidden" name='totalcolumns' value="1" id='totalcolumns'/>
                      </div>
                       <td class="col-md-2">
                       <button onclick="" id="m" class='btn btn-success'>Add More Columns</button>
                       </td>                         
                    <td class="col-md-2">{{Form::submit('Update Sheet',array('class' =>'btn btn-success'))}}</td>
                  
                    {{ Form::close() }}
                  </tr>
                
                 
                @else
                
                 <tbody>              
                  <tr id='hoja'>
                  
                                          
                      <td class="col-md-2">{{ Form::text('name', Input::old('name'), array('class' => 'form-control','placeholder'=>'Sheet Name')) }}
                      </td>
                      <td class="col-md-3">{{ Form::text('description', Input::old('description'), array('class' => 'form-control','placeholder'=>'Sheet Description')) }}</td>
                      <div id="andar">
                      <td class="col-md-2">{{ Form::text('column[]',Input::old('columns') , array('class' => 'form-control','placeholder'=>'Add Column')) }}</td>
                      <input type="hidden" name='totalcolumns' value="1" id='totalcolumns'/>
                      </div>
                       <td class="col-md-2">
                       <button onclick="" id="m" class='btn btn-success'>Add More Columns</button>
                       </td> 
                    <td class="col-md-2">{{Form::submit('Add New Sheet',array('class' =>'btn btn-success'))}}</td>
                    
                   
                  </tr>
                 
                </tbody>
                @endif
              </table>
</form>
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
    <script >
    $(document).ready(function($) {
      var i=0;
      var that;
      $('#m').click(function(e){
        e.preventDefault(e);
        
       that= "<input type='text' id='columns-"+i+"' name='column[]' placeholder='Add Another' class='form-control' style='margin-top:10px;'/>";
       $('#hoja>td').eq(2).append(that );
       
       $('#totalcolumns').val(i);
        i++;
       
         });                        
          
    });
    </script>
    

  </body>
</html>

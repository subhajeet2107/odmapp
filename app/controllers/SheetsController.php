<?php
class SheetsController extends BaseController {
	//BEWARE : its raw queries all over the place, for production ->sanitize  or use Doctrine ORM maybe 
	
	public function getIndex()
	{

		if(Auth::check()){
			$sheetsdata=Sheet::All();
		
		return View::make('sheets')->with('sheetsdata',$sheetsdata);
		}
		return View::make('welcome')->with('message','You Need to login first !');
	}
	
	/*public function getSheetscolumn()
	{

		
		$sheetsdata=Sheet::All();
			//create RAW queries as eloquent doesnt support raw sql :(
		$sheetsname= DB::select( DB::raw("SHOW TABLES;") );

		//slice off last two table names as they are helper tables
		$sheetsname = array_slice($sheetsname, 0,count($sheetsname)-2);


		//define array to hold sheets data
		$sheetsdata = array();
		$sheetsdata['name']=$sheetsname;
		
		foreach ($sheetsname as $table => $tablename) {
			
			//another raw query to find column names in tables dynamically
			
			//$columns = DB::select( DB::raw("SHOW COLUMNS FROM `$tablename->Tables_in_odmdb`") );
			
			//get all tables description
			$columns = DB::table($tablename->Tables_in_odmdb)->get();
			$sheetsdata['description'] = $columns;

			//total products in sheets
			$numproducts = DB::table($tablename->Tables_in_odmdb)->count();
			$sheetsdata['numproducts']=$numproducts;

			$sheetsdata['created_at']=time();
			
			
		}
		return View::make('sheets')->with('sheetsdata',$sheetsdata);
		
	}
	*/
	public function postCreate()
	{
		$validator = Validator::make(Input::all(), Sheet::$rules);
		if ($validator->fails()) {
			return Redirect::to('sheets/index')
				->withErrors($validator)
				->withInput()
				->with('message','Please Fix the Errors First !');
		} else {


			//on create sheet, create a table with same name and add the sheet into all sheets table

			
			//process to create corrosponding table
			//
			// sanitize columns inputs, not checking SQL injection here only blanks
			$sname = trim(Input::get('name'));
			
			
			//check if table/sheet exists
				if(Schema::hasTable($sname)){

					Session::flash('message-success', 'Sheet already exists in database!');
					return Redirect::to('sheets/index');
				}
				else
				{
					//using schema builder to create tables dynamically, column names are get from user input
					Schema::create($sname, function($table)
					{
						$sname = trim(Input::get('name'));
						//set a primary key (defaults)
					    $table->increments('id');
					    //set a key associating each product with sheet instance ! this will act as our foreign key
					    $table->string('sheet_name')->defaults($sname);
					    //redundant input , should help when updating table
					    $numcolumns = trim(Input::get('totalcolumns'));
						$columns= Input::get('column');																				
					    for($i=0;$i<count($columns);$i++) {
					    	$table->string(trim($columns[$i]));
					    }
					});
									    
					// store
					$sheet = new Sheet;
					$sheet->name = Input::get('name');
					$sheet->description  = Input::get('description');
					$sheet->save();
				}
			// redirect
			Session::flash('message-success', 'Successfully created sheet!');
			return Redirect::to('sheets/index');
		}

	}
	public function postUpdate($sheetname){
		$validator = Validator::make(Input::all(), Sheet::$rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('sheets/update/'.$sheetname.'')
				->withErrors($validator)
				->withInput()
				->with('message','Please Fix the Errors First !');
		} 
		else {			
					//first update corresponding sheet, else we will lose table name
					if($sheetname != trim(Input::get('name'))){
						$newsheetname = trim(Input::get('name'));
						Schema::rename($sheetname,$newsheetname);

					}

					Schema::table(trim(Input::get('name')), function($table){
					$newsheetname = trim(Input::get('name'));
					$oldcolumns = DB::select( DB::raw("SHOW COLUMNS FROM `$newsheetname`") );
					$newcolumns= Input::get('column');
						//detect adding or updating , if number is same that means columns are updated, if new>old , columns are added
						if(count($newcolumns)>=count($oldcolumns))
					    {
					    	for($i=0;$i<count($newcolumns);$i++) {

							     if($i<count($oldcolumns)){
								    	if($oldcolumns[$i]->Field!=$newcolumns[$i])
								    	{
								    		//rename column name dynamically
								    		$table->renameColumn($oldcolumns[$i]->Field, $newcolumns[$i]);
								    	}
							    	}
							    	else{
							    	
							    		$table->string($newcolumns[$i]);
							    	
							    	}

							    }
					    }																			
					    
					    
					});
					
					
			        // get sheet from sheets table
					$findsheetbyname = Sheet::where('name','=',$sheetname)->first();
					$singlesheet = Sheet::find($findsheetbyname->id);
					$singlesheet->name       = Input::get('name');
					$singlesheet->description      = Input::get('description');
					//save the update sheetname or description in sheets table
					$singlesheet->save();

					
									
			// redirect
			Session::flash('message', 'Successfully updated sheet!');
			return Redirect::to('sheets/index');
		}

		
	}
	public function getEdit($id){
		$sheetsdata=Sheet::All();
		$singlesheet = Sheet::find($id);
		$columns = DB::select( DB::raw("SHOW COLUMNS FROM `$singlesheet->name`") );
		
		Session::flash('updating', $id);
		return View::make('sheets')->with('sheetsdata',$sheetsdata)->with('singlesheet',$singlesheet)->with('columns',$columns);
	}
	
	public function getDelete($id)
	{
		$singlesheet = Sheet::find($id);
		$sheetname= $singlesheet->name;
		Schema::dropIfExists($sheetname);
		$singlesheet->delete();

		// redirect
		Session::flash('message', 'Successfully deleted sheet!');
			return Redirect::to('sheets/index');
	}
	public function getDeletecolumn($sheetname)
	{
		
		$findsheetbyname = Sheet::where('name','=',$sheetname)->first();
		$singlesheet = Sheet::find($findsheetbyname->id);
		Schema::table($singlesheet->name,function($table){
			$colname = Request::segment(4);
			if($table->hasColumn($colname)){
			$table->dropColumn($colname);
			}else{
				Session::flash('message', 'Cannot Delete Column,some error occured!');
				return Redirect::to('sheets/index');
			}
		});
		

		// redirect
		Session::flash('message', 'Successfully deleted column!');
			return Redirect::to('sheets/index');
	}
}
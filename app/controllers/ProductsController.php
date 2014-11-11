<?php
class ProductsController extends BaseController {

	
	public function getIndex()
	{
		
		if(Auth::check()){
			return Redirect::to('allproducts/index');
		}
		return View::make('welcome')->with('message','You Need to login first !');
	}
	
	
	public function postCreate($sheetname)
	{
		
			// store
			$columns = DB::select( DB::raw("SHOW COLUMNS FROM `$sheetname`") );
			$prodObj = array();
			$prodObj['sheet_name']=$sheetname;
			foreach ($columns as $key => $value) {
				if(Input::get($value->Field)==""){

				}else{
					$prodObj[$value->Field]= trim(Input::get($value->Field));
				}
				
			}
			
			DB::table($sheetname)->insert($prodObj);
			
			 // redirect
			Session::flash('message-success', 'Successfully created Product!');
			return Redirect::to('products/showsheet/'.$sheetname);
		
		   

	}
	public function getShowsheet($sheetname)
	{
		//get all products from sheet
		$columns = DB::select( DB::raw("SHOW COLUMNS FROM `$sheetname`") );
		
		$productsdata= DB::table($sheetname)->get();
		Session::flash('updating', null);
		return View::make('products')
		             ->with('columns',$columns)
		             ->with('productsdata',$productsdata)
		             ->with('sheetname',$sheetname)
		             ->with('message','Showing Products from Sheet !');
		
		
	}


	public function getEdit($sheetname){
		//get all products from sheet
		$columns = DB::select( DB::raw("SHOW COLUMNS FROM `$sheetname`") );
		
		$productsdata= DB::table($sheetname)->get();

		//get product id
		$colname = Request::segment(4);
		$singleproduct = DB::table($sheetname)->where('id', '=',$colname )->first();
		Session::flash('updating', $sheetname);
		return View::make('products')
					->with('columns',$columns)
					->with('productsdata',$productsdata)
					->with('sheetname',$sheetname)
					->with('singleproduct',$singleproduct);
	}



	public function postUpdate($sheetname){
		
			// store
			$columns = DB::select( DB::raw("SHOW COLUMNS FROM `$sheetname`") );

			$prodObj = array();
			foreach ($columns as $key => $value) {
				if(Input::get($value->Field)==""){

				}else{
					$prodObj[$value->Field]= trim(Input::get($value->Field));
				}
				
			}
			$colname = Request::segment(4);
			

			DB::table($sheetname)->where('id', '=',$colname )->update($prodObj);
			// redirect
			Session::flash('message', 'Successfully updated Product!');
			return Redirect::to('products/showsheet/'.$sheetname);
		

		
	}
	public function getDelete($sheetname)
	{
		$colname = Request::segment(4);
		DB::table($sheetname)->where('id', '=',$colname )->delete();
		
		// redirect
		Session::flash('message', 'Successfully deleted Product!');
			return Redirect::to('products/showsheet/'.$sheetname);
	}
}
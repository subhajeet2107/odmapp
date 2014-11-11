<?php
class AllProductsController extends BaseController {

	
	public function getIndex()
	{
		
		if(Auth::check()){
			$columns =array();
			$productsdata = array();
			$sheetname =DB::table('sheets')->select('name')->get();
			foreach ($sheetname as $key=>$value) {
				$columns[] = DB::select( DB::raw("SHOW COLUMNS FROM `$value->name`") );
				$productsdata[]= DB::table($value->name)->get();
			}
			
			$unique_field = array();
			foreach ($columns as $key => $col) {
				
				foreach ($col as $k => $v) {
					$unique_field[] = $v->Field;
				}
				
			}
			$unique_field = array_unique($unique_field);
			

			return View::make('allproducts')
						->with('sheetname',$sheetname)
						->with('columns',$unique_field)
						->with('productsdata',$productsdata);
		}
		return View::make('welcome')->with('message','You Need to login first !');
	}
	
}
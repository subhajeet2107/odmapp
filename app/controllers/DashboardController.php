<?php
class DashboardController extends BaseController {

	
	public function getIndex()
	{

		if(Auth::check()){
			$total_products =0;
			$total_sheets =  DB::table('sheets')->count();
			//for each sheet get row count from each corrosponding sheet table
			$sheetname =DB::table('sheets')->select('name')->get();
			foreach ($sheetname as $key=>$value) {
				$total_products += DB::table($value->name)->count();
			}
			
		return View::make('dashboard')->with('numsheets',$total_sheets)->with('numproducts',$total_products);
		}
		return View::make('welcome')->with('message','You Need to login first !');
	}
	
	public function getSheets(){
		return Redirect::to('sheets/index');
	}
	public function getProducts(){
		return Redirect::to('products/index');
	}
	public function getExporter(){
		return Redirect::to('exporter/index');
	}
	

}
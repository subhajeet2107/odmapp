<?php

class ExporterController extends BaseController {

	

	public function getIndex()
	{
		return View::make('exporter');
	}

	public function getExportallproducts(){
		$allproducts = array();
		$sheetname =DB::table('sheets')->select('name')->get();
		foreach ($sheetname as $key=>$value) {
				$allproducts[]= DB::table($value->name)->get();
			}
		$name = time();
		file_put_contents($name.'-products.json', json_encode($allproducts, JSON_FORCE_OBJECT));
		$this->download_send_headers($name.'-products.json');
		return  View::make('exporter')->with('message','All Products Exported Successfully');

	}
	public function getExportsheets($sheetname){
		
			
			$productsdata = DB::table($sheetname)->get();

			file_put_contents($sheetname.'.json', json_encode($productsdata, JSON_FORCE_OBJECT));
			$this->	download_send_headers($sheetname.'.json');
	}
	protected function download_send_headers($filename) {
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename="'.basename($filename).'"');
		header('Content-Length: ' . filesize($filename));
		readfile($filename);
	}

}

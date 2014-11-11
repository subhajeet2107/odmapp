<?php
 
class SheetsSeeder extends DatabaseSeeder
{
  public function run()
  {
    $sheets = [
      [
        "name"=>"data-1",
        "description"=>"Convection Oven and Washing Machine",
        "numproducts"=>114
      ],
       [
        "name"=>"data-2",
        "description"=>"Philips LED Tvs",
        "numproducts"=>98
      ],[
        "name"=>"data-3",
        "description"=>"Panasonic ACs",
        "numproducts"=>26
      ]
    ];
  
    foreach ($sheets as $sheet) {
      Sheet::create($sheet);
    }
  }
}
<?php
 
class ProductsSeeder extends DatabaseSeeder
{
  public function run()
  {
    $products = [
    [
      "category"=>"FPD",
      "brand"=>"PHILIPS",
      "segment"=>"LED",
      "size"=>"20",
      "starmodel"=>"3",
      "sheet_name"=>"data-2",
      "model"=>"20PFL3938",
      "mrp"=>12000,
      "dp"=>11110,
      "srp"=>10890,
      "sheet_id"=>2
    ]
    
    ];
  
    foreach ($products as $product) {
      Product::create($product);
    }
  }
}
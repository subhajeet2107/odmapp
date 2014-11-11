<?php
class Product extends Eloquent {

  
  protected $table = 'products';

  protected $fillable = array('category','model','dp','mrp','srp','brand','tonnage','starmodel','segment','size');
  public static $rules = array('category' => 'required|min:2','mrp' =>'required|min:1','dp'=>'required|min:1'); 

  public function product()
  {
    return $this->belongsTo('Sheet');
  }

}

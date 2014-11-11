<?php
class Sheet extends Eloquent {

  
  protected $table = 'sheets';

  protected $fillable = array('name','description','numproducts');
  public static $rules = array('name' => 'required|min:2','description' =>'required|min:2');  
  public function products()
  {
    return $this->hasMany('Product');
  }

}

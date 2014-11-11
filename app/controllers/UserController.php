<?php

class UserController extends BaseController{
	public function __construct()
	{
		
		$this->beforeFilter('csrf',array('on'=>'post'));
	}
	public function index()
	{
		if(Auth::check()){
			return Redirect::to('/dashboard')->with('username','admin');
		}
		return View::make('welcome');
	}
	public function signin()
	{
		if(Auth::attempt(array('username'=>Input::get('username'),'password'=>Input::get('password'))))
		{
			return Redirect::to('/dashboard')->with('username','admin');
		}
		return Redirect::to('/index')->with('message','username/password incorrect');
	}

	public function logout()
	{
		Auth::logout();
		return View::make('welcome')->with('message','You have Successfully Logged Out !');
	}
}
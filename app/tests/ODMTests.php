<?php

class ODMSTests extends TestCase {

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testBasicExample()
	{
		$crawler = $this->client->request('GET', '/');

		$this->assertTrue($this->client->getResponse()->isOk());
	}
	public function testHomePage()
    {
        $response = $this->call('GET', '/');
        $this->assetTrue($response);
    }
    public function check_index_page()
    {
    	$r = $this->call('GET', '/index');
    	$this->assertResponseOk();
    }
    public function login_auth_check()
    {
    	$response = $this->action('GET', 'UserController@signin', array('user' => 1));
    	$this->assertResponseOk();;
    }
    public function testMethod()
	{
	    $this->call('GET', '/dashboard/index');

	    $this->assertViewHas('numproducts');
	    $this->assertViewHas('numsheets');
	}


}

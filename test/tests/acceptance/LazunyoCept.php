<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Add product to database.');
$I->amOnPage('/');
$I->seeCurrentUrlEquals('/public/');
$I->wait(2);

function test_login($I) {
	// logging in
	$I->amOnPage('/');
	$I->fillField('email','test@test');
	$I->fillField('password','test');
	$I->click('/html/body/div/form/div[1]/div/div[4]/button');
	$I->wait(2);
	$I->seeCurrentUrlEquals('/public/show-product.php');
}

function test_addItem($I) {
	// adding item
	$I->click('/html/body/ul/li[2]/a'); 				// click add item
	$I->fillField('name','');
	$I->fillField('price','');
	$I->fillField('image','');
	$I->fillField('description','');
	$I->fillField('qty','');
	$I->click('/html/body/div/form/div[7]/button'); 	// confirm
	//$I->seeCurrentUrlEquals('');
}

function test_editItem($I) {
	// editting item
	$I->amOnPage('/show-product,php');
	$I->click('');
	$I->fillField('','');			// name
	$I->fillField('','');			// price
	$I->fillField('','');			// desc.
	$I->fillField('','');			// quan
	$I->click(''); 					// confirm
}

function test_deleteItem($I) 
{
	$I->seeCurrentUrlEquals('/public/show-product.php');
	$I->click('/html/body/div/form/table/tbody/tr[2]/td[9]/a');
	$I->acceptPopup();
}

test_login($I);

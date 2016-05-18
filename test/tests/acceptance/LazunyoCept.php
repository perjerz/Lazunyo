<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Add product to database.');
//$I->amOnPage('/');
$I->seeCurrentUrlEquals('/form-login.html');

function test_login($I) {
	// logging in
	$I->amOnPage('/form-login.html');
	$I->fillField('email','test@test.test');
	$I->fillField('password','test');
	$I->click('/html/body/div/form/div[1]/div/div[4]/button');
	$I->wait(2);
	$I->seeCurrentUrlEquals('/show-product.php');
}

function test_addItem($I) {
	// adding item
	$I->amOnPage('/show-product.php');
	$I->click(''); 					// click add item
	$I->fillField('','');			// name
	$I->fillField('','');			// price
	$I->fillField('','');			// desc.
	$I->fillField('','');			// quan
	$I->click(''); 					// confirm
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

function test_deleteItem($I) {
	$I->amOnPage('/show-product,php');
	$I->click('');
}

test_login($I);

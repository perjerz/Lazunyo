<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Add product to database.');
$I->amOnPage('/');
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
	$I->fillField('','');
	$I->fillField('','');
	$I->fillField('','');
	$I->fillField('','');
	$I->click('');
	$I->seeCurrentUrlEquals('');
}

test_login($I);

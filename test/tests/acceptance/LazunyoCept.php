<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Add product to database.');
$I->amOnPage('/');
$I->seeCurrentUrlEquals('/form-login.html');

function test_login($I) {
	// logging in
	$I->amOnPage('/form-login.html');
	$I->fillField('','');
	$I->fillField('','');
	$I->click('');
	$I->seeCurrentUrlEquals('');
}

function test_addItem($I) {
	// adding item
	$I->amOnPage('/add-product.php');
	$I->fillField('','');
	$I->fillField('','');
	$I->fillField('','');
	$I->fillField('','');
	$I->click('');
	$I->seeCurrentUrlEquals('');
}

<?php


use Khomeriki\BitgoWallet\Bitgo;

test('ping Bitgo rest api', function () {
    $response = (new Bitgo())->ping();
    $this->assertTrue($response->ok());
});

test('ping BitgoExpress rest api', function () {
    $response = (new Bitgo())->pingExpress();
    $this->assertTrue($response->ok());
});

it('can detect current bitgo user', function () {
    $response = (new Bitgo())->me();
    $this->assertTrue($response->ok());
    expect($response->json())
        ->toBeArray()
        ->toHaveKey('user');
});

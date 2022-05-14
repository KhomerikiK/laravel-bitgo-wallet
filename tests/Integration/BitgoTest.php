<?php

test('ping Bitgo rest api', function () {
    $response = $this->adapter->ping();
    $this->assertTrue($response->ok());
});

test('ping BitgoExpress rest api', function () {
    $response = $this->adapter->pingExpress();
    $this->assertTrue($response->ok());
});

it('can detect current bitgo user', function () {
    $response = $this->adapter->me();
    $this->assertTrue($response->ok());
    expect($response->json())
        ->toBeArray()
        ->toHaveKey('user');
});

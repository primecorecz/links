<?php

use Illuminate\Database\Eloquent\Model;
use Primecorecz\Links\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);

expect()->extend('toBeModel', function (Model $model) {
    return $this
        ->toBeInstanceOf(get_class($model))
        ->id->toBe($model->id);
});

expect()->extend('toContainModel', function (Model $model) {

    expect($this->value->pluck('id')->contains($model->id))->toBeTrue();

    return $this;
});

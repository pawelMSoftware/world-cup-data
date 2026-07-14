<?php

declare(strict_types=1);

it('is valid JSON', function (): void {
    expect(fn () => loadJson('confederations.json'))->not->toThrow(JsonException::class);
});

it('decodes to an array at the root', function (): void {
    expect(confederations())->toBeArray();
});

it('contains exactly 6 records', function (): void {
    expect(confederations())->toHaveCount(6);
});

it('has exactly the required fields, in order, on every record', function (): void {
    foreach (confederations() as $confederation) {
        expect(array_keys($confederation))->toBe(['id', 'code', 'name']);
    }
});

it('has a valid UUID v7 id for every record', function (): void {
    foreach (confederations() as $confederation) {
        expect(isUuidV7($confederation['id']))->toBeTrue("Invalid UUID v7: {$confederation['id']}");
    }
});

it('has a unique id for every record', function (): void {
    expect(duplicateValues(array_column(confederations(), 'id')))->toBeEmpty();
});

it('has a unique code for every record', function (): void {
    expect(duplicateValues(array_column(confederations(), 'code')))->toBeEmpty();
});

it('supports exactly the six FIFA confederations', function (): void {
    expect(array_column(confederations(), 'code'))->toEqualCanonicalizing([
        'AFC', 'CAF', 'CONCACAF', 'CONMEBOL', 'OFC', 'UEFA',
    ]);
});

it('has a non-empty name for every record', function (): void {
    foreach (confederations() as $confederation) {
        expect($confederation['name'])->toBeString()->not->toBeEmpty();
    }
});

it('has a unique name for every record', function (): void {
    expect(duplicateValues(array_column(confederations(), 'name')))->toBeEmpty();
});

it('is sorted by code ascending', function (): void {
    $codes = array_column(confederations(), 'code');
    $sorted = $codes;
    sort($sorted, SORT_STRING);

    expect($codes)->toBe($sorted);
});

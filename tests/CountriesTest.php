<?php

declare(strict_types=1);

it('is valid JSON', function (): void {
    expect(fn () => loadJson('countries.json'))->not->toThrow(JsonException::class);
});

it('has all required fields on every record', function (): void {
    foreach (countries() as $country) {
        expect($country)->toHaveKeys(['id', 'iso2', 'iso3', 'name', 'official_name']);
    }
});

it('has a unique id for every record', function (): void {
    expect(duplicateValues(array_column(countries(), 'id')))->toBeEmpty();
});

it('has a valid UUID v7 id for every record', function (): void {
    foreach (countries() as $country) {
        expect(isUuidV7($country['id']))->toBeTrue("Invalid UUID v7: {$country['id']}");
    }
});

it('has a unique iso2 for every record', function (): void {
    expect(duplicateValues(array_column(countries(), 'iso2')))->toBeEmpty();
});

it('has a unique iso3 for every record', function (): void {
    expect(duplicateValues(array_column(countries(), 'iso3')))->toBeEmpty();
});

it('has a unique name for every record', function (): void {
    expect(duplicateValues(array_column(countries(), 'name')))->toBeEmpty();
});

it('has a non-empty official_name for every record', function (): void {
    foreach (countries() as $country) {
        expect($country['official_name'])->toBeString()->not->toBeEmpty();
    }
});

it('is sorted by iso2 ascending', function (): void {
    $iso2Codes = array_column(countries(), 'iso2');
    $sorted = $iso2Codes;
    sort($sorted, SORT_STRING);

    expect($iso2Codes)->toBe($sorted);
});

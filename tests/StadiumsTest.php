<?php

declare(strict_types=1);

it('is valid JSON', function (): void {
    expect(fn () => loadJson('stadiums.json'))->not->toThrow(JsonException::class);
});

it('has all required fields on every record', function (): void {
    foreach (stadiums() as $stadium) {
        expect($stadium)->toHaveKeys(['id', 'country_id', 'code', 'name', 'city', 'latitude', 'longitude']);
    }
});

it('has a unique id for every record', function (): void {
    expect(duplicateValues(array_column(stadiums(), 'id')))->toBeEmpty();
});

it('has a valid UUID v7 id for every record', function (): void {
    foreach (stadiums() as $stadium) {
        expect(isUuidV7($stadium['id']))->toBeTrue("Invalid UUID v7: {$stadium['id']}");
    }
});

it('has a unique code for every record', function (): void {
    expect(duplicateValues(array_column(stadiums(), 'code')))->toBeEmpty();
});

it('has a non-empty name for every record', function (): void {
    foreach (stadiums() as $stadium) {
        expect($stadium['name'])->toBeString()->not->toBeEmpty();
    }
});

it('has a non-empty city for every record', function (): void {
    foreach (stadiums() as $stadium) {
        expect($stadium['city'])->toBeString()->not->toBeEmpty();
    }
});

it('references an existing country for every country_id', function (): void {
    $countryIds = array_column(countries(), 'id');

    foreach (stadiums() as $stadium) {
        expect($countryIds)->toContain($stadium['country_id']);
    }
});

it('is sorted by code ascending', function (): void {
    $codes = array_column(stadiums(), 'code');
    $sorted = $codes;
    sort($sorted, SORT_STRING);

    expect($codes)->toBe($sorted);
});

it('has a latitude and a longitude for every record', function (): void {
    foreach (stadiums() as $stadium) {
        expect($stadium)->toHaveKeys(['latitude', 'longitude']);
    }
});

it('stores latitude and longitude as JSON numbers', function (): void {
    foreach (stadiums() as $stadium) {
        expect($stadium['latitude'])->toBeFloat();
        expect($stadium['longitude'])->toBeFloat();
    }
});

it('has a latitude between -90 and 90', function (): void {
    foreach (stadiums() as $stadium) {
        expect($stadium['latitude'])->toBeGreaterThanOrEqual(-90)->toBeLessThanOrEqual(90);
    }
});

it('has a longitude between -180 and 180', function (): void {
    foreach (stadiums() as $stadium) {
        expect($stadium['longitude'])->toBeGreaterThanOrEqual(-180)->toBeLessThanOrEqual(180);
    }
});

it('stores latitude and longitude with a precision of exactly 6 decimal places', function (): void {
    foreach (['latitude', 'longitude'] as $field) {
        $rawValues = rawFieldValues('stadiums.json', $field);

        expect($rawValues)->toHaveCount(count(stadiums()));

        foreach ($rawValues as $value) {
            expect(decimalPlaces($value))->toBe(6, "Expected 6 decimal places for {$field}, got \"{$value}\"");
        }
    }
});

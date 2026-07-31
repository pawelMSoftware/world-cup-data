<?php

declare(strict_types=1);

it('is valid JSON', function (): void {
    expect(fn () => loadJson('football_associations.json'))->not->toThrow(JsonException::class);
});

it('decodes to an array at the root', function (): void {
    expect(footballAssociations())->toBeArray();
});

it('contains exactly 66 records', function (): void {
    expect(footballAssociations())->toHaveCount(66);
});

it('has exactly the required fields, in order, on every record', function (): void {
    foreach (footballAssociations() as $association) {
        expect(array_keys($association))->toBe(['id', 'country_id', 'name']);
    }
});

it('has a unique id for every record', function (): void {
    expect(duplicateValues(array_column(footballAssociations(), 'id')))->toBeEmpty();
});

it('has a valid UUID v7 id for every record', function (): void {
    foreach (footballAssociations() as $association) {
        expect(isUuidV7($association['id']))->toBeTrue("Invalid UUID v7: {$association['id']}");
    }
});

it('has a non-empty name for every record', function (): void {
    foreach (footballAssociations() as $association) {
        expect($association['name'])->toBeString()->not->toBeEmpty();
    }
});

it('has a unique name for every record', function (): void {
    expect(duplicateValues(array_column(footballAssociations(), 'name')))->toBeEmpty();
});

it('references an existing country for every country_id', function (): void {
    $countryIds = array_column(countries(), 'id');

    foreach (footballAssociations() as $association) {
        expect($countryIds)->toContain($association['country_id']);
    }
});

it('is sorted by name ascending', function (): void {
    $names = array_column(footballAssociations(), 'name');
    $sorted = $names;
    sort($sorted, SORT_STRING);

    expect($names)->toBe($sorted);
});

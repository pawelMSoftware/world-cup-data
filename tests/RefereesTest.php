<?php

declare(strict_types=1);

it('is valid JSON', function (): void {
    expect(fn () => loadJson('referees.json'))->not->toThrow(JsonException::class);
});

it('decodes to an array at the root', function (): void {
    expect(referees())->toBeArray();
});

it('contains exactly 147 records', function (): void {
    expect(referees())->toHaveCount(147);
});

it('has exactly the required fields, in order, on every record', function (): void {
    foreach (referees() as $referee) {
        expect(array_keys($referee))->toBe(['id', 'code', 'name', 'association']);
    }
});

it('has a valid UUID v7 id for every record', function (): void {
    foreach (referees() as $referee) {
        expect(isUuidV7($referee['id']))->toBeTrue("Invalid UUID v7: {$referee['id']}");
    }
});

it('has a unique id for every record', function (): void {
    expect(duplicateValues(array_column(referees(), 'id')))->toBeEmpty();
});

it('has a lowercase ASCII hyphen-separated code for every record', function (): void {
    foreach (referees() as $referee) {
        expect($referee['code'])->toMatch('/^[a-z0-9]+(-[a-z0-9]+)*$/');
    }
});

it('has a unique code for every record', function (): void {
    expect(duplicateValues(array_column(referees(), 'code')))->toBeEmpty();
});

it('has a non-empty name for every record', function (): void {
    foreach (referees() as $referee) {
        expect($referee['name'])->toBeString()->not->toBeEmpty();
    }
});

it('has a unique name for every record', function (): void {
    expect(duplicateValues(array_column(referees(), 'name')))->toBeEmpty();
});

it('has a non-empty association for every record', function (): void {
    foreach (referees() as $referee) {
        expect($referee['association'])->toBeString()->not->toBeEmpty();
    }
});

it('has no duplicate records', function (): void {
    $serialized = array_map(
        static fn (array $referee): string => json_encode($referee, JSON_THROW_ON_ERROR),
        referees(),
    );

    expect(duplicateValues($serialized))->toBeEmpty();
});

it('is sorted by name ascending', function (): void {
    $names = array_column(referees(), 'name');
    $sorted = $names;
    sort($sorted, SORT_STRING);

    expect($names)->toBe($sorted);
});

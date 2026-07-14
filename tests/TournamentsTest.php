<?php

declare(strict_types=1);

it('is valid JSON', function (): void {
    expect(fn () => loadJson('tournaments.json'))->not->toThrow(JsonException::class);
});

it('decodes to an array at the root', function (): void {
    expect(tournaments())->toBeArray();
});

it('contains exactly 7 records', function (): void {
    expect(tournaments())->toHaveCount(7);
});

it('has exactly the required fields, in order, on every record', function (): void {
    foreach (tournaments() as $tournament) {
        expect(array_keys($tournament))->toBe(['id', 'code', 'year', 'name']);
    }
});

it('has a valid UUID v7 id for every record', function (): void {
    foreach (tournaments() as $tournament) {
        expect(isUuidV7($tournament['id']))->toBeTrue("Invalid UUID v7: {$tournament['id']}");
    }
});

it('has a unique id for every record', function (): void {
    expect(duplicateValues(array_column(tournaments(), 'id')))->toBeEmpty();
});

it('has a four-digit string code for every record', function (): void {
    foreach (tournaments() as $tournament) {
        expect($tournament['code'])->toBeString();
        expect($tournament['code'])->toMatch('/^\d{4}$/');
    }
});

it('has a unique code for every record', function (): void {
    expect(duplicateValues(array_column(tournaments(), 'code')))->toBeEmpty();
});

it('has an integer year for every record', function (): void {
    foreach (tournaments() as $tournament) {
        expect($tournament['year'])->toBeInt();
    }
});

it('has a unique year for every record', function (): void {
    expect(duplicateValues(array_column(tournaments(), 'year')))->toBeEmpty();
});

it('has a non-empty name for every record', function (): void {
    foreach (tournaments() as $tournament) {
        expect($tournament['name'])->toBeString()->not->toBeEmpty();
    }
});

it('has a unique name for every record', function (): void {
    expect(duplicateValues(array_column(tournaments(), 'name')))->toBeEmpty();
});

it('has a code that equals the string representation of its year', function (): void {
    foreach (tournaments() as $tournament) {
        expect($tournament['code'])->toBe((string) $tournament['year']);
    }
});

it('supports exactly the required years', function (): void {
    expect(array_column(tournaments(), 'year'))->toEqualCanonicalizing([
        2002, 2006, 2010, 2014, 2018, 2022, 2026,
    ]);
});

it('has a name that exactly matches the OpenFootball source for its year', function (): void {
    // Verified against the top-level "name" field of each year's worldcup.json
    // on the master branch of https://github.com/openfootball/worldcup.json
    $expectedNamesByYear = [
        2002 => 'World Cup 2002',
        2006 => 'World Cup 2006',
        2010 => 'World Cup 2010',
        2014 => 'World Cup 2014',
        2018 => 'World Cup 2018',
        2022 => 'World Cup 2022',
        2026 => 'World Cup 2026',
    ];

    foreach (tournaments() as $tournament) {
        expect($tournament['name'])->toBe($expectedNamesByYear[$tournament['year']]);
    }
});

it('is sorted by year ascending', function (): void {
    $years = array_column(tournaments(), 'year');
    $sorted = $years;
    sort($sorted, SORT_NUMERIC);

    expect($years)->toBe($sorted);
});

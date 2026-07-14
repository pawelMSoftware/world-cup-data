<?php

declare(strict_types=1);

it('is valid JSON', function (): void {
    expect(fn () => loadJson('teams.json'))->not->toThrow(JsonException::class);
});

it('has exactly the required fields, in order, on every record', function (): void {
    foreach (teams() as $team) {
        expect(array_keys($team))->toBe(['id', 'country_id', 'confederation_id', 'fifa_code', 'name']);
    }
});

it('has a unique id for every record', function (): void {
    expect(duplicateValues(array_column(teams(), 'id')))->toBeEmpty();
});

it('has a valid UUID v7 id for every record', function (): void {
    foreach (teams() as $team) {
        expect(isUuidV7($team['id']))->toBeTrue("Invalid UUID v7: {$team['id']}");
    }
});

it('has a unique fifa_code for every record', function (): void {
    expect(duplicateValues(array_column(teams(), 'fifa_code')))->toBeEmpty();
});

it('has a unique name for every record', function (): void {
    expect(duplicateValues(array_column(teams(), 'name')))->toBeEmpty();
});

it('references an existing country for every country_id', function (): void {
    $countryIds = array_column(countries(), 'id');

    foreach (teams() as $team) {
        expect($countryIds)->toContain($team['country_id']);
    }
});

it('references an existing confederation for every confederation_id', function (): void {
    $confederationIds = array_column(confederations(), 'id');

    foreach (teams() as $team) {
        expect($confederationIds)->toContain($team['confederation_id']);
    }
});

it('is sorted by fifa_code ascending', function (): void {
    $fifaCodes = array_column(teams(), 'fifa_code');
    $sorted = $fifaCodes;
    sort($sorted, SORT_STRING);

    expect($fifaCodes)->toBe($sorted);
});

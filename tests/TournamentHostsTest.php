<?php

declare(strict_types=1);

it('is valid JSON', function (): void {
    expect(fn () => loadJson('tournament_hosts.json'))->not->toThrow(JsonException::class);
});

it('decodes to an array at the root', function (): void {
    expect(tournamentHosts())->toBeArray();
});

it('contains exactly 10 records', function (): void {
    expect(tournamentHosts())->toHaveCount(10);
});

it('has exactly the required fields, in order, on every record', function (): void {
    foreach (tournamentHosts() as $host) {
        expect(array_keys($host))->toBe(['id', 'tournament_id', 'country_id']);
    }
});

it('has a valid UUID v7 id for every record', function (): void {
    foreach (tournamentHosts() as $host) {
        expect(isUuidV7($host['id']))->toBeTrue("Invalid UUID v7: {$host['id']}");
    }
});

it('has a unique id for every record', function (): void {
    expect(duplicateValues(array_column(tournamentHosts(), 'id')))->toBeEmpty();
});

it('references an existing tournament for every tournament_id', function (): void {
    $tournamentIds = array_column(tournaments(), 'id');

    foreach (tournamentHosts() as $host) {
        expect($tournamentIds)->toContain($host['tournament_id']);
    }
});

it('references an existing country for every country_id', function (): void {
    $countryIds = array_column(countries(), 'id');

    foreach (tournamentHosts() as $host) {
        expect($countryIds)->toContain($host['country_id']);
    }
});

it('has no duplicate (tournament_id, country_id) pairs', function (): void {
    $pairs = array_map(
        static fn (array $host): string => $host['tournament_id'] . '|' . $host['country_id'],
        tournamentHosts(),
    );

    expect(duplicateValues($pairs))->toBeEmpty();
});

it('gives every tournament at least one host', function (): void {
    $tournamentIds = array_column(tournaments(), 'id');
    $hostedTournamentIds = array_unique(array_column(tournamentHosts(), 'tournament_id'));

    sort($tournamentIds);
    sort($hostedTournamentIds);

    expect(array_values($hostedTournamentIds))->toBe(array_values($tournamentIds));
});

it('resolves every host relationship to both an existing tournament and an existing country', function (): void {
    $tournamentsById = array_column(tournaments(), null, 'id');
    $countriesById = array_column(countries(), null, 'id');

    foreach (tournamentHosts() as $host) {
        expect($tournamentsById)->toHaveKey($host['tournament_id']);
        expect($countriesById)->toHaveKey($host['country_id']);
    }
});

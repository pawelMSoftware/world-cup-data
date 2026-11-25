<?php

declare(strict_types=1);

it('is valid JSON', function (): void {
    expect(fn () => loadJson('stadiums.json'))->not->toThrow(JsonException::class);
});

it('has all required fields on every record', function (): void {
    foreach (stadiums() as $stadium) {
        expect($stadium)->toHaveKeys(['id', 'country_id', 'code', 'name', 'city', 'latitude', 'longitude', 'timezone']);
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

it('has a valid IANA time zone identifier for every record', function (): void {
    $identifiers = timezone_identifiers_list();

    foreach (stadiums() as $stadium) {
        expect(in_array($stadium['timezone'], $identifiers, true))
            ->toBeTrue("Unknown time zone for {$stadium['code']}: {$stadium['timezone']}");
    }
});

it('puts every kickoff at a plausible local hour in its stadium time zone', function (): void {
    // The time zones are derived from each stadium's coordinates; this is the cross-check against
    // real data: a wrong zone shows up as a kickoff at an implausible local hour (night/early morning).
    $timezones = array_column(stadiums(), 'timezone', 'id');

    foreach (matches() as $match) {
        $local = (new DateTimeImmutable($match['kickoff_at']))
            ->setTimezone(new DateTimeZone($timezones[$match['stadium_id']]));
        $hour = (int) $local->format('G');

        expect($hour)->toBeGreaterThanOrEqual(11, "{$match['code']} kicks off at {$local->format('H:i')} local")
            ->toBeLessThanOrEqual(22, "{$match['code']} kicks off at {$local->format('H:i')} local");
    }
});

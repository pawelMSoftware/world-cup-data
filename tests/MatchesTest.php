<?php

declare(strict_types=1);

it('is valid JSON in every data/matches/{year}.json file', function (): void {
    foreach (matchYears() as $year) {
        expect(fn () => loadJson("matches/{$year}.json"))->not->toThrow(JsonException::class);
    }
});

it('decodes to an array at the root in every data/matches/{year}.json file', function (): void {
    foreach (matchYears() as $year) {
        expect(matchesForYear($year))->toBeArray();
    }
});

it('contains only matches belonging to its own tournament in every data/matches/{year}.json file', function (): void {
    $tournamentIdByYear = array_column(tournaments(), 'id', 'year');

    foreach (matchYears() as $year) {
        $expectedTournamentId = $tournamentIdByYear[$year];

        foreach (matchesForYear($year) as $match) {
            expect($match['tournament_id'])->toBe($expectedTournamentId);
        }
    }
});

it('has exactly the required fields, in order, on every record', function (): void {
    foreach (matches() as $match) {
        expect(array_keys($match))->toBe([
            'id', 'code', 'tournament_id', 'stadium_id', 'team_a_id', 'team_b_id', 'referee_id',
            'stage', 'group', 'kickoff_at', 'attendance', 'half_time_team_a', 'half_time_team_b',
            'full_time_team_a', 'full_time_team_b', 'extra_time_team_a', 'extra_time_team_b',
            'penalties_team_a', 'penalties_team_b', 'cards',
        ]);
    }
});

it('has a valid UUID v7 id for every record', function (): void {
    foreach (matches() as $match) {
        expect(isUuidV7($match['id']))->toBeTrue("Invalid UUID v7: {$match['id']}");
    }
});

it('has a unique id for every record', function (): void {
    expect(duplicateValues(array_column(matches(), 'id')))->toBeEmpty();
});

it('has a unique code for every record', function (): void {
    expect(duplicateValues(array_column(matches(), 'code')))->toBeEmpty();
});

it('references an existing tournament for every tournament_id', function (): void {
    $tournamentIds = array_column(tournaments(), 'id');

    foreach (matches() as $match) {
        expect($tournamentIds)->toContain($match['tournament_id']);
    }
});

it('references an existing stadium for every stadium_id', function (): void {
    $stadiumIds = array_column(stadiums(), 'id');

    foreach (matches() as $match) {
        expect($stadiumIds)->toContain($match['stadium_id']);
    }
});

it('references an existing team for every team_a_id', function (): void {
    $teamIds = array_column(teams(), 'id');

    foreach (matches() as $match) {
        expect($teamIds)->toContain($match['team_a_id']);
    }
});

it('references an existing team for every team_b_id', function (): void {
    $teamIds = array_column(teams(), 'id');

    foreach (matches() as $match) {
        expect($teamIds)->toContain($match['team_b_id']);
    }
});

it('never has team_a_id equal to team_b_id', function (): void {
    foreach (matches() as $match) {
        expect($match['team_a_id'])->not->toBe($match['team_b_id']);
    }
});

it('references an existing referee for every referee_id', function (): void {
    $refereeIds = array_column(referees(), 'id');

    foreach (matches() as $match) {
        expect($refereeIds)->toContain($match['referee_id']);
    }
});

it('has a valid ISO 8601 UTC kickoff_at for every record', function (): void {
    foreach (matches() as $match) {
        expect(isIso8601Utc($match['kickoff_at']))->toBeTrue("Invalid ISO 8601 UTC: {$match['kickoff_at']}");
    }
});

it('has a kickoff_at that always ends with Z', function (): void {
    foreach (matches() as $match) {
        expect($match['kickoff_at'])->toEndWith('Z');
    }
});

it('has a kickoff_at that originates from official FIFA competition data for every record', function (): void {
    $fifaKickoffs = fifaKickoffs();

    foreach (matches() as $match) {
        expect($fifaKickoffs)->toHaveKey($match['code']);
        expect($match['kickoff_at'])->toBe($fifaKickoffs[$match['code']]);
    }
});

it('has a positive integer attendance for every record', function (): void {
    foreach (matches() as $match) {
        expect($match['attendance'])->toBeInt();
        expect($match['attendance'])->toBeGreaterThan(0);
    }
});

it('has a cards object with exactly team_a and team_b, in order, for every record', function (): void {
    foreach (matches() as $match) {
        expect($match['cards'])->toBeArray();
        expect(array_keys($match['cards']))->toBe(['team_a', 'team_b']);
    }
});

it('has a cards.team_a/team_b with exactly yellow and red, in order, for every record', function (): void {
    foreach (matches() as $match) {
        foreach (['team_a', 'team_b'] as $team) {
            expect(array_keys($match['cards'][$team]))->toBe(['yellow', 'red']);
        }
    }
});

it('has non-negative integer card counts for every record', function (): void {
    foreach (matches() as $match) {
        foreach (['team_a', 'team_b'] as $team) {
            foreach (['yellow', 'red'] as $kind) {
                $value = $match['cards'][$team][$kind];
                expect($value)->toBeInt();
                expect($value)->toBeGreaterThanOrEqual(0);
            }
        }
    }
});

it('has a stage that is one of the allowed enum values', function (): void {
    $allowed = [
        'group_stage', 'round_of_32', 'round_of_16',
        'quarter_final', 'semi_final', 'third_place', 'final',
    ];

    foreach (matches() as $match) {
        expect($allowed)->toContain($match['stage']);
    }
});

it('has a group that is a single letter or null', function (): void {
    // The source data spans both the 32-team/8-group format (2002-2022, groups
    // A-H) and the 2026 48-team/12-group format (groups A-L), so the allowed
    // range is A-L rather than a fixed A-H.
    foreach (matches() as $match) {
        $group = $match['group'];
        $isValid = $group === null || (is_string($group) && preg_match('/^[A-L]$/', $group) === 1);
        expect($isValid)->toBeTrue('Unexpected group value: ' . var_export($group, true));
    }
});

it('has score values that are all integers or null', function (): void {
    $scoreFields = [
        'half_time_team_a', 'half_time_team_b', 'full_time_team_a', 'full_time_team_b',
        'extra_time_team_a', 'extra_time_team_b', 'penalties_team_a', 'penalties_team_b',
    ];

    foreach (matches() as $match) {
        foreach ($scoreFields as $field) {
            $value = $match[$field];
            expect($value === null || is_int($value))->toBeTrue("{$field} must be int or null");
        }
    }
});

it('never has penalties without extra_time', function (): void {
    foreach (matches() as $match) {
        if ($match['penalties_team_a'] !== null || $match['penalties_team_b'] !== null) {
            expect($match['extra_time_team_a'])->not->toBeNull();
            expect($match['extra_time_team_b'])->not->toBeNull();
        }
    }
});

it('never has extra_time without full_time', function (): void {
    foreach (matches() as $match) {
        if ($match['extra_time_team_a'] !== null || $match['extra_time_team_b'] !== null) {
            expect($match['full_time_team_a'])->not->toBeNull();
            expect($match['full_time_team_b'])->not->toBeNull();
        }
    }
});

it('is sorted by tournament year then kickoff_at', function (): void {
    $yearByTournamentId = array_column(tournaments(), 'year', 'id');

    $keys = array_map(
        static fn (array $match): string => sprintf('%d-%s', $yearByTournamentId[$match['tournament_id']], $match['kickoff_at']),
        matches(),
    );

    $sorted = $keys;
    sort($sorted, SORT_STRING);

    expect($keys)->toBe($sorted);
});

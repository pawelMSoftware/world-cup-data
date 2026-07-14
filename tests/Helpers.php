<?php

declare(strict_types=1);

/**
 * Absolute path to a file inside the repository's data directory.
 */
function dataPath(string $filename): string
{
    return dirname(__DIR__) . '/data/' . $filename;
}

/**
 * Decode a JSON data file into an associative array.
 */
function loadJson(string $filename): array
{
    $contents = file_get_contents(dataPath($filename));

    return json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
}

/**
 * The decoded, memoized contents of data/countries.json.
 */
function countries(): array
{
    static $countries = null;

    return $countries ??= loadJson('countries.json');
}

/**
 * The decoded, memoized contents of data/teams.json.
 */
function teams(): array
{
    static $teams = null;

    return $teams ??= loadJson('teams.json');
}

/**
 * The decoded, memoized contents of data/confederations.json.
 */
function confederations(): array
{
    static $confederations = null;

    return $confederations ??= loadJson('confederations.json');
}

/**
 * The decoded, memoized contents of data/stadiums.json.
 */
function stadiums(): array
{
    static $stadiums = null;

    return $stadiums ??= loadJson('stadiums.json');
}

/**
 * The decoded, memoized contents of data/tournaments.json.
 */
function tournaments(): array
{
    static $tournaments = null;

    return $tournaments ??= loadJson('tournaments.json');
}

/**
 * The decoded, memoized contents of data/tournament_hosts.json.
 */
function tournamentHosts(): array
{
    static $tournamentHosts = null;

    return $tournamentHosts ??= loadJson('tournament_hosts.json');
}

/**
 * The tournament years with a matches file under data/matches/.
 */
function matchYears(): array
{
    return [2002, 2006, 2010, 2014, 2018, 2022, 2026];
}

/**
 * The decoded, memoized contents of data/matches/{year}.json.
 */
function matchesForYear(int $year): array
{
    static $cache = [];

    return $cache[$year] ??= loadJson("matches/{$year}.json");
}

/**
 * The decoded contents of every data/matches/{year}.json file, combined into
 * a single flat list, in file order (2002 first, ..., 2026 last).
 */
function matches(): array
{
    static $all = null;

    if ($all === null) {
        $all = array_merge(...array_map('matchesForYear', matchYears()));
    }

    return $all;
}

/**
 * Whether the given string is a valid ISO 8601 UTC timestamp in "Z" form
 * (YYYY-MM-DDTHH:MM:SSZ), and actually represents a real calendar date/time.
 */
function isIso8601Utc(string $value): bool
{
    if (preg_match('/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}:\d{2}Z$/', $value) !== 1) {
        return false;
    }

    $date = DateTimeImmutable::createFromFormat(DateTimeInterface::ATOM, substr($value, 0, -1) . '+00:00');

    return $date !== false;
}

/**
 * The decoded, memoized contents of tests/fixtures/fifa_kickoffs.json - a snapshot
 * of official FIFA competition data (api.fifa.com), keyed by match `code`, recording
 * the authoritative kickoff timestamp used to populate matches.json's kickoff_at.
 */
function fifaKickoffs(): array
{
    static $fifaKickoffs = null;

    if ($fifaKickoffs === null) {
        $contents = file_get_contents(dirname(__DIR__) . '/tests/fixtures/fifa_kickoffs.json');
        $fifaKickoffs = array_column(json_decode($contents, true, 512, JSON_THROW_ON_ERROR), 'kickoff_at', 'code');
    }

    return $fifaKickoffs;
}

/**
 * The raw, unparsed contents of a JSON data file.
 *
 * JSON decoding loses trailing zeros on floats (25.329640 becomes 25.32964),
 * so decimal-place precision must be checked against the source text instead.
 */
function rawJson(string $filename): string
{
    return file_get_contents(dataPath($filename));
}

/**
 * The raw numeric literals assigned to a given field, in document order, as they
 * appear in the source JSON text (before float decoding drops trailing zeros).
 */
function rawFieldValues(string $filename, string $field): array
{
    preg_match_all(
        '/"' . preg_quote($field, '/') . '":\s*(-?\d+\.\d+)/',
        rawJson($filename),
        $matches,
    );

    return $matches[1];
}

/**
 * The number of digits after the decimal point in a numeric literal string.
 */
function decimalPlaces(string $number): int
{
    if (! str_contains($number, '.')) {
        return 0;
    }

    return strlen(explode('.', $number, 2)[1]);
}

/**
 * Whether the given string is a valid UUID version 7.
 */
function isUuidV7(string $uuid): bool
{
    return preg_match(
        '/^[0-9a-f]{8}-[0-9a-f]{4}-7[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/i',
        $uuid,
    ) === 1;
}

/**
 * The values that appear more than once in the given list.
 */
function duplicateValues(array $values): array
{
    $counts = array_count_values($values);

    return array_keys(array_filter($counts, static fn (int $count): bool => $count > 1));
}

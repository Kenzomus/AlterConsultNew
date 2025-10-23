<?php declare(strict_types=1);
/*
 * This file is part of sebastian/diff.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\Diff;

use function array_pop;
<<<<<<< HEAD
use function assert;
=======
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
use function count;
use function max;
use function preg_match;
use function preg_split;

/**
 * Unified diff parser.
 */
final class Parser
{
    /**
     * @return Diff[]
     */
    public function parse(string $string): array
    {
        $lines = preg_split('(\r\n|\r|\n)', $string);

        if (!empty($lines) && $lines[count($lines) - 1] === '') {
            array_pop($lines);
        }

        $lineCount = count($lines);
        $diffs     = [];
        $diff      = null;
        $collected = [];

<<<<<<< HEAD
        for ($i = 0; $i < $lineCount; $i++) {
=======
        for ($i = 0; $i < $lineCount; ++$i) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            if (preg_match('#^---\h+"?(?P<file>[^\\v\\t"]+)#', $lines[$i], $fromMatch) &&
                preg_match('#^\\+\\+\\+\\h+"?(?P<file>[^\\v\\t"]+)#', $lines[$i + 1], $toMatch)) {
                if ($diff !== null) {
                    $this->parseFileDiff($diff, $collected);

                    $diffs[]   = $diff;
                    $collected = [];
                }

<<<<<<< HEAD
                assert(!empty($fromMatch['file']));
                assert(!empty($toMatch['file']));

                $diff = new Diff($fromMatch['file'], $toMatch['file']);

                $i++;
            } else {
                if (preg_match('/^(?:diff --git |index [\da-f.]+|[+-]{3} [ab])/', $lines[$i])) {
=======
                $diff = new Diff($fromMatch['file'], $toMatch['file']);

                ++$i;
            } else {
                if (preg_match('/^(?:diff --git |index [\da-f\.]+|[+-]{3} [ab])/', $lines[$i])) {
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                    continue;
                }

                $collected[] = $lines[$i];
            }
        }

        if ($diff !== null && count($collected)) {
            $this->parseFileDiff($diff, $collected);

            $diffs[] = $diff;
        }

        return $diffs;
    }

    private function parseFileDiff(Diff $diff, array $lines): void
    {
        $chunks    = [];
        $chunk     = null;
        $diffLines = [];

        foreach ($lines as $line) {
<<<<<<< HEAD
            if (preg_match('/^@@\s+-(?P<start>\d+)(?:,\s*(?P<startrange>\d+))?\s+\+(?P<end>\d+)(?:,\s*(?P<endrange>\d+))?\s+@@/', $line, $match, PREG_UNMATCHED_AS_NULL)) {
                $chunk = new Chunk(
                    (int) $match['start'],
                    isset($match['startrange']) ? max(0, (int) $match['startrange']) : 1,
                    (int) $match['end'],
                    isset($match['endrange']) ? max(0, (int) $match['endrange']) : 1,
=======
            if (preg_match('/^@@\s+-(?P<start>\d+)(?:,\s*(?P<startrange>\d+))?\s+\+(?P<end>\d+)(?:,\s*(?P<endrange>\d+))?\s+@@/', $line, $match)) {
                $chunk = new Chunk(
                    (int) $match['start'],
                    isset($match['startrange']) ? max(1, (int) $match['startrange']) : 1,
                    (int) $match['end'],
                    isset($match['endrange']) ? max(1, (int) $match['endrange']) : 1
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
                );

                $chunks[]  = $chunk;
                $diffLines = [];

                continue;
            }

            if (preg_match('/^(?P<type>[+ -])?(?P<line>.*)/', $line, $match)) {
                $type = Line::UNCHANGED;

                if ($match['type'] === '+') {
                    $type = Line::ADDED;
                } elseif ($match['type'] === '-') {
                    $type = Line::REMOVED;
                }

                $diffLines[] = new Line($type, $match['line']);

<<<<<<< HEAD
                $chunk?->setLines($diffLines);
=======
                if (null !== $chunk) {
                    $chunk->setLines($diffLines);
                }
>>>>>>> 9e87ebca8a4627a33d99f8115e8e3880fa01d70c
            }
        }

        $diff->setChunks($chunks);
    }
}

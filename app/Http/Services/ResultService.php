<?php

namespace App\Http\Services;

use App\Models\StudentResult;

class ResultService
{
    /*
    |--------------------------------------------------------------------------
    | Grade
    |--------------------------------------------------------------------------
    */
    public static function calculateGrade($score)
    {
        return match(true) {
            $score >= 70 => 'A',
            $score >= 60 => 'B',
            $score >= 50 => 'C',
            $score >= 45 => 'D',
            $score >= 40 => 'E',
            default => 'F',
        };
    }

    /*
    |--------------------------------------------------------------------------
    | Convert integer to ordinal string (1 => 1st, 2 => 2nd, etc.)
    |--------------------------------------------------------------------------
    */
    public static function ordinal($number)
    {
        if (!in_array(($number % 100), [11, 12, 13])) {
            switch ($number % 10) {
                case 1: return $number.'st';
                case 2: return $number.'nd';
                case 3: return $number.'rd';
            }
        }
        return $number.'th';
    }

    /*
    |--------------------------------------------------------------------------
    | Calculate subject stats (highest, lowest, average)
    |--------------------------------------------------------------------------
    */
    public static function calculateSubjectStats($results)
    {
        return $results->groupBy('subject_id')->map(function ($rows) {
            return [
                'highest' => $rows->max('total'),
                'lowest'  => $rows->min('total'),
                'average' => round($rows->avg('total'), 2),
            ];
        });
    }

    /*
    |--------------------------------------------------------------------------
    | Get Class Arm Results
    |--------------------------------------------------------------------------
    */
    public static function getClassArmResults($class_id, $class_arm_id, $session_id, $term_id)
    {
        return StudentResult::with(['student','subject'])
            ->where('class_id', $class_id)
            ->where('class_arm_id', $class_arm_id)
            ->where('session_id', $session_id)
            ->where('term_id', $term_id)
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Get Overall Class Results (all arms)
    |--------------------------------------------------------------------------
    */
    public static function getClassResults($class_id, $session_id, $term_id)
    {
        return StudentResult::with(['student','subject'])
            ->where('class_id', $class_id)
            ->where('session_id', $session_id)
            ->where('term_id', $term_id)
            ->get();
    }

    /*
    |--------------------------------------------------------------------------
    | Subject Averages
    |--------------------------------------------------------------------------
    */
    public static function calculateSubjectAverages($results)
    {
        return $results
            ->groupBy('subject_id')
            ->map(fn($rows) => round($rows->avg('total'), 2));
    }

    /*
    |--------------------------------------------------------------------------
    | Subject Positions (with ordinal)
    |--------------------------------------------------------------------------
    */
    public static function calculateSubjectPositions($results)
    {
        $positions = [];

        foreach ($results->groupBy('subject_id') as $subject_id => $rows) {
            $sorted = $rows->sortByDesc('total')->values();

            foreach ($sorted as $index => $row) {
                $positions[$row->student_id][$subject_id] = self::ordinal($index + 1);
            }
        }

        return $positions;
    }

    /*
    |--------------------------------------------------------------------------
    | Calculate student totals
    |--------------------------------------------------------------------------
    */
    public static function calculateStudentTotals($results)
    {
        return $results
            ->groupBy('student_id')
            ->map(fn($rows) => $rows->sum('total'));
    }

    /*
    |--------------------------------------------------------------------------
    | Class Arm Positions (with ordinal)
    |--------------------------------------------------------------------------
    */
    public static function calculateClassArmPositions($classArmResults)
    {
        $totals = self::calculateStudentTotals($classArmResults)
            ->sortDesc()
            ->values();

        $positions = [];

        foreach ($totals as $index => $total) {
            $positions[$total] = self::ordinal($index + 1);
        }

        return $positions;
    }

    /*
    |--------------------------------------------------------------------------
    | Overall Class Positions (with ordinal)
    |--------------------------------------------------------------------------
    */
    public static function calculateClassPositions($classResults)
    {
        $totals = self::calculateStudentTotals($classResults)
            ->sortDesc()
            ->values();

        $positions = [];

        foreach ($totals as $index => $total) {
            $positions[$total] = self::ordinal($index + 1);
        }

        return $positions;
    }

    /*
    |--------------------------------------------------------------------------
    | Calculate Student Average
    |--------------------------------------------------------------------------
    */
    public static function calculateStudentAverage($studentResults)
    {
        return $studentResults->count()
            ? round($studentResults->avg('total'), 2)
            : 0;
    }


    
}

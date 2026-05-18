<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Course;

class RecalculateCourseTotals extends Command
{
    protected $signature   = 'courses:recalculate';
    protected $description = 'Recalculate total_classes and course_hours for all courses from curriculum weeks';

    public function handle()
    {
        $courses = Course::with('curriculums')->get();

        if ($courses->isEmpty()) {
            $this->info('No courses found.');
            return;
        }

        $this->info('Recalculating ' . $courses->count() . ' courses...');

        foreach ($courses as $course) {
            $classesPerWeek = (int) ($course->classes_per_week ?? 0);
            $courseDuration = (int) ($course->course_duration  ?? 0);

            $totalWeeks = 0;
            foreach ($course->curriculums as $curriculum) {
                $totalWeeks += $this->parseWeeks($curriculum->duration);
            }

            $totalClasses = ($classesPerWeek > 0) ? $totalWeeks * $classesPerWeek : 0;
            $totalHours   = ($courseDuration  > 0) ? $totalClasses * $courseDuration : 0;

            $course->update([
                'total_classes' => $totalClasses,
                'course_hours'  => (string) $totalHours,
            ]);

            $this->info(
                "Course [{$course->id}] {$course->course_name} → " .
                "Weeks: {$totalWeeks} | " .
                "Classes: {$totalClasses} | " .
                "Hours: {$totalHours}"
            );
        }

        $this->info('Done! All courses recalculated.');
    }

    private function parseWeeks(?string $duration): int
    {
        if (!$duration || trim($duration) === '') return 0;

        $d = trim($duration);

        // Range: "2-3", "1-4", "3-4"
        if (preg_match('/^(\d+)\s*-\s*(\d+)$/', $d, $m)) {
            $start = (int) $m[1];
            $end   = (int) $m[2];
            return max(0, $end - $start + 1);
        }

        // Single: "1", "2"
        if (preg_match('/^\d+$/', $d)) {
            return 1;
        }

        return 0;
    }
}
<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CourseCoordinator extends Model
{
    protected $table = 'sch_course_coord';

    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function isDuplicate()
    {
        $duplicates = $this
          ->where('institution_id', $this->institution_id)
          ->where('course_id', $this->course_id)
          ->where('staff_id', $this->staff_id)
          ->get();

        $num = count($duplicates);
        if (! $num) return false;
        if ($num > 1) return true;
        return $this->id && $duplicates[0]->id != $this->id;
    }
}

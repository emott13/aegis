<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Employee;

class ValidateScheduleAssignments implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
        $data = $value;                                                 // expecting $value to be request()->all()

        $doctor = $data['doctor_id'] ?? null;                           // extract emp_ids
        $supervisor = $data['supervisor_id'] ?? null;
        $careRed = $data['care_red'] ?? null;
        $careBlue = $data['care_blue'] ?? null;
        $careGreen = $data['care_green'] ?? null;
        $careYellow = $data['care_yellow'] ?? null;

        $assigned = array_filter([                                      // assigned emp_ids
            $doctor,
            $supervisor,
            $careRed,
            $careBlue,
            $careGreen,
            $careYellow,
        ]);

        if (count($assigned) !== count(array_unique($assigned))) {      // check for duplicates
            $fail("Each employee may only be assigned once in a schedule.");
            return;
        }

        if ($doctor && !$this->employeeHasRole($doctor, 'doctor')) {    // validate doctor role
            $fail("doctor_id must belong to an employee with the Doctor role.");
        }

        if ($supervisor && !$this->employeeHasRole($supervisor, 'supervisor')) {        // validate supervisor role
            $fail("supervisor_id must belong to an employee with the Supervisor role.");
        }

        $careRoles = [
            'care_red'    => $careRed,
            'care_blue'   => $careBlue,
            'care_green'  => $careGreen,
            'care_yellow' => $careYellow,
        ];

        foreach ($careRoles as $field => $empId) {                                  // validate caregiver role
            if ($empId && !$this->employeeHasRole($empId, 'caregiver')) {
                $fail("$field must belong to a Caregiver employee.");
            }
        }
    }

    private function employeeHasRole(int $empId, string $roleName): bool
    {
        return Employee::where('emp_id', $empId)
            ->whereHas('user.role', fn($q) => $q->where('role_name', $roleName))
            ->exists();
    }
}

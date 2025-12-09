<?

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'hire_date' => $this->faker->date(),
            'salary' => $this->faker->numberBetween(30000, 90000),
            'user_id' => null, // filled in by UserFactory
        ];
    }

    // relationships
}

?>
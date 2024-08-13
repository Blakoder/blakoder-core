<?php

namespace Blakoder\Core\Database\Factories;

use Blakoder\Core\Models\Log;
use Blakoder\Core\Models\LogType;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogFactory extends Factory
{
    protected $model = Log::class;

    public function definition()
    {
        return [
            'sequence' => random_int(1, 10000),
            'uuid' => $this->faker->uuid(),
            'type' => $this->faker->randomElement([
                LogType::COMMAND, LogType::EVENT,
                LogType::JOB, LogType::MAIL,
                LogType::REQUEST,
                LogType::SCHEDULED_TASK,
            ]),
            'content' => [$this->faker->word() => $this->faker->word()],
        ];
    }
}

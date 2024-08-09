<?php

namespace Controlla\Core\Models;

enum LogType: string
{
    case EVENT = 'event';
    case REQUEST = 'request';
    case COMMAND = 'command';
    case JOB = 'job';
    case MAIL = 'mail';
    case SCHEDULED_TASK = 'schedule';

    /**
     * Determine if the log is a event.
     */
    public function isEvent(): bool
    {
        return $this->value === self::EVENT->value;
    }

    /**
     * Determine if the log is a request.
     */
    public function isRequest(): bool
    {
        return $this->value === self::REQUEST->value;
    }

    /**
     * Determine if the log is a command.
     */
    public function isCommand(): bool
    {
        return $this->value === self::COMMAND->value;
    }

    /**
     * Determine if the log is a job.
     */
    public function isJob(): bool
    {
        return $this->value === self::JOB->value;
    }

    /**
     * Determine if the log is a mail.
     */
    public function isMail(): bool
    {
        return $this->value === self::MAIL->value;
    }

    /**
     * Determine if the log is a scheduled task.
     */
    public function isScheduledTask(): bool
    {
        return $this->value === self::SCHEDULED_TASK->value;
    }
}

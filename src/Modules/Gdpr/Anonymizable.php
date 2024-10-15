<?php

namespace Blakoder\Core\Modules\Gdpr;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

trait Anonymizable
{
    /**
     * Anonymize the model and its relations.
     */
    public function anonymize(): void
    {
        $attributes = $this->gdprAnonymizableFields();

        foreach ($attributes as $key => $type) {
            if (!isset($this->$key)) {
                continue;
            }

            $value = $this->$key;

            if ($type === 'date' && $value instanceof \DateTime) {
                $this->$key = $this->anonymizeDate($value->format('Y-m-d H:i:s'));
            } elseif ($type === 'string' && is_string($value)) {
                $this->$key = $this->anonymizeString($value);
            } elseif ($type === 'number' && is_numeric($value)) {
                $this->$key = 0;
            } elseif ($type === 'boolean' && is_bool($value)) {
                $this->$key = false;
            } else {
                $this->$key = null;
            }
        }

        // Anonimizar relaciones
        foreach ($this->gdprWith() as $relation) {
            if ($this->$relation instanceof Model) {
                $this->$relation->anonymize();
            } elseif ($this->$relation instanceof Collection) {
                $this->$relation->each->anonymize();
            }
        }

        // Marcar el modelo como anonimizado
        $this->isAnonymized = true;

        $this->save();
    }

    /**
     * Anonymize a string value.
     */
    protected function anonymizeString(string $value): string
    {
        return str_repeat('*', strlen($value));
    }

    /**
     * Anonymize a date value.
     */
    protected function anonymizeDate(string $value): string
    {
        return '0000-00-00 00:00:00';  // O cualquier otro formato de fecha válido
    }

    /**
     * Get the relations that should be anonymized.
     *
     * @return array<int, string>
     */
    public function gdprWith(): array
    {
        return [];
    }

    /**
     * Get the attributes that should be anonymized.
     *
     * @return array<string, string>
     */
    abstract public function gdprAnonymizableFields(): array;

    /**
     * Determine if the model has been anonymized.
     */
    public function isAnonymized(): bool
    {
        return $this->isAnonymized;
    }
}

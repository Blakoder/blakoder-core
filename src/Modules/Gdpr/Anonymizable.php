<?php

namespace Blakoder\Core\Modules\Gdpr;

trait Anonymizable
{
    /**
     * Anonymize the model.
     */
    public function anonymize(): void
    {
        $attributes = $this->toAnonymizableArray();

        foreach ($attributes as $key => $value) {
            if ($value instanceof \DateTime) {
                $this->$key = $this->anonymizeDate($value->format('Y-m-d H:i:s'));
            } elseif (is_string($value)) {
                $this->$key = $this->anonymizeString($value);
            } elseif (is_numeric($value)) {
                $this->$key = 0;
            } elseif (is_bool($value)) {
                $this->$key = false;
            } else {
                $this->$key = null;
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
     * Get the attributes that should be anonymized.
     *
     * @return array<string, mixed>
     */
    public function toAnonymizableArray()
    {
        return $this->toArray();
    }

    /**
     * Determine if the model has been anonymized.
     */
    public function isAnonymized(): bool
    {
        return $this->isAnonymized;
    }
}

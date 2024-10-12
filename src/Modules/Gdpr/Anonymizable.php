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
            if (is_string($value)) {
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
     *
     * @param string $value
     * @return string
     */
    protected function anonymizeString(string $value): string
    {
        return str_repeat('*', strlen($value));
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
     *
     * @return bool
     */
    public function isAnonymized(): bool
    {
        return $this->isAnonymized;
    }
}
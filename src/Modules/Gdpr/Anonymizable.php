<?php

namespace Blakoder\Core\Modules\Gdpr;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

trait Anonymizable
{
    /**
     * Fields to be anonymized. Can be a simple array of field names or an associative array with specific replacement values.
     */
    protected static $defaultGdprAnonymizableFields = [];

    /**
     * Relations that should be anonymized.
     */
    protected static $defaultGdprWith = [];

    /**
     * Anonymize the model and its relations.
     */
    public function anonymize(): void
    {
        $fields = $this->getGdprAnonymizableFields();

        foreach ($fields as $key => $value) {
            if (is_numeric($key)) {
                // Si es un índice numérico, usamos el valor por defecto
                $field = $value;
                $replacement = $this->anonymizeValue($this->$field);
            } else {
                // Si es un par clave-valor, usamos el valor específico
                $field = $key;
                $replacement = $value;
            }

            if (isset($this->$field)) {
                $this->$field = $replacement;
            }
        }

        // Anonimizar relaciones
        foreach ($this->getGdprWith() as $relation) {
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
     * Get the fields to be anonymized.
     *
     * @return array
     */
    protected function getGdprAnonymizableFields(): array
    {
        return property_exists($this, 'gdprAnonymizableFields')
            ? $this->gdprAnonymizableFields
            : static::$defaultGdprAnonymizableFields;
    }

    /**
     * Get the relations to be anonymized.
     *
     * @return array
     */
    protected function getGdprWith(): array
    {
        return property_exists($this, 'gdprWith')
            ? $this->gdprWith
            : static::$defaultGdprWith;
    }

    /**
     * Anonymize a value based on its type.
     *
     * @param  mixed  $value
     * @return mixed
     */
    protected function anonymizeValue($value)
    {
        if (is_string($value)) {
            return str_repeat('*', strlen($value));
        } elseif (is_numeric($value)) {
            return 0;
        } elseif (is_bool($value)) {
            return false;
        } elseif ($value instanceof Carbon) {
            return Carbon::create(2000, 1, 1, 0, 0, 0);
        }

        return null;
    }

    /**
     * Determine if the model has been anonymized.
     */
    public function isAnonymized(): bool
    {
        return $this->isAnonymized;
    }
}

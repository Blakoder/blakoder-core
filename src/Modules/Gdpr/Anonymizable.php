<?php

namespace Blakoder\Core\Modules\Gdpr;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Carbon;

trait Anonymizable
{
    /**
     * Fields to be anonymized. Can be a simple array of field names or an associative array with specific replacement values.
     */
    protected $gdprAnonymizableFields = [];

    /**
     * Relations that should be anonymized.
     */
    protected $gdprWith = [];

    /**
     * Anonymize the model and its relations.
     */
    public function anonymize(): void
    {
        foreach ($this->gdprAnonymizableFields as $key => $value) {
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
        foreach ($this->gdprWith as $relation) {
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
     * Anonymize a value based on its type.
     *
     * @param mixed $value
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

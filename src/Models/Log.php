<?php

namespace Controlla\Core\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\MassPrunable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Log extends Model
{
    use HasFactory;
    use MassPrunable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'controlla_logs';

    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = ['content' => 'json', 'created_at', 'datetime', 'type' => LogType::class];

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Prevent Eloquent from overriding uuid with `lastInsertId`.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Scope the query for the given type.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $type
     * @return $this
     */
    protected function whereType($query, $type)
    {
        $query->when($type, function ($query, $type) {
            return $query->where('type', $type);
        });

        return $this;
    }

    public function prunable(): Builder
    {
        return static::query()->where('created_at', '<=', config('core.prune_logs_duration'));
    }

    public function getCreatedAtAttribute(?string $date): ?string
    {
        return Carbon::parse($date)->diffForHumans();
    }
}

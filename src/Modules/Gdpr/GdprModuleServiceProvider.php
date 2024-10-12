<?php

namespace Blakoder\Core\Modules\Gdpr;

use Blakoder\Core\Modules\BaseModuleServiceProvider;

class GdprModuleServiceProvider extends BaseModuleServiceProvider
{
    /** @var string */
    protected $id = 'gdpr';

    /** @var string */
    protected $version = '1.0.0';

    /** @var array */
    protected $migrations = [
        'add_is_anonymized_to_users_table',
    ];
}

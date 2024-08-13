<?php

namespace Blakoder\Core;

use Blakoder\Core\Contracts\Blakoder as BlakoderContract;
use Blakoder\Core\Modules\BaseModuleServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Collection;
use ReflectionClass;

class Blakoder implements BlakoderContract
{
    /** @var Collection */
    protected $modules;

    /** @var array */
    protected $implicitModules = [];

    /** @var Application */
    protected $app;

    /** @var string */
    protected $basePath;

    /**
     * Blakoder class constructor
     */
    public function __construct(Application $app)
    {
        $this->basePath = dirname(dirname(dirname((new ReflectionClass(static::class))->getFileName())));
        $this->modules = Collection::make();
        $this->app = $app;
    }

    /**
     * {@inheritdoc}
     */
    public function registerModule($moduleClass, $config = [])
    {
        /** @var BaseModuleServiceProvider */
        $module = $this->app->register($moduleClass);

        $this->modules->put($module->getId(), $module);
        $implicit = $config['implicit'] ?? false;

        if ($implicit) {
            $this->implicitModules[get_class($module)] = true;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getModules($includeImplicits = false): Collection
    {
        if ($includeImplicits) {
            return $this->modules;
        }

        $implicitModules = $this->implicitModules;

        return $this->modules->reject(function ($module) use ($implicitModules) {
            return array_key_exists(get_class($module), $implicitModules);
        });
    }

    /**
     * Returns the root folder on the filesystem containing the module
     */
    public function getBasePath(): string
    {
        return $this->basePath;
    }
}

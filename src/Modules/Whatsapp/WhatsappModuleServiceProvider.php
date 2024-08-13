<?php

namespace Blakoder\Core\Modules\Whatsapp;

use Blakoder\Core\Modules\BaseModuleServiceProvider;
use Blakoder\Core\Modules\Whatsapp\Services\WhatsAppService;

class WhatsappModuleServiceProvider extends BaseModuleServiceProvider
{
    /** @var string */
    protected $id = 'whatsapp';

    /** @var string */
    protected $version = '1.0.0';

    /** @var array */
    protected $migrations = [
        'create_conversations_table',
    ];

    /** @var array */
    protected $models = [
        'Conversation',
        'Message',
    ];

    /** @var array */
    protected $policies = [
        'ConversationPolicy',
    ];

    /** @var array */
    protected $controllers = [
        'ConversationController',
    ];

    /** @var array */
    protected $requests = [
        'Conversation/ConversationStoreRequest',
        'Conversation/ConversationUpdateRequest',
    ];

    /** @var array */
    protected $resources = [
        'Conversation/ConversationResource',
    ];

    /** @var array */
    protected $repositories = [
        'Conversation/ConversationRepository',
        'Conversation/ConversationRepositoryInterface',
    ];

    /** @var array */
    protected $services = [
        'Conversation/ConversationService',
        'Conversation/ConversationServiceInterface',
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(WhatsAppService::class, function () {
            return new WhatsAppService();
        });
    }
}

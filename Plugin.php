<?php namespace Poper\Poper;

use Backend;
use Event;
use System\Classes\PluginBase;
use System\Classes\SettingsManager;


class Plugin extends PluginBase
{
    public function pluginDetails()
    {
        return [
            'name'        => 'Poper',
            'description' => 'A plugin to inject scripts into head',
            'author'      => 'Poper',
            'icon'        => 'plugins/poper/poper/assets/images/poper.svg',
            'autoload' => [
                'psr-4' => [
                    'Poper\\Poper\\Controllers\\' => 'controllers/',
                    'Poper\\Poper\\Components\\' => 'components/',
                ],
            ],
        ];
    }

    public function boot()
    {
        \Event::listen('cms.page.end', function(\Cms\Classes\Controller $controller) {
            // Fetch the account_id from the database
            $account = \Poper\Poper\Models\Settings::first();

            // Check if account ID exists
            $accountId = $account ? $account->account_id : null;

            if ($accountId) {
                // Add the script dynamically to the page
                $controller->addJs('https://app.poper.ai/share/poper.js?accountID=' . $accountId, ['async' => true]);
            }
        });
    }


    public function registerComponents()
    {
        return [
            'Poper\Poper\Components\ScriptForm' => 'scriptform'
        ];
    }

    public function registerPermissions()
    {
        return [
            'poper.manage_settings' => [
                'label' => 'Manage Poper Settings',
                'tab'   => 'Poper',
            ],
        ];
    }

    public function registerNavigation()
    {
        return [
            'poper' => [
                'label'       => 'Poper',
                'url'         => \Backend::url('poper/poper/settings'), // Must match the controller path
                'iconSvg'     => 'plugins/poper/poper/assets/images/poper.svg', // Optional
                'permissions' => [], // Remove if you are not using permissions
                'order'       => 500,
            ],
        ];
    }



    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'Poper Settings',
                'description' => 'Manage Poper settings.',
                'category'    => SettingsManager::CATEGORY_CMS,
                'icon'     => 'icon-gear',
                // 'class'       => 'Poper\Poper\Models\Settings',
                'url'         => \Backend::url('poper/poper/settings'),
                'order'       => 500,
                'keywords'    => 'poper script settings'
            ]
        ];
    }
}
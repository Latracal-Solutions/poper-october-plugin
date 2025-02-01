<?php namespace Poper\Poper\Components;

use Poper\Poper\Models\Setting;
use Cms\Classes\ComponentBase;
use Db;
use Event;

class ScriptForm extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Script Form',
            'description' => 'Adds Poper script with account ID to head'
        ];
    }



    public function onRun()
    {
        $accountId = $this->getAccountId();
        \Log::info('Account ID being set:', ['account_id' => $accountId]);
        
        $this->page['account_id'] = $accountId;
    }


    public function onSubmit()
    {
        $accountId = post('accountId');
        
        Db::table('poper_settings')->updateOrInsert(
            ['id' => 1],
            [
                'account_id' => $accountId,
                'updated_at' => now()
            ]
        );

        return [
            'status' => 'success',
            'message' => 'Account ID saved successfully!'
        ];
    }
}

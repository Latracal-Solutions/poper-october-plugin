<?php namespace Poper\Poper\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Db;
use Poper\Poper\Components\ScriptForm;

class Settings extends Controller
{
    
    public $requiredPermissions = []; // Remove or comment out if permissions aren't needed

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Poper.Poper', 'poper');
    }

    public function index()
    {
        
        $this->pageTitle = 'Poper Settings';
    }

    public function onSubmit()
    {
        $component = new ScriptForm();
        return $component->onSubmit();
    }
    
    public function onGetAccountId()
    {
        try {
            $accountId = Db::table('poper_settings')->select('account_id')->first();
            return response()->json([
                'status' => 'success',
                'accountId' => $accountId ? $accountId->account_id : null
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

}

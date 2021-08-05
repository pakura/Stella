<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class PageType extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:PageType {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Page types';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    protected $name;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->name = ucfirst($this->argument('name'));
        $this->createController();
        $this->createViews();
        $this->setConfig();
        $this->info('Created: '.$this->name.' page type');

        return 0;
    }


    protected function createController(){
        $controller = Storage::disk('public')->get('commands/pageTypeController');
        $controller = str_replace('{Uname}', $this->name, $controller);
        $controller = str_replace('{name}', strtolower($this->name), $controller);
        @file_put_contents('app/Http/Controllers/Web/Web'.$this->name.'Controller.php', $controller);
    }

    protected function createViews(){
        $view = Storage::disk('public')->get('commands/pageTypeView');
        $view = str_replace('{Uname}', $this->name, $view);
        $view = str_replace('{name}', strtolower($this->name), $view);
        @file_put_contents('resources/views/web/'.strtolower($this->name).'.blade.php', $view);
    }

    protected function setConfig(){
        if(\Models\PageType::where('name', strtolower($this->name))->count()>0) return 0;
        \Models\PageType::insert(['name' => strtolower($this->name)]);
    }
}

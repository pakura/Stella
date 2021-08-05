<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CollectionType extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:CollectionType {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create type of collection';

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
        $this->Uname = ucfirst(Str::singular($this->argument('name')));
        $this->Unames = ucfirst(Str::plural($this->argument('name')));
        $this->name = (Str::singular($this->argument('name')));
        $this->names = (Str::plural($this->argument('name')));

        $this->createRequest();
        $this->createModel();
        $this->createMigration();
        $this->createControllers();
        $this->createViews();
        $this->setConfigs();

        $this->info('Created: '.$this->Uname. ' type of collection');
        return 0;
    }


    protected function createRequest(){
        $this->makeFiles('commands/collectionTypeRequest', 'app/Http/Requests/Admin/'.$this->Uname.'Request.php');
    }

    protected function createModel(){
        $this->makeFiles('commands/collectionTypeModel', 'app/Models/'.$this->Uname.'.php');
    }

    protected function createMigration(){
        if(DB::table('migrations')->where('migration', 'like', '%_'.$this->names.'_%')->count()>0) return 0;
        $files = scandir('database/migrations');
        foreach ($files as $file){
            if(strpos($file, 'create_'.$this->names.'_table')>0){
                return 0;
            }
        }
        $this->makeFiles('commands/collectionTypeMigration', 'database/migrations/'.date('Y_m_d_20i').rand(10,99).'_create_'.$this->names.'_table.php');
    }

    protected function createControllers(){
        $this->makeFiles('commands/collectionTypeController', 'app/Http/Controllers/Admin/Admin'.$this->Unames.'Controller.php');
        $this->makeFiles('commands/collectionTypeControllerWeb', 'app/Http/Controllers/Web/Web'.$this->Unames.'Controller.php');
    }


    protected function createViews(){

        if (!file_exists('resources/views/admin/collections/'.$this->names)) {
            mkdir('resources/views/admin/collections/'.$this->names, 0777, true);
        }
        if (!file_exists('resources/views/web/collections/'.$this->names)) {
            mkdir('resources/views/web/collections/'.$this->names, 0777, true);
        }

        $this->makeFiles('commands/CollectionTypeViews/index', 'resources/views/admin/collections/'.$this->names.'/index.blade.php');
        $this->makeFiles('commands/CollectionTypeViews/create', 'resources/views/admin/collections/'.$this->names.'/create.blade.php');
        $this->makeFiles('commands/CollectionTypeViews/edit', 'resources/views/admin/collections/'.$this->names.'/edit.blade.php');
        $this->makeFiles('commands/CollectionTypeViews/form', 'resources/views/admin/collections/'.$this->names.'/form.blade.php');
        $this->makeFiles('commands/CollectionTypeViews/item', 'resources/views/web/collections/'.$this->names.'/item.blade.php');
        $this->makeFiles('commands/CollectionTypeViews/items', 'resources/views/web/collections/'.$this->names.'/items.blade.php');
    }

    protected function setConfigs(){
        if(\Models\PageType::where('name', $this->names)->count()>0) return 0;
        \Models\PageType::insert(['name' => $this->names, 'type' => 'collection']);
    }


    protected function makeFiles($input, $output){
        $file = Storage::disk('public')->get($input);
        $file = str_replace('{Uname}', $this->Uname, $file);
        $file = str_replace('{Unames}', $this->Unames, $file);
        $file = str_replace('{name}', $this->name, $file);
        $file = str_replace('{names}', $this->names, $file);
        try {
            file_put_contents($output, $file);
        } catch (\Exception $exception){
            $this->error('Does not have permission to create file: "'.$output.'"');
        }
    }

}

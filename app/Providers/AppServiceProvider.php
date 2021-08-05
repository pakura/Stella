<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Models\PageType;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app['config']->get('app.debug')) {
            log_executed_db_queries();
        }
        $this->mergePageTypes();
        $this->mergeCollectionTypes();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function mergePageTypes(){
        try {
            if(!\Schema::hasTable('page_types')) return 0;
        } catch ( \Exception $exception ){
            return 0;
        }
        $typeNames = PageType::where('type', 'page')->pluck('name')->toArray();
        $types = [];
        foreach ($typeNames as $name){
            $types[$name] = ucfirst($name);
        }

        $currentConfig = config()->get('cms.pages.types');
        $currentConfig = array_merge($currentConfig, $types);
        config()->set('cms.pages.types', $currentConfig);

    }

    protected function mergeCollectionTypes(){
        try {
            if(!\Schema::hasTable('page_types')) return 0;
        } catch ( \Exception $exception ){
            return 0;
        }
        if(!\Schema::hasTable('page_types')) return 0;
        $typeNames = PageType::where('type', 'collection')->pluck('name')->toArray();
        foreach ($typeNames as $typeName){
            $Uname = ucfirst(Str::singular($typeName));
            $Unames = ucfirst(Str::plural($typeName));
            $name = (Str::singular($typeName));
            $names = (Str::plural($typeName));

            $collectionRouter = config()->get('cms.routes.collections');
            $collectionRouter[$names] = 'Admin'.$Unames.'Controller';
            config()->set('cms.routes.collections', $collectionRouter);

            $collectionType = config()->get('cms.collections.types');
            $collectionType[$names] = $Unames;
            config()->set('cms.collections.types', $collectionType);

            $collectionIcons = config()->get('cms.icons');
            $collectionIcons[$names] = 'fa fa-list-alt';
            config()->set('cms.icons', $collectionIcons);
        }

    }
}

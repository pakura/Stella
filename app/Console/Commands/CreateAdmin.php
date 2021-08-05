<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Models\CmsUser;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Admin User';

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
        $data = [];
        $data['first_name'] = $this->ask('First name');
        $data['last_name'] = $this->ask('Last name');
        $data['email'] = $this->ask('Email');
        $data['password'] = Hash::make($this->secret('password'));
        $data['role'] = $this->choice('Role', ['admin', 'member'], 'admin');
        $data['phone'] = $this->ask('Phone', '');
        CmsUser::insert($data);
        $this->info('Created...');
        return 0;
    }


}

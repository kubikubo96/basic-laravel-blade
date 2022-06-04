<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Post as Post;

class PostCommand extends Command
{
    /**
     * chạy command đã tạo: php artisan post:cron
     */
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     **
     * @return mixed
     */
    public function handle()
    {
        $data = [
            'user_id' => 2,
            'title' => time().'- auto run schedule',
            'slug' => time().'- auto run schedule',
            'content' => time().'- auto run schedule',
            'image' => time().'- auto run schedule',
        ];

        return Post::create($data);
    }
}

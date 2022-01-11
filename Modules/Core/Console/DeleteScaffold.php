<?php

namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Modules\Core\Scaffold\Support\Scaffold;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DeleteScaffold extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:scaffold-delete {domain} {module} {--force} {--api}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletar Estrutura de CRUD.';

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
     *
     * @return mixed
     */
    public function handle()
    {
        $domain = $this->argument('domain');
        $module = $this->argument('module');
        $force = $this->option('force');
        $api = $this->option('api');

        try{
            $scaffold = new Scaffold($domain, $module, $force, $api);
            $scaffold->delete();
        }catch (\Exception $exception){
            $this->info($exception->getMessage());
            return false;
        }

        $this->info("Domain deletado com sucesso!");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['example', InputArgument::REQUIRED, 'An example argument.'],
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
        ];
    }
}

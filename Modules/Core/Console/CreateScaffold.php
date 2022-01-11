<?php

namespace Modules\Core\Console;

use Illuminate\Console\Command;
use Modules\Core\Scaffold\Support\Scaffold;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateScaffold extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:scaffold {domain} {module} {--force} {--api} {--noview} {--nocontroller}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criar Estrutura de CRUD.';

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

        $noview = $this->option('noview');
        $nocontroller = $this->option('nocontroller');

        try{
            $scaffold = new Scaffold($domain, $module, $force, $api, $noview, $nocontroller);
            if(!$scaffold->generate()){
                throw new \Exception("Modulo [".$module."] não existe!");
            }
        }catch (\Exception $exception){
            $this->info($exception->getMessage());
            return false;
        }

        $this->info("Domain criado com sucesso!");
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

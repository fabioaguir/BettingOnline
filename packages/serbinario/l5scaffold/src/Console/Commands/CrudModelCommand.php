<?php

namespace Serbinario\L5scaffold\Console\Commands;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Console\Command;
use DB;
use Artisan;
use Serbinario\L5scaffold\CrudGeneratorService;
use Serbinario\L5scaffold\Generic;


class CrudModelCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:modelSer {table-name} {--force} {--singular} {--model-name=} {--master-layout=} {--custom-controller=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create fully functional CRUD code based on a mysql table instantly';

    private $tableDescribes;

    private $tableFields;

    private $phathModels = "app/Entities";

    //Vai ignorar esse campos da tabela
    private $ignore = array('id','created_at','updated_at');

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
        //Retorna namespace
        //dd(app()->getNamespace());
        $tableName = strtolower($this->argument('table-name'));

        $modelName = $this->option('model-name');

        //Passo cada tabela e retorno todos os campos
        $this->tableDescribes = $table = DB::select('DESCRIBE ' . $tableName);



        //Comcateno em tableField todos os campos da tabela
        $this->tableFields .= "[ " .PHP_EOL;
        foreach ($this->tableDescribes as $values) {

            if (!in_array($values->Field, $this->ignore)) {

                $this->tableFields .= "\t\t'" . $values->Field . "'," . "\n";
            }
        }

        $this->tableFields .= "\t]";

        //dd($this->tableFields);

        //Seto o caminho e o nome do arquivo modelo
        Generic::setFilePath($this->getStub());


        Generic::setReplacements(['NAMESPACE' => app()->getNamespace()]);
        Generic::setReplacements(['TABLE' => $tableName]);
        Generic::setReplacements(['CLASS' => Generic::ucWords($modelName)]);
        Generic::setReplacements(['FILLABLE' => $this->tableFields]);
        //Generic::setReplacements(['METODO' => $this->compileRelations]);


        Generic::write(Generic::getContents(Generic::getReplacements()), $this->phathModels);





    }

    protected function getStub()
    {
        return __DIR__.'/../../stubs/model.stub';
    }


}

<?php

namespace Serbinario\L5scaffold\Console\Commands;

use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Console\Command;
use Artisan;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Serbinario\L5scaffold\CrudGeneratorService;
use Serbinario\L5scaffold\Generic;


class CrudViewCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:viewSer {table-name} {--force} {--singular} {--model-name=} {--master-layout=} {--custom-controller=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create fully functional CRUD code based on a mysql table instantly';

    private $tableDescribes;

    private $tableFields;

    private $phathviews = "resources/views";

    //Vai ignorar esse campos da tabela
    private $ignore = array('id','created_at','updated_at');

    /**
     * Html of the form heading.     *
     * @var string
     */
    protected $formHeadingHtml = '';

    protected $formBodyHtml = '';

    private $buildImput;

    /**
     * Html of Form's fields.     *
     * @var string
     */
    protected $formFieldsHtml = '';

    protected $typeLookup = [
        'string' => 'text',
        'char' => 'text',
        'varchar' => 'text',
        'text' => 'textarea',
        'mediumtext' => 'textarea',
        'longtext' => 'textarea',
        'json' => 'textarea',
        'jsonb' => 'textarea',
        'binary' => 'textarea',
        'password' => 'password',
        'email' => 'email',
        'number' => 'number',
        'integer' => 'number',
        'bigint' => 'number',
        'mediumint' => 'number',
        'tinyint' => 'number',
        'smallint' => 'number',
        'decimal' => 'number',
        'double' => 'number',
        'float' => 'number',
        'date' => 'date',
        'datetime' => 'datetime-local',
        'time' => 'time',
        'boolean' => 'radio',
    ];

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

        $tableName = strtolower($this->argument('table-name'));

        $modelName = $this->option('model-name');


        $schema = \DB::getDoctrineSchemaManager();

        //Retorna todas as tabelas
        $tables = $schema->listTableColumns($tableName);

        //Varre a procura de cada fields
        foreach ($tables as $column) {
            echo ' - ' . $column->getName() . " - " . $column->getType()->getName() . "\n";

            $typeName = $this->choice('Foi encontrado o capo '
                . $column->getName()
                . " do tipo "
                . $column->getType()->getName()
                . " Escolha um tipo", ['text', 'password', 'select', 'radio', 'date', 'checkbox', 'Não Gerar'], false);

            $this->formFieldsHtml .= $this->createField($typeName, $column);

        }

        Generic::setNameClasseSingular("teste.blade");
        Generic::write($this->formFieldsHtml, '');
        dd($this->formFieldsHtml);


    }

    protected function createField($type, $column)
    {
       // dd($column->getType()->getName());
        switch ($type) {
            case 'text':
                return $this->createTextField($column);
                break;
            case 'password':
                return $this->createPasswordField($column);
                break;
            case 'select':
                return $this->createSelectField($column);
                break;
            case 'radio':
                return $this->createRadioField($column);
                break;
            case 'date':
                return $this->createDateField($column);
                break;
            case 'checkbox':
                return $this->createChecboxField($column);
                break;
            case 'Não Gerar':
                break;
            default: // text
                return $this->createFormField($column);
        }
    }

    private function createTextField($column)
    {
        $this->buildImput = "";
        $this->buildImput .= PHP_EOL;
        $this->buildImput .= "\t\t\t\t{!! Form::label('" .$column->getName() . "', '" .$column->getName() . "') !!}\n";
        $this->buildImput .= "\t\t\t\t" . "{!! Form::text('" .$column->getName() . "', null, array('class' => 'form-control')) !!}";
        return $this->wrapField($this->buildImput, '');

    }

    private function createPasswordField($column)
    {
        $this->buildImput = "";
        $this->buildImput .= PHP_EOL;
        $this->buildImput .= "\t\t\t\t{!! Form::label('" .$column->getName() . "', '" .$column->getName() . "') !!}\n";
        $this->buildImput .= "\t\t\t\t" . "{!! Form::password('" .$column->getName() . "', array('class' => 'form-control')) !!}";
        return $this->wrapField($this->buildImput, '');

    }

    private function createSelectField($column)
    {
        $this->buildImput = "";
        $this->buildImput .= PHP_EOL;
        $this->buildImput .= "\t\t\t\t{!! Form::label('" .$column->getName() . "', '" .$column->getName() . "') !!}\n";
        $this->buildImput .= "\t\t\t\t" . "{!! Form::select('" .$column->getName() . "', array(), array('class' => 'form-control')) !!}";
        return  $this->wrapField($this->buildImput, '');

    }

    private function createEmailField($column)
    {
    }
    private function createRadioField($column)
    {
    }

    private function createDateField($column)
    {
        $this->buildImput = "";
        $this->buildImput .= PHP_EOL;
        $this->buildImput .= "\t\t\t\t{!! Form::label('" .$column->getName() . "', '" .$column->getName() . "') !!}\n";
        $this->buildImput .= "\t\t\t\t" . "{!! Form::text('" .$column->getName() . "', null, array('class' => 'form-control datepicker')) !!}";

        return  $this->wrapField($this->buildImput, '');
    }

    private function createCheckboxField($column)
    {
    }

    public function createFormField($column){

    }





    protected function wrapField($column, $field)
    {
        $buildImput = "
            <div class=\"col-md-4\">
                <div class=\"form-group\">
                    $column
                </div>
            </div>";
        //dd($buildImput);
        return $buildImput;


        //Seto o caminho e o nome do arquivo modelo
        //Generic::setNameClasseSingular("teste.blade");
        //Generic::write($buildImput, '');
        //dd($buildImput);

    }

    protected function getStub()
    {
        return __DIR__ . '/../../stubs/modelValidator.stub';
    }


}

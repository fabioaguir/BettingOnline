<div class="row">
    <div class="col-md-12">
        <div class="row">

        <div class="form-group">
            {!! Form::label('name', 'Nome', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-8">
                {!! Form::text('name', Session::getOldInput('name')  , array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('com_email', 'E-mail', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-6">
                {!! Form::text('com_email', Session::getOldInput('com_email')  , array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('com_site', 'Home Page', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-6">
                {!! Form::text('com_site', Session::getOldInput('com_site')  , array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('com_phone', 'Telefone', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-2">
                {!! Form::text('com_phone', Session::getOldInput('com_phone')  , array('class' => 'form-control')) !!}
            </div>
        </div>


        <div class="form-group">
            {!! Form::label('com_phone2', 'Celular', array('class' => 'col-sm-2 control-label')) !!}
            <div class="col-sm-2">
                {!! Form::text('com_phone2', Session::getOldInput('com_phone2')  , array('class' => 'form-control')) !!}
            </div>
        </div>
    </div>
</div>  
</div>
<div class="row">
	<div class="col-md-10">
		<div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('name', 'Nome') !!}
				{!! Form::text('name', Session::getOldInput('com_name')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('com_email', 'E-mail') !!}
				{!! Form::text('com_email', Session::getOldInput('com_email')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('com_site', 'Home Page') !!}
				{!! Form::text('com_site', Session::getOldInput('com_site')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('com_phone', 'Telefone') !!}
				{!! Form::text('com_phone', Session::getOldInput('com_phone')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('com_phone2', 'Celular') !!}
				{!! Form::text('com_phone2', Session::getOldInput('com_phone2')  , array('class' => 'form-control')) !!}
                       
                </div>
            </div>
		</div>
            
             <div class="row">

            <div class="col-md-3">
                <div class="btn-group btn-group-justified">
                    <div class="btn-group">
                        <a href="" class="btn btn-primary btn-block"><i
                                    class="fa fa-long-arrow-left"></i> Voltar</a></div>
                    <div class="btn-group">
                        {!! Form::submit('Salvar', array('class' => 'btn btn-primary btn-block')) !!}
                    </div>
                </div>
            </div>
        </div>  
	</div>
</div>
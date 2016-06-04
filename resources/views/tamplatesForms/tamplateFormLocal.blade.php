<div class="row">
	<div class="col-md-10">
		<div class="row">

            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('loc_value', 'loc_value') !!}
				{!! Form::text('loc_value', Session::getOldInput('loc_value')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('loc_occupants', 'loc_occupants') !!}
				{!! Form::text('loc_occupants', Session::getOldInput('loc_occupants')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('loc_visible', 'loc_visible') !!}
				{!! Form::text('loc_visible', Session::getOldInput('loc_visible')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('loc_title', 'loc_title') !!}
				{!! Form::text('loc_title', Session::getOldInput('loc_title')  , array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    
				{!! Form::label('loc_name', 'loc_name') !!}
				{!! Form::text('loc_name', Session::getOldInput('loc_name')  , array('class' => 'form-control')) !!}
                </div>
            </div>
		</div>
	</div>
</div>
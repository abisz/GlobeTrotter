<div class="form-group">
    {!! Form::label('name', 'Name of the Trip:') !!}
    <!-- arguments: name, default, additional parameters -->
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Body Form Input -->
<div class="form-group">
    {!! Form::label('desc', 'Description:') !!}
    {!! Form::textarea('desc', null, ['class' => 'form-control']) !!}
</div>

<!-- Body Form Input -->
<div class="form-group">
    {!! Form::label('start', 'Starting Date:') !!}
    {!! Form::input('date', 'start', $start, ['class' => 'form-control']) !!}
</div>

<!-- Body Form Input -->
<div class="form-group">
    {!! Form::label('end', 'Ending Date:') !!}
    {!! Form::input('date', 'end', $end, ['class' => 'form-control']) !!}
</div>

<!-- Add Trip Form Input -->
<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
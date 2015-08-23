<div class="form-group">
    {!! Form::label('title', 'Title of the Picture:') !!}
    <!-- arguments: name, default, additional parameters -->
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Body Form Input -->
<div class="form-group">
    {!! Form::label('desc', 'Description:') !!}
    {!! Form::textarea('desc', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Form Input -->
<div class="form-group">
    {!! Form::file('image', null, ['class' => 'form-control']) !!}
</div>

<!-- Add Picture Form Input -->
<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
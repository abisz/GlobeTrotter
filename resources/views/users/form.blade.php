<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <!-- arguments: name, default, additional parameters -->
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Body Form Input -->
<div class="form-group">
    {!! Form::label('desc', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Form Input -->
<div class="form-group">
    {!! Form::label('image', 'Profil Pic: ') !!}
    {!! Form::file('image', null, ['class' => 'form-control']) !!}
</div>

<!-- Add Trip Form Input -->
<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
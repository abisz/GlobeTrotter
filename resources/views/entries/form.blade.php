<input id="pac-input" class="controls" type="text" placeholder="Search Box">
<div id="map-canvas"></div>

{!! Form::hidden('lat', null, ['id' => 'lat']) !!}
{!! Form::hidden('lng', null, ['id' => 'lng']) !!}

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
    {!! Form::label('date', 'Date:') !!}
    {!! Form::input('date', 'date', $date, ['class' => 'form-control']) !!}
</div>

<!-- Add Entry Form Input -->
<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>
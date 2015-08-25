
@if (isset($trip) && !Request::is('*/edit') && !Request::is('*/create') )
    <ol class="breadcrumb">
        <li><a href="{{url('user').'/'.$user_id}}">{{\App\User::findOrFail($user_id)->name}}</a></li>

        @if(isset($entry))
            <li><a href="{{url().'/trip/'.$trip->id}}">{{$trip->name}}</a></li>
        @endif

        @if(isset($pic))
            <li><a href="{{url().'/trip/'.$trip->id.'/entry/'.$entry->id}}">{{$entry->name}}</a></li>
        @endif

        @if(isset($single_pic))
            <li><a href="{{url().'/trip/'.$trip->id.'/entry/'.$entry->id.'/picture/'.$pic->id}}">{{$pic->title}}</a></li>
        @endif

    </ol>
@endif
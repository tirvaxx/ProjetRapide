

@extends('layouts.rapportsLayout')
@section('content')

   
@if(isset($nomRapport))
  <h1>{{ $nomRapport }}</h1>
@else
  <h1>Rapport non disponible</h1>
@endif

@if(isset($dataRapport))
  <div class="table-rapport table-responsive">
    <table class="table-bordered table-hover">
      <thead class="thead-default">
        <tr>
          @foreach ( $dataRapport as $key => $value )
            @foreach ( $value as $k => $v )
              @if ($loop->parent->first)
                <th>{{$k}}</th>
              @endif
            @endforeach
            @break
          @endforeach
        </tr>
      </thead>
      <tbody >
        
          @foreach ( $dataRapport as $key => $value )
            <tr>
            @foreach ( $value as $k => $v )
                <td>
                  
                  {{$v}}
              
                </td>
            @endforeach
            </tr>
          @endforeach
        
      </tbody>
    </table>
  </div>

@endif

@endsection
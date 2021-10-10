@extends('layouts.app')


@push('css')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">

@endpush
@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Terminal / Subjects /{{$topic->subject->name}} /{{$topic->topic_name}}</h2>
            </div>
         
        </div>

        <div class="w-full block mt-8" style="border-top:5px solid #e2e8f0">
            <div class="d-flex align-content-start flex-wrap justify-between">


                @foreach($video as $video)

                <div class="col-md-6 w3_agile_features_grid video p-4">

                    <iframe width="400" height="215" src="{{$video->link}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    <h4 class="p-2"><strong>{{$video->title_name}}</strong></h4>
                </div>
                
          
               
                @endforeach
            </div>
        </div>




    </div>

@endsection

@push('scripts')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
$('#table_id').DataTable();
} );
</script>
@endpush
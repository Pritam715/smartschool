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
        <div class="mt-8  rounded border-b-4 border-gray-300">
            <div class="flex flex-wrap items-center uppercase text-sm font-semibold bg-gray-300 text-gray-600 rounded-tl rounded-tr">
                <div class="w-2/12 px-4 py-3">SN </div>
                <div class="w-3/12 px-4 py-3">Pdf Name</div>
                <div class="w-3/12 px-4 py-3">File</div>

            </div>
            @foreach ($terminal as $t)
       
                <div class="flex flex-wrap items-center text-gray-700 border-t-2 border-l-4 border-r-4 border-gray-300">
    
                    <div class="w-2/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight">{{ $loop->index+1 }}</div>
                    <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight"><strong>{{ $t->paper_name }}</strong></div>
                    <div class="w-3/12 px-4 py-3 text-sm font-semibold text-gray-600 tracking-tight"><strong><a download href="{{ asset('Uploads/Files/TerminalQuestion/'.$t->file_name) }}"><i class="fa fa-download"></i></a></strong></div>

                </div>
               
            @endforeach
        </div>
        <div class="mt-8">
            {{ $terminal->links() }}
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
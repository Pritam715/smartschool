@extends('layouts.app')


@push('css')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
  
@endpush
@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Subject Topics</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{route('topic.create', auth()->user()->teacher->code_id )}}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Topic</span>
                </a>
            </div>
        </div>
    
        <div class="mt-8  rounded border-b-4 border-gray-300">
            <table id="table_id" class="display" style="text-align:center">
                <thead class="bg-gray-300">
                    <tr>
                        <th>Id</th>
                        <th>Class</th>
                        <th>Category</th>
                        <th>Subject</th>
                        <th>Topic</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topic as $t)
                       <tr>
                           <td>{{ $loop->index+1 }}</td>
                           <td>{{$t->class->class_name}}</td>
                           <td>@if($t->category_id == 1)
                                 <span>PDF</span>
                                 @elseif($t->category_id == 2)
                                 <span>Video</span>
                                 @elseif($t->category_id == 3)
                                  <span>Question Paper</span>
                                  @elseif($t->category_id == 4)
                                  <span>Important Question</span>
                                @endif
                        
                        
                        
                                </td>
                           <td>{{$t->subject->name}}</td>
                           <td>{{ $t->topic_name }}</td>
                           <td>
                            <a href="{{ route('topic.edit',$t->id) }}"><i class="fa fa-edit" style="color:darkblue"></i></a>
                            <a href="{{ route('topic.delete',$t->id) }}" class="inline-flex ml-1"><i class="fa fa-trash" style="color:red"></i></a>

        

                           </td>
                       </tr>
                      @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8">
            {{ $topic->links() }}
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
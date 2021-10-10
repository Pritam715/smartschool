@extends('layouts.app')


@push('css')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
  
@endpush
@section('content')
    <div class="roles-permissions">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Subjects</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{ route('subject.create') }}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="plus" class="svg-inline--fa fa-plus fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Subject</span>
                </a>
            </div>
        </div>
        <div class="mt-8  rounded border-b-4 border-gray-300">
            <table id="table_id" class="display" style="text-align:center">
                <thead class="bg-gray-300">
                    <tr>
                        <th>Class</th>
                        <th>Name</th>
                        <th>Code</th>
                        <th>Teacher</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $subject)
                       <tr>
                           <td>{{ $subject->grade->class_name }}</td>
                           <td>{{ $subject->name }}</td>
                           <td>{{ $subject->subject_code }}</td>
                           <td>{{ $subject->teacher->user->name }}</td>
                           <td>{{ $subject->description }}</td>
                           <td>
                            <a href="{{ route('subject.edit',$subject->id) }}"><i class="fa fa-edit" style="color:darkblue"></i></a>
                           
                            <form action="{{ route('subject.destroy',$subject->id) }}" method="POST" class="inline-flex ml-1">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="">
                                    <i class="fa fa-trash" style="color:red"></i>
                                </button>
                            </form>

                           </td>
                       </tr>
                      @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-8">
            {{ $subjects->links() }}
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
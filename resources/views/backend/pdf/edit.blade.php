@extends('layouts.app')

@section('content')
    <div class="roles">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Edit Pdf</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="{{route('topic.index', auth()->user()->teacher->code_id )}}" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>

        <div class="table w-full mt-8 bg-white rounded">
            <form action="{{ route('pdf.update',$pdf->id) }}" method="POST" enctype="multipart/form-data" class="w-full max-w-xl px-6 py-12">
                @csrf

                <input type="hidden" name="teacher_id" value={{auth()->user()->teacher->id}}>
                <input type="hidden" name="teacher_code_id" value={{auth()->user()->teacher->code_id}}>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Select Class
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select name="class_id" id="class" required class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state" >
                            <option selected="true" disabled>--Select Class--</option>
                            @foreach ($class as $c)
                                <option value="{{ $c->id }}" {{$c->id == $pdf->class_id ? 'selected' : '' }}>{{ $c->class_name}}</option>
                            @endforeach
                            <input type="hidden" name="teacher_code_id" id="code_id" value={{auth()->user()->teacher->code_id}}>

                        </select>
                         @error('class_name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Select Subject
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select name="subject_id" id="subject_id"  value="{{$pdf->subject_id}}" required class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                            <option value="">--Select Subject--</option>
                            <input type="hidden" name="teacher_code_id" id="code_id" value={{auth()->user()->teacher->code_id}}>

                            {{-- @foreach ($subject as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach --}}
                        </select>
                         @error('class_name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Select Topic
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <select name="topic_id" id="topic_id"  required class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-state">
                            <option selected="true" disabled>--Select topic--</option>
                             {{-- @foreach ($topic as $t)
                                <option value="{{ $t->id }}">{{ $t->topic_name }}</option>
                            @endforeach --}}
                        </select>
                         @error('topic_id')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Pdf Name
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="pdf_name" value="{{$pdf->pdf_name}}" id= required class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="text" value="{{ old('topic_name') }}">
                        @error('pdf_name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4">
                            Pdf File
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input name="file_name" value="{{$pdf->file_name}}" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500" type="file" value="{{ old('file_name') }}">
                       
                        @error('file_name')
                            <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
               
                

                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <button class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                            Update PDF
                        </button>
                    </div>
                </div>
            </form>        
        </div>
        
    </div>
@endsection

@push('scripts')


<script>

    $(document).ready(function(){
    
    $('#class').on('change',function(){
  
          
          var id=$(this).val();
          var slug= $('#code_id').val()
        //   console.log(slug);
        //   console.log(id);
          // var div=$(this).parent();
          
          var op=" ";
          
          $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
          type:'get',
          url:'{!!URL::to('findsubject')!!}',
          data:{'id':id,
              'slug':slug,
          },
          success:function(data){
            //  console.log('success');
          
            //  console.log(data);
          
             // console.log(data.length);
             $('#subject_id').find('option').remove();
    
             op+='<option value="0" selected disabled>--Select--</option>';
             for(var i=0;i<data.length;i++){
              op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
             
              }
              $('#subject_id').append(op);
    
    
          },
          error:function(){
          
          }
         });
    });
    });    
    
    //Topic Name
    $(document).ready(function(){
    
    $('#subject_id').on('change',function(){
  
          
          var id=$(this).val();
          var slug= $('#code_id').val()
          console.log(slug);
          console.log(id);
          // var div=$(this).parent();
          
          var op=" ";
          
          $.ajax({
          headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           },
          type:'get',
          url:'{!!URL::to('pdftopic')!!}',
          data:{'id':id,
              'slug':slug,
          },
          success:function(data){
             console.log('success');
          
             console.log(data);
          
             // console.log(data.length);
             $('#topic_id').find('option').remove();
    
             op+='<option value="0" selected disabled>--Select--</option>';
             for(var i=0;i<data.length;i++){
              op+='<option value="'+data[i].id+'">'+data[i].topic_name+'</option>';
             
              }
              $('#topic_id').append(op);
    
    
          },
          error:function(){
          
          }
         });
    });
    });    
    
   
    
    </script>

@endpush
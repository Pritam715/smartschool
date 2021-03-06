@extends('layouts.app')

@section('content')
    <div class="roles">

        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-gray-700 uppercase font-bold">Terminal / Subjects</h2>
            </div>
            <div class="flex flex-wrap items-center">
                <a href="" class="bg-gray-200 text-gray-700 text-sm uppercase py-2 px-4 flex items-center rounded">
                    <svg class="w-3 h-3 fill-current" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="long-arrow-alt-left" class="svg-inline--fa fa-long-arrow-alt-left fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M134.059 296H436c6.627 0 12-5.373 12-12v-56c0-6.627-5.373-12-12-12H134.059v-46.059c0-21.382-25.851-32.09-40.971-16.971L7.029 239.029c-9.373 9.373-9.373 24.569 0 33.941l86.059 86.059c15.119 15.119 40.971 4.411 40.971-16.971V296z"></path></svg>
                    <span class="ml-2 text-xs font-semibold">Back</span>
                </a>
            </div>
        </div>
        <div class="w-full block mt-8">
            <div class="d-flex align-content-start flex-wrap justify-between">
                  @foreach($subjects as $subject)
                   <button>  <a href="{{route('terminal.subject.topic',$subject->id)}}">
                      <div class=" bg-gray-200 text-center border border-gray-300 px-8 py-6 mx-0 sm:mx-6 my-4 sm:my-0 rounded" style="width:350px">
                       <h3 class="text-gray-700 uppercase font-bold">
                           <span class="text-4xl"></span>
                          <span class="leading-tight">{{$subject->name}}</span>
                       </h3>
                    </div></a>
                  </button>
                   @endforeach
            
            </div>
        </div>
  
        
    </div>
@endsection

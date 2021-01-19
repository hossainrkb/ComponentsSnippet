<div>
    <!-- Be present above all else. - Naval Ravikant -->
   <div {{ $attributes->merge(['class' => 'alert alert-'.$type]) }}>
       {{ $title }}
    {{ $slot }}
    
    Hola
   </div>
  
    {{-- {{ $message }} --}}
    {{-- @if ($isSelected("CONFIDENTIAL AREA"))
        
    this is alert alert alert alert alert alert alert alert alert alert alert alert alert alert alert alert
    @endif

    @php
        $options = array('rakib','hossain','son')
    @endphp
    <Select>
        @forelse ($options as $item)
        <option value="{{ $item }}"  @if($isSelected("son")) selected  @endif >{{ $item }}</option>
            
        @empty
            
        @endforelse
    </Select>--}}
</div> 
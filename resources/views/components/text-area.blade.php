@props(['rows'=>2])

<div>
    <textarea name="" id="" rows="{{$rows}}" {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full']) }}></textarea>
</div>
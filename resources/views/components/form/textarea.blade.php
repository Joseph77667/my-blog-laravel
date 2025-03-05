@props(['name','value'=>''])
<x-form.input-wrapper>
    <x-form.label :name="$name"/>
    <textarea
    required
    id="{{$name}}"
        name="{{$name}}"
        class="form-control"
    >{{old($name, $value)}}</textarea>
    <x-error :name="$name"/>
</x-form.input-wrapper>
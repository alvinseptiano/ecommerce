@props(['disabled' => false, 'errors', 'type' => 'text', 'label' => false])

<?php
/** @var \Illuminate\Support\ViewErrorBag $errors */
/** @var \Illuminate\View\ComponentAttributeBag  $attributes */
?>
<?php
$errorClasses = 'border-error focus:border-red-600 ring-1 ring-red-600 focus:ring-red-600';
$defaultClasses = 'input';
$successClasses = 'input-bordered ring-1 ring-emerald-500 focus:ring-emerald-500';

$attributeName = preg_replace('/(\w+)\[(\w+)]/', '$1.$2', $attributes['name']);
?>
<div>
    @if ($label)
        <label>{{$label}}</label>
    @endif
    @if ($type === 'select')
        <select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
            'class' => 'rounded-full w-full' .
             ($errors->has($attributeName) ? $errorClasses : (old($attributeName) ? $successClasses :$defaultClasses))
        ]) !!}>
            {{ $slot }}
        </select>
    @else
        <input {{ $disabled ? 'disabled' : '' }} type="{{$type}}" {!! $attributes->merge([
            'class' => 'rounded-full w-full' .
             ($errors->has($attributeName) ? $errorClasses : (old($attributeName) ? $successClasses :$defaultClasses))
        ]) !!}>
    @endif
    @error($attributeName)
        <small class="text-error"> {{ $message }}</small>
    @enderror
</div>

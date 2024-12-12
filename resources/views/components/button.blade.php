<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-outline w-full rounded-full']) }}>
    {{ $slot }}
</button>

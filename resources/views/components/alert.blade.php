@props([
    'type' => session()->has('success') ? 'success' : (session()->has('error') ? 'error' : 'info'),
    'message' => session('success') ?? (session('error') ?? ''),
])

@if ($message || $errors->any())
    <div
        class="p-4 mb-4 rounded-lg text-sm
        @if ($type === 'success') bg-green-100 text-green-500
        @elseif($type === 'error') bg-red-100 text-red-500
        @else bg-gray-100 text-gray-800 @endif
    ">
        @if ($message)
            {{ $message }}
        @endif

        @if ($errors->any())
            <ul class="mt-1 list-disc list-inside">
                @foreach ($errors->any() as $errors)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endif

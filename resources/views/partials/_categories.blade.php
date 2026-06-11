{{-- Add section to display all categories --}}
@php
    $wrapperClass = $wrapperClass ?? 'categories';
    $showIcon = $showIcon ?? true;
@endphp

@if (empty($categories))
    <div class="{{ $wrapperClass }}">
        <p>No categories available.</p>
    </div>
@else
    <div class="{{ $wrapperClass }}">
        <ul>
            @foreach ($categories as $id => $name)
                <li>
                    <a href="{{ route('category.show', $id) }}">
                        {{ $name }}
                        @if ($showIcon)
                            <i class="fa-solid fa-chevron-right"></i>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
    @include('partials._flash-messages')
@endif

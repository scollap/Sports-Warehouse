{{-- Flash messages (temporary in session) --}}
@if (session('success') || session('error') || session('message'))
    <div class="bg-white py-3 flash-messages mt-2">
        <div class="max-w-7xl mx-auto">

            {{-- Success --}}
            @if (session('success'))
                <div class="alert alert-success bg-teal-100 border border-teal-400 text-teal-700 px-4 py-3 rounded relative"
                     role="alert">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error --}}
            @if (session('error'))
                <div class="alert alert-danger bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                     role="alert">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Message --}}
            @if (session('message'))
                <div class="alert alert-message bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative"
                     role="alert">
                    {{ session('message') }}
                </div>
            @endif

        </div>
    </div>
@endif

{{-- Add section to display all categories --}} 
@if (empty($categories))
    <p>No categories available.</p>
@else
    <div class="categories">
        <ul>
            @foreach ($categories as $id => $name)
                <li><a href="/category/{{ $id }}">{{ $name }}<i class="fa-solid fa-chevron-right"></i></a></li>
            @endforeach
        </ul>
    </div>
@endif
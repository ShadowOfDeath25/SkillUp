<div class="error">
    @if(session('success'))
        <div class="success">
            <i class="fa-solid fa-circle-check"> Success</i>
            <ul>
                <li>
                    {{ session('success') }}
                </li>
            </ul>
        </div>
    @endif
    @if($errors->any())
        <div class="errors">
            <i class="fa-solid fa-circle-exclamation"> error</i>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>

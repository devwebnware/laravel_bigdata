<style>
    .alert {
        position: fixed;
        right: 38px;
        width: 20%;
        z-index: 10;
    }

    @media only screen and (max-width: 767px) {
        .alert {
            position: relative;
            right: 0;
            width: 100%;
            z-index: 10;
        }
    }
</style>
<div>
    {{ $slot }}
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible mb-2">
            <button type="button" class="close" data-dismiss="alert"></button>
            <p>
                {{ session()->get('message') }}
            </p>
        </div>
    @elseif(session()->has('error'))
        <div class="alert alert-danger alert-dismissible  mb-2">
            <button type="button" class="close" data-dismiss="alert"></button>
            <p>
                {{ session()->get('error') }}
            </p>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible  mb-2">
            <button type="button" class="close" data-dismiss="alert"></button>
            <ul>
                @foreach ($errors->all() as $error)
                    <li style="list-style:none;"> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
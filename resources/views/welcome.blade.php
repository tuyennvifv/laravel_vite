@php

$manifest = json_decode(@file_get_contents(public_path('/dist/manifest.json')), true);

$users = [['name' => 'Tuyen'],['name' =>'nv']];

@endphp


<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Vite</title>

        @if (env('APP_ENV') == 'local')
            <script type="module" src="http://localhost:3000/@vite/client"></script>
            <script type="module" src="http://localhost:3000/index.js"></script>
        @else
            <script type="module" src="dist/{{ $manifest['index.js']['file'] }}"></script>
            <link href="dist/{{ $manifest['index.css']['file'] }}" rel="stylesheet" />
        @endif
    </head>
    
    <body>
    
        <h3>Hello from Blade template <code>welcome.blade.php</code></h3>

        <p>Environment: {{ env('APP_ENV') }}</p>

        <br />

        <div id="app">

            <Users :users-from-props="{{ json_encode($users) }}" v-slot="{ usersFromProps, onClick }">
                <p>Got users data from the default slot</p>
                <pre
                    v-for="(user, i) in usersFromProps"
                    :key="i"
                    @click="onClick"
                >Name: @{{ user.name }}</pre>
            </Users>

        </div>
        
    </body>

</html>

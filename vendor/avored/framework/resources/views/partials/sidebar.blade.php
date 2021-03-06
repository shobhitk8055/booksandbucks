<div class="bg-white border-r min-h-screen"> 
    <div class="flex items-center">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center mt-2">
            <img class="h-12 block ml-6 w-12" src="{{ asset('vendor/avored/images/logo_only.png') }}" />
            <div class="text-xl text-red-600" :class="sidebar ? 'hidden' : ''">Books & Bucks</div>
        </a>
    </div>

    <nav class="mt-10">

        @foreach ($adminMenus as $key => $adminMenu)
            <avored-menu :sidebar="sidebar" :menu="{{ json_encode($adminMenu) }}"></avored-menu>
{{--            <p>{{ json_encode($adminMenu) }}</p>--}}
        @endforeach
        <avored-menu :sidebar="sidebar" :menu="{{ json_encode($genres) }}"> adfad</avored-menu>
        <avored-menu :sidebar="sidebar" :menu="{{ json_encode($offers) }}"> adfad</avored-menu>
    </nav>

</div>

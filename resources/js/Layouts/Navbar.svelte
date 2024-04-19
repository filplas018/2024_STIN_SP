<script>
    export let user;
</script>

<nav class="bg-gray-800 p-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center">
            <h1 class="text-white text-2xl font-bold">My Website</h1>
            <div>
                {#if user}
                    <p class="text-white">Welcome, {user}</p>
                    <!-- Add logout button or other user actions -->
                {:else}
                    <a href="/login" class="text-white mr-4">Login</a>
                    <a href="/register" class="text-white">Register</a>
                {/if}
            </div>
        </div>
    </div>
</nav>

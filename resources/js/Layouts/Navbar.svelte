<script>
    export let user;
</script>

<nav class="bg-gray-800 p-4">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center">
            <h1 class="text-white text-2xl font-bold">MW</h1>
            <div>
                {#if user}
                    <div class="flex flex-col justify-end items-end">
                        <a href="/profile" class="text-md font-bold text-white">{user.email.substring(0, user.email.indexOf('@'))}</a>
                        <a href="/logout" class="text-white">Odhlásit</a>
                    </div>
                {:else}
                    <a href="/login" class="text-white mr-4">Přihlásit</a>
                    <a href="/register" class="text-white">Registrovat</a>
                {/if}
            </div>
        </div>
    </div>
</nav>

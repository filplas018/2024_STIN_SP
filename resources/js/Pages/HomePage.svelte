<script>
    import { useForm } from '@inertiajs/svelte'
    import { writable } from 'svelte/store';

    export let weather;
    export let favourite;
    console.log(favourite)
    const form = useForm({
        city: weather.name,
    })

    const favForm = useForm({
       city: $form.city,
       long: weather.lon,
       lat: weather.lat,
    });
    function submitFav() {
        $favForm.city = $form.city;
        $favForm.long = weather.lon;
        $favForm.lat = weather.lat;
        $favForm.post('/')
    }

    function submit() {
        $form.get('/')
    }
</script>
<div class="flex justify-center gap-x-5 my-5">
    {#if favourite}
        <div class="flex flex-col max-h-52 overflow-y-scroll">
            {#each favourite as f}
                <a href={f.url}>
                    {f.name}
                </a>
            {/each}

        </div>
    {/if}
    <form class="flex-col gap-2" on:submit|preventDefault={submit}>
        <label>
            <input type="text" bind:value={$form.city} required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
        </label>
        <button type="submit" class="w-full mt-4 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Find</button>
    </form>
    <form class="flex-col gap-2" on:submit|preventDefault={submitFav}>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Save</button>
    </form>
</div>
<div class="weather-container">
    <div class="current-weather text-center">
        {#if weather}
            <div class="icon flex justify-center">
                <img src={weather.icon} alt="weather icon">
            </div>
            <div class="temperature">{weather.temp}°C</div>
            <div class="condition">{weather.description}</div>
            <div class="condition">{weather.name}</div>
            <div class="condition">{weather.country}</div>
        {:else}
                <p>Toto místo neznáme!</p>
        {/if}

    </div>
</div>

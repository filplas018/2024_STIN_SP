<script>
    import { useForm } from '@inertiajs/svelte'
    import Swal from "sweetalert2";

    export let history;
    export let city = "Praha";
    export let error;
    export let favourite;


    const form = useForm({
        city,
        start_date: null,
        end_date: null,
    })

    function submit() {
        $form.get('/data', {
            onError: () => alert("test"),
        });
    }

    $: if (error) {
        Swal.fire({
            title: "Neplatné město!",
            icon: "error",
        });
    }
</script>

<h2 class="text-2xl font-bold mb-6">Weather History of: {$form.city}</h2>
<div class="flex items-center p-8">

    <div>
        {#if favourite}
            <div class="flex flex-col overflow-y-scroll gap-x-4">
                {#each favourite as f}
                    <a href="/data{f.url}&end_date={$form.end_date??''}&start_date={$form.start_date??''}"
                       class="hover:text-blue-500">
                        {f.name}
                    </a>
                {/each}

            </div>
        {/if}
    </div>

    <form class="flex flex-col items-center mb-8" on:submit|preventDefault={submit}>
        <div class="mb-4">
            <label>
                <input type="text" bind:value={$form.city} id="name" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
            </label>
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700" for="startDate">Start Date</label>
            <input
                type="date"
                id="startDate"
                bind:value={$form.start_date}
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"

            />
        </div>
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700" for="endDate">End Date</label>
            <input
                type="date"
                id="endDate"
                bind:value={$form.end_date}
                class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"

            />
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Fetch History</button>
    </form>

</div>
    <div class="w-full overflow-auto">
        {#if history}

            <table class="table-auto">
                <tr class="border-b dark:bg-gray-800">
                    <th>Date</th>
                    <th>Temp</th>
                    <th>Pressure</th>
                    <th>Humidity</th>
                    <th>WindSpeed</th>
                    <th>WindDeg</th>
                    <th>Clouds</th>
                </tr>
                {#each history as h}
                    <tr class="border-b dark:bg-gray-800">
                        <td>{new Date(h.dt).toISOString().split('T')[0].split('-')}</td>
                        <td>{h.temp} C</td>
                        <td>{h.pressure} Bar</td>
                        <td>{h.humidity}</td>
                        <td>{h.speed} Km/h</td>
                        <td>{h.deg}</td>
                        <td>{h.clouds}</td>
                    </tr>
                {/each}

            </table>
        {:else}
            <h2>Toto ({$form.city}) místo neznáme</h2>
        {/if}


    </div>


<style lang="postcss">
    tr,td{
        @apply p-5;
    }
</style>

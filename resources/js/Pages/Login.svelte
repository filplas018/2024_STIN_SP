<script>
    import { useForm } from '@inertiajs/svelte'
    import Swal from "sweetalert2";

    // $: if (error) {
    //     Swal.fire({
    //         title: error,
    //         icon: "error",
    //     });
    // }

    let form = useForm({
        email: null,
        password: null,
    })

    function submit() {
        $form.post('/login')
    }
</script>


<h1 class="text-2xl font-bold mb-4">Login</h1>
<a href="/register" class="text-2xl font-bold mb-4">No account?</a>

<form on:submit|preventDefault={submit} class="space-y-4">
    <div>
        <label for="email" class="block">Email:</label>
        <input type="email" id="email" bind:value={$form.email} required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
    </div>
    <div>
        <label for="password" class="block">Password:</label>
        <input type="password" id="password" bind:value={$form.password} required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
    </div>
    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Login</button>
</form>


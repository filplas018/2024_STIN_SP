<script>
    import { useForm } from '@inertiajs/svelte'

    let form = useForm({
        email: null,
        name: null,
        password: null,
        confirmPassword: null,
    })

    function submit() {
        $form.post('/register')
    }
</script>
<h1 class="text-2xl font-bold mb-4">Register</h1>
<a href="/login" class="text-2xl font-bold mb-4">Already have an account?</a>

<form on:submit|preventDefault={submit} class="space-y-4">
    <div>
        <label for="name" class="block">Name:</label>
        <input type="text" id="name" bind:value={$form.name} required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
    </div>
    <div>
        <label for="email" class="block">Email:</label>
        <input type="email" id="email" bind:value={$form.email} required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
    </div>
    <div>
        <label for="password" class="block">Password:</label>
        <input type="password" id="password" bind:value={$form.password} required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
    </div>
    <div>
        <label for="confirmPassword" class="block">Confirm Password:</label>
        <input type="password" id="confirmPassword" bind:value={$form.confirmPassword} required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
    </div>
    <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Register</button>
</form>


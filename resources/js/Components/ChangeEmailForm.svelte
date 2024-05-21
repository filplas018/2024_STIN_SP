<script>
    import {useForm} from "@inertiajs/svelte";
    export let user;

    let form = useForm({
        current_password:null,
        new_email:null,

    })
    function submit() {
        $form.post('/change-email')
    }
</script>

<div class="mb-8 rounded-2xl bg-white p-5">
    <h1 class="mb-4 text-md font-medium">Account detail</h1>
    <form on:submit|preventDefault={submit}>
        <label class="mb-1 block text-sm text-slate-800" for="email">New Email</label>
        <input
            class="w-full mb-5 appearance-none rounded border border-slate-200 px-3 py-2 text-sm leading-tight text-slate-600"
            id="email"
            type="email"
            placeholder={user.email}
            bind:value={$form.new_email}

        />
        <input
            type="password"
            class="w-full appearance-none rounded border border-slate-200 px-3 py-2 text-sm font-light leading-tight text-slate-600"
            id="password"
            name="password"
            placeholder="******"
            bind:value={$form.current_password}
            required

        />
        <div class="mt-6 flex justify-end">
            <button
                class="rounded-lg bg-blue-800 px-8 py-2 text-base font-medium text-white hover:opacity-80"
                type="submit"
            >
                Update
            </button>
        </div>
    </form>
</div>

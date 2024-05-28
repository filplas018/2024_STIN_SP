<script>
    import {useForm} from "@inertiajs/svelte";

    let form = useForm({
        current_password: null,
        new_password:null,
        new_password_confirmation: null,
    })
    function submitPassword() {
        $form.post('/change-password')
    }
</script>

<div class="rounded-2xl bg-white p-5">
    <h1 class="mb-4 text-md font-medium">Change Password</h1>
    <form on:submit|preventDefault={submitPassword}>

        <div class="mb-6">
            <label class="mb-1 block text-sm text-slate-800" for="password">Current Password</label>
            <div class="flex items-center">
                <input
                    type="password"
                    class="w-full appearance-none rounded border border-slate-200 px-3 py-2 text-sm font-light leading-tight text-slate-600"
                    id="password"
                    name="password"
                    placeholder="******"
                    bind:value={$form.current_password}
                    required

                />

            </div>
        </div>
        <div class="mb-6">
            <label class="mb-1 block text-sm text-slate-800" for="password">New Password</label>
            <div class="flex items-center">
                <input
                    type="password"
                    class="w-full appearance-none rounded border border-slate-200 px-3 py-2 text-sm font-light leading-tight text-slate-600"
                    id="newPassword"
                    name="newPassword"
                    bind:value={$form.new_password}
                    placeholder="******"
                    required

                />

            </div>
        </div>
        <div class="mb-6">
            <label class="mb-1 block text-sm text-slate-800" for="repeatPassword">Repeat Password</label>
            <div class="flex items-center">
                <input
                    type="password"
                    class="w-full appearance-none rounded border border-slate-200 px-3 py-2 text-sm font-light leading-tight text-slate-600"
                    id="repeatPassword"
                    name="repeatPassword"
                    bind:value={$form.new_password_confirmation}
                    placeholder="******"
                    required

                />

            </div>
        </div>
        <div class="flex justify-end">
            <button
                class="rounded-lg bg-blue-800 px-8 py-2 text-base font-medium text-white hover:opacity-80"
                type="submit"
            >
                Update
            </button>
        </div>
    </form>
</div>

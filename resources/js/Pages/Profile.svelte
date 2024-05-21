<script>
    import PasswordInput from "@/Components/PasswordInput.svelte";

    export let user;

    import ChangePasswordForm from "@/Components/ChangePasswordForm.svelte";
    import ChangeEmailForm from "@/Components/ChangeEmailForm.svelte";




</script>

    <div class="rounded-2xl bg-slate-50 p-12 my-8">
        <div
            class="flex h-max min-h-80 flex-col items-center mb-4 justify-center rounded-2xl bg-white p-5 max-md:mb-8 md:basis-1/3"
        >
            <p class="text-md">{user.email}</p>

        </div>
        <div>
        <ChangeEmailForm {user}/>
        <ChangePasswordForm/>

        </div>
    </div>

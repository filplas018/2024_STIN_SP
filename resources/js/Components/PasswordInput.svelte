<script>
    //import { closedEye, openedEye } from "$lib/svg/index.js";

    let element;
    let show = false;

    export let value = undefined;
    export let id = undefined;
    export let name = undefined;
    export let required = false;
    export let label;
    export let placeholder = "******";

</script>

<template>
    <label class="mb-1 block text-sm text-slate-800" for={id}>{label}</label>
    <div class="flex items-center">
        <input
            type="password"
            class="w-full appearance-none rounded border border-slate-200 px-3 py-2 text-sm font-light leading-tight text-slate-600"
            {id}
            {name}
            {placeholder}
            {required}
            bind:this={element}
            bind:value
        />

    </div>
</template>

<style lang="postcss">
    input::-ms-reveal,
    input::-ms-clear {
        @apply hidden;
    }
</style>

<script>
    import Navbar from "./Navbar.svelte";

    export let layout = {
    };
</script>

    <svelte:head>
        <title>{layout.title}</title>
    </svelte:head>

<header>
    <Navbar/>
</header>
<main>
    <slot/>
</main>


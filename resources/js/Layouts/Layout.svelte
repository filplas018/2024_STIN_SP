<script>
    import Swal from "sweetalert2";
    import "sweetalert2/dist/sweetalert2.min.css";

    import Navbar from "./Navbar.svelte";

    export let user;
    export let layout = {
    };

    export let flash;

    $: if (flash) {
        Swal.fire({
            text: flash,
        });
    }

</script>

    <svelte:head>
        <title>{layout.title}</title>

            <!-- Other meta tags -->



    </svelte:head>

<header>
    <Navbar {user}/>
</header>
<main class="max-w-lg mx-auto">
    <slot/>
</main>


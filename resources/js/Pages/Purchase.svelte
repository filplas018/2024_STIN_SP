<script>
    import {addMonths, format} from "date-fns";
    import {useForm} from "@inertiajs/svelte";

    const form = useForm({
        card_number:null,
        card_holder:null,
        expiration_date:null,
        cvv:null,
        months:1,
    });

    function submit() {
        $form.transform((data) => ({
            ...data,
            expiration_date_month: data.expiration_date.split("/")[0],
            expiration_date_year: data.expiration_date.split("/")[1],
        }))
            .post('/purchase')
    }

</script>
<label for="months">Set months</label>
<input bind:value={$form.months} id="months" type="range" min="1" max="12"/>
<p>Will be valid until: {format(addMonths(new Date(), $form.months), "dd.MM.yyyy")}</p>

    <div class="payment-container">
        <h2>Credit Card Payment</h2>
        <form class="payment-form" on:submit|preventDefault={submit}>
            <div class="form-group">
                <label for="cardNumber">Card Number</label>
                <input
                    type="text"
                    id="cardNumber"
                    bind:value={$form.card_number}
                    placeholder="1234 5678 9012 3456"
                    required
                />
            </div>
            <div class="form-group">
                <label for="cardHolder">Cardholder Name</label>
                <input
                    type="text"
                    id="cardHolder"
                    bind:value={$form.card_holder}
                    placeholder="John Doe"
                    required
                />
            </div>
            <div class="form-group">
                <label for="expirationDate">Expiration Date</label>
                <input
                    type="text"
                    id="expirationDate"
                    bind:value={$form.expiration_date}
                    placeholder="MM/YY"
                    required
                />
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input
                    type="text"
                    id="cvv"
                    bind:value={$form.cvv}
                    placeholder="123"
                    required
                />
            </div>
            <button type="submit" class="submit-button">Submit Payment</button>
        </form>
        <p>number: 4701322211111234</p>
        <p>due: 12/26</p>
        <p>ccv: 837</p>
    </div>

<style lang="postcss">
    .payment-container {
        @apply flex flex-col items-center p-8;
    }

    .payment-form {
        @apply flex flex-col w-96;
    }

    .form-group {
        @apply mb-5;
    }

    .form-group label {
        @apply mb-5 font-bold;
    }

    .form-group input {
        @apply p-2 border border-slate-200 rounded-sm w-full;
    }

    .submit-button {
        @apply p-2.5 bg-blue-800 text-white rounded-sm cursor-pointer;
    }

    .submit-button:hover {
        @apply opacity-70;
    }
</style>

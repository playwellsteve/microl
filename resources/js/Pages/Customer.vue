<template>
    <Head title="Show Customer" />
    <h3>Inertia version</h3>
    {{ customer.full_name }}
    <br>
    <h2 class="font-bold">Transaction Total:</h2> {{ customer.formatted_transactions_total }}
    <h2 class="font-bold">Membership Months:</h2> {{ customer.membership_months }}


</template>
<script>
import { Head, Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        Head,
        Link,
    },
    props: {
        customer: Object,

    },
}
</script>

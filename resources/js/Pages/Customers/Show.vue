    <template>
        <Head title="Show Member" />

        {{ customer.full_name }}
        <br>
        <h2 class="font-bold">Transaction Total:</h2> {{ customer.formatted_transactions_total }}
        <h2 class="font-bold">Membership Months:</h2> {{ customer.membership_months }}
        <h2 class="font-bold">Last Join:</h2> {{ customer.last_join_date }}
        <h2 class="font-bold">Last Recharge Price:</h2> {{ customer.last_recharge_price }}


    </template>
    <script>
    import { Head, Link } from '@inertiajs/inertia-vue3';
    import BreezeGuestLayout from '@/Layouts/Guest.vue'

    export default {
        layout: BreezeGuestLayout,
        components: {
            Head,
            Link,
            },
        props: {
            customer: Object,


        },
    }
    </script>

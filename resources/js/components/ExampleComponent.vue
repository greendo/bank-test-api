<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card card-default">
                    <div class="card-header">Transactions</div>

                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Transaction id</th>
                                <th scope="col">Customer</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="transaction in transactions">
                                <th v-text="transaction.id"></th>
                                <td v-text="transaction.customer_id"></td>
                                <td v-text="transaction.amount"></td>
                                <td v-text="transaction.created_at"></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                transactions: [],
            }
        },
        mounted() {
            this.loadData()
        },

        methods: {
            loadData () {
                axios.get('/api/getTransactions').then((response) => {
                        this.transactions = response.data.transactions
                        console.log(this.transactions)
                    }
                )
            }
        }
    }
</script>
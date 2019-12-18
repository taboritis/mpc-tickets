<template>
  <div class="card card-body">
    <tickets-table :filters="filters"></tickets-table>
  </div>
</template>
<script>
    import TicketsTable from "./TicketsTable";

    export default {
        components: { TicketsTable },
        data() {
            return {
                filters: {
                    page: 1,
                },
            }
        }
    }
</script>

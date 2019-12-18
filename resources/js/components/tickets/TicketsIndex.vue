<template>
  <div class="card card-body">
    <div class="d-flex">
      <h3>List of tickets</h3>
    </div>
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
                    limit: 3,
                },
            }
        }
    }
</script>

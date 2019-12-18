<template>
  <div class="card card-body">
    <div class="d-flex">
      <h3 class="mr-auto">List of Tickets</h3>
      <div @click="changeScope" class="text-secondary" v-if="filters.openTicketsOnly">Open tickets only</div>
      <div @click="changeScope" class="text-primary" v-else>All tickets</div>
    </div>
    <tickets-filters :filters="filters"></tickets-filters>
    <tickets-table :filters="filters"></tickets-table>
  </div>
</template>
<script>
    import TicketsFilters from "./TicketsFilters";
    import TicketsTable from "./TicketsTable";

    export default {

        components: { TicketsFilters, TicketsTable },

        data() {
            return {
                filters: {
                    page: 1,
                    limit: 5,
                    openTicketsOnly: true,
                },
            }
        },
        methods: {
            changeScope() {
                this.filters.openTicketsOnly = !this.filters.openTicketsOnly;
                EventsBus.$emit('filters-updated');
            }
        }
    }
</script>

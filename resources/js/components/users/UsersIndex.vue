<template>
  <div>
    <users-filters :filters="filters"></users-filters>
    <users-table :filters="filters"></users-table>
  </div>
</template>
<script>
    import UsersFilters from "./UsersFilters";
    import UsersTable from "./UsersTable";

    export default {
        components: { UsersFilters, UsersTable },

        data() {
            return {
                filters: {
                    page: 1,
                }
            }
        }
    }
</script>

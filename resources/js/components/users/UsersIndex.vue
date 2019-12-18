<template>
  <div>
    <users-filters></users-filters>
    <users-table></users-table>
  </div>
</template>
<script>
    import UsersFilters from "./UsersFilters";
    import UsersTable from "./UsersTable";

    export default {
        components: { UsersFilters, UsersTable }
    }
</script>

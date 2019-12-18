<template>
  <div class="small">
    <div class="form-group">
      <label>Assigned To</label>
      <input @keyup.enter="update"
             class="form-control form-control-sm"
             placeholder="Type a fragment and press ENTER"
             type="text" v-model="filters.assignedTo">
    </div>
  </div>
</template>
<script>
    export default {
        props: ['filters'],

        methods: {
            update() {
                this.filters.page = 1;
                EventsBus.$emit('filters-updated');
            }
        }
    }
</script>

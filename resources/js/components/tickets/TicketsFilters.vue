<template>
  <div class="row small">
    <div class="col-md-4">
      <div class="form-group">
        <label>Requested By</label>
        <input @keyup.enter="update"
               class="form-control form-control-sm"
               placeholder="Type a fragment and press ENTER"
               type="text" v-model="filters.author">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Assigned To</label>
        <input @keyup.enter="update"
               class="form-control form-control-sm"
               placeholder="Type a fragment and press ENTER"
               type="text" v-model="filters.assignedTo">
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
        <label>Title</label>
        <input @keyup.enter="update"
               class="form-control form-control-sm"
               placeholder="Type a fragment and press ENTER"
               type="text" v-model="filters.title">
      </div>
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

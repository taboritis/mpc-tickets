<template>
  <div class="small">
    <table class="table table-hover table-bordered table-sm">
      <tr>
        <th>Title</th>
        <th>Content</th>
        <th>Created at</th>
        <th>Updated at</th>
        <th>Requested By</th>
        <th>Assigned To</th>
        <th>Closed At</th>
      </tr>
      <tr v-for="ticket in dataset" v-if="dataset">
        <td></td>
        <td></td>
      </tr>
    </table>
  </div>
</template>
<script>
    export default {

        data() {
            return {
                dataset: false,
            }
        },

        created() {
            this.fetch();
        },

        methods: {
            fetch() {
                this.dataset = [1, 2, 3]
            }
        }
    }
</script>

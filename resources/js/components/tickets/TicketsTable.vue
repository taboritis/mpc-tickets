<template>
  <div>
    <table class="table table-hover table-sm">
      <tr>
        <th>Title and content</th>
        <th class="text-right">Timestamps</th>
      </tr>
      <tr v-for="ticket in dataset.data" v-if="dataset">
        <td>
          <strong>{{ ticket.title }}</strong><br>
          <span class="small">{{ ticket.content }}</span><br>
          <span class="small mr-3"><i class="fa fa-user mr-1 text-primary"></i>{{ ticket.author }}</span>
          <span class="small mr-3"><i class="fa fa-map-pin mr-1 text-danger"></i>{{ ticket.assignedTo }}</span>
        </td>
        <td class="small text-right">
          Created at: {{ ticket.created_at }}<br>
          Updated at: {{ ticket.updated_at }}<br>
          Closed at: {{ ticket.closed_at }}
        </td>
      </tr>
    </table>
  </div>
</template>
<script>
    export default {

        props: ['filters'],

        data() {
            return {
                dataset: false,
            }
        },

        created() {
            this.fetch();
            EventsBus.$on('filters-updated', () => this.fetch());
        },

        methods: {
            fetch() {
                axios.get('/api/tickets', {
                    params: this.filters
                }).then(res => {
                    this.dataset = res.data;
                })
            }
        }
    }
</script>

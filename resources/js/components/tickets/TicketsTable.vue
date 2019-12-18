<template>
  <div>
    <table class="table table-hover table-sm">
      <tr>
        <th>Title and content</th>
        <th class="text-right">Timestamps</th>
      </tr>
      <tr v-for="ticket in dataset.data" v-if="dataset">
        <td>
          <strong><a :href="ticket.path">{{ ticket.title }}</a></strong><br>
          <span class="small">{{ ticket.content | limit(100) }}</span><br>
          <span class="small mr-3"><i class="fa fa-user mr-1 text-primary"></i>{{ ticket.author }}</span>
          <span class="small mr-3"><i class="fa fa-map-pin mr-1 text-danger"></i>{{ ticket.assignedTo }}</span>
        </td>
        <td class="small text-right">
          <span>Created at: {{ ticket.created_at }}</span><br>
          <span>Updated at: {{ ticket.updated_at }}</span><br>
          <span v-if="ticket.closed_at"> Closed at: {{ ticket.closed_at }}</span>
        </td>
      </tr>
    </table>
    <div class="d-flex justify-content-around small">
      <div class="mr-auto">
        <paginator :dataset="dataset" @changed="changePage"></paginator>
      </div>
      <div class="form-inline">
        <div class="mr-2">Results:</div>
        <select @change="fetch" class="form-control form-control-sm" v-model="filters.limit">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
      </div>
    </div>
  </div>
</template>
<script>
    import Paginator from "../Paginator";

    export default {

        components: { Paginator },

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

        filters: {
            limit(string, value) {
                let dots = (string.length > value) ? '...' : '';
                return string.substring(0, value) + dots;
            }
        },

        methods: {
            fetch() {
                axios.get('/api/tickets', {
                    params: this.filters
                }).then(res => {
                    this.dataset = res.data;
                })
            },
            changePage(page) {
                this.filters.page = page;
                this.fetch();
            }

        }
    }
</script>

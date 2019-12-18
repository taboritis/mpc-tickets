<template>
  <div class="row">
    <div class="col-md-12">
      <table class="table table-hover table-sm">
        <tr>
          <th>Name</th>
          <th>Surname</th>
          <th>Email</th>
          <th width="100px"></th>
        </tr>
        <tr v-for="user in dataset.data" v-if="dataset">
          <td>{{ user.name }}</td>
          <td>{{ user.surname }}</td>
          <td>{{ user.email }}</td>
          <td class="text-right">
            <div class="d-flex">
              <div class="text-center mr-auto">
              <span v-if="user.notes.length !== 0">
                <i class="fa fa-sticky-note-o text-danger mr-1"></i>{{ user.notes.length }}
              </span>
              </div>
              <div class="text-center ml-2">
                <i class="fa fa-check-square-o text-primary ml-1"></i> {{ user.tickets_number }}
              </div>
            </div>
          </td>
        </tr>
      </table>
      <div class="row justify-content-center">
        <paginator :dataset="dataset" @changed="changePage"></paginator>
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
                dataset: false
            }
        },

        created() {
            this.fetch()
        },

        methods: {
            fetch() {
                axios.get('/api/users', { params: this.filters })
                    .then(res => {
                        this.dataset = res.data
                    });
            },

            changePage(page) {
                this.filters.page = page;
                this.fetch();
            }
        }
    }
</script>

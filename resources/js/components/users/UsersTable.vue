<template>
  <div class="small">
    <table class="table table-hover table-sm">
      <tr>
        <th>Name</th>
        <th>Surname</th>
        <th>Email</th>
      </tr>
      <tr v-for="user in dataset.data" v-if="dataset">
        <td>{{ user.name }}</td>
        <td>{{ user.surname }}</td>
        <td>
          <div class="d-flex">
            <div class="mr-auto">{{ user.email }}</div>
            <div class="ml-2">Notes: {{ user.notes.length }}</div>
            <div class="ml-2">Tasks: {{ user.tickets_number }}</div>
          </div>
        </td>
      </tr>
    </table>
    <div class="row justify-content-center">
      <paginator :dataset="dataset" @changed="changePage"></paginator>
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

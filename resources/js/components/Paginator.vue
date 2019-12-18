<template>
  <div>
    <ul class="pagination" v-if="shouldPaginate">
      <li class="page-item" v-show="prevUrl">
        <a @click.prevent="page--" class="page-link" href="#" rel="prev"> &laquo; Poprzednia </a>
      </li>
      <li class="page-item active">
        <a class="page-link" href="#">{{ page }} z {{ dataset.last_page }}<span class="sr-only">(current)</span></a>
      </li>
      <li class="page-item" v-show="nextUrl">
        <a @click.prevent="page++" class="page-link" href="#" rel="next"> Następna &raquo; </a>
      </li>
    </ul>
  </div>
</template>
<script>
    export default {
        props: ['dataset'],

        data() {
            return {
                page: 1,
                prevUrl: false,
                nextUrl: false
            }
        },

        created() {
            this.page = this.dataset.current_page;
            this.prevUrl = this.dataset.prev_page_url;
            this.nextUrl = this.dataset.next_page_url;
        },

        watch: {

            dataset() {
                this.page = this.dataset.current_page;
                this.prevUrl = this.dataset.prev_page_url;
                this.nextUrl = this.dataset.next_page_url;
            },

            page() {
                this.broadcast();
            }

        },

        computed: {
            shouldPaginate() {
                return !!this.prevUrl || !!this.nextUrl;
            }
        },

        methods: {
            broadcast() {
                return this.$emit('changed', this.page);
            },
        }
    }
</script>

<template>
  <div>
    <ul class="pagination" v-if="shouldPaginate">
      <li class="page-item" v-show="prevUrl">
        <a @click.prevent="page--" class="page-link" href="#" rel="prev"> &laquo; Prev </a>
      </li>
      <li class="page-item active">
        <a class="page-link" href="#">{{ page }} from {{ dataset.meta.last_page }}<span class="sr-only">(current)</span></a>
      </li>
      <li class="page-item" v-show="nextUrl">
        <a @click.prevent="page++" class="page-link" href="#" rel="next"> Next &raquo; </a>
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
            if (this.dataset) {
                this.page = this.dataset.meta.current_page;
                this.prevUrl = this.dataset.links.prev;
                this.nextUrl = this.dataset.links.next;
            }
        },

        watch: {

            dataset() {
                this.page = this.dataset.meta.current_page;
                this.prevUrl = this.dataset.links.prev;
                this.nextUrl = this.dataset.links.next;
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

<template>
    <div>
        <div class="row">
            <div class="col-12" v-for="post in posts"  >
                <!-- Widget: user widget style 2 -->
                <div class="card card-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-warning">
                        <!-- /.widget-user-image -->
                        <h3>{{ post.title }}</h3>
                        <p>{{post.body}}</p>
                        <small class="widget-user-username">{{ post.name }}.{{ post.email }} </small>

                    </div>
                    </div>
                <!-- /.widget-user -->
            </div>

        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            posts: [],
            post: {
                id: '',
                name:'',
                budget:'',
                budgets: []
            }
        };
    },
    created() {
        this.fetchPosts();
    },
    methods: {
        fetchPosts(page_url) {
            page_url = page_url || 'api/show';
            fetch(page_url)
                .then(res => res.json())
                .then(res => {
                    this.posts = res;
                    console.log(this.posts);
                })
                .catch(err => console.log(err));
        },
    }
};
</script>

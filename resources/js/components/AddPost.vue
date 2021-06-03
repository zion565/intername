<template>
    <div>
        <!--        <h2>תזרים</h2>-->
        <form @submit.prevent="addPost" class="mb-3">
            <div class="row">
                <div class="col-12">

                    <div class="form-group">
                        <input  class="form-control" placeholder="name" v-model="post.name">
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="email" v-model="post.email">
                    </div>

                    <div class="form-group">
                        <input  class="form-control" placeholder="post title" v-model="post.title">
                    </div>

                    <div class="form-group">
                        <textarea type="email" class="form-control" placeholder="post body" v-model="post.body"></textarea>
                    </div>

                    <div >
                        <button type="submit" class="btn btn-success btn-block">save</button>
                    </div>
                        <div >
                            <button type="button" @click="curl()" class="btn btn-info btn-block">fetch all post from url</button>
                        </div>
                    <div >
                        <button type="button" @click="sql_task()" class="btn btn-dark btn-block">the sql task (6)</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</template>

<script>
import Posts from './Posts'
export default {
    components: {
        Posts
    },
    data() {
        return {
            post: {
                id: '',
                name:'',
                email:'',
                title:'',
                body:'',
            },
            post_id: '',
        };
    },
    methods: {
        addPost() {
                // Add
                fetch('api/store', {
                    method: 'post',
                    body: JSON.stringify(this.post),
                    headers: {
                        'content-type': 'application/json'
                    }
                })
                    .then(res => res)
                    .then(data => {
                        console.log(data);
                        this.clearForm();
                        // alert('post Added');
                        window.location.reload();
                    })
                    .catch(err => console.log(err));
        },

        clearForm() {
            this.post.id = null;
            this.post.name = '';
            this.post.email = '';
            this.post.title = '';
            this.post.body = '';
        },
        curl() {
            fetch('api/fetch', {
                method: 'get',
                headers: {
                    'content-type': 'application/json'
                }
            })
                .then(res => res)
                .then(data => {
                    console.log(data);
                    window.location.reload();
                })
                .catch(err => console.log(err));
        },
        sql_task() {
            fetch('api/query', {
                method: 'get',
                headers: {
                    'content-type': 'application/json'
                }
            })
                .then(res => res)
                .then(data => {
                    console.log(data);
                    //window.location.reload();
                })
                .catch(err => console.log(err));
        }
    }
};
</script>

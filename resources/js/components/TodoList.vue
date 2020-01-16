<template>
    <div>
        <div class="d-flex align-items-center justify-content-between">
            <form class="form-inline">
                <input type="text" class="form-control mr-2" placeholder="Title" v-model="form.title">
                <button class="btn btn-primary" v-on:click="submit">Add Task</button>
            </form>
            <a href="#" v-if="showing == 'pending'" v-on:click.stop="showComplete">Show Complete</a>
            <a href="#" v-if="showing == 'complete'" v-on:click.stop="showPending">Show Pending</a>
        </div>
        <hr>
        <div class="card card-body my-2" v-for="item in items">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" v-if="item.status == 'pending'" v-on:click="complete(item)">
                <input class="form-check-input" type="checkbox" v-if="item.status == 'complete'" checked>
                <label class="form-check-label">{{ item.title }}</label>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                showing: 'pending',
                items: [],
                form: {
                    title: null,
                },
            }
        },
        methods: {
            submit() {
                axios.post('/items', {
                    title: this.form.title,
                }).then(response => {
                    this.form.title = null;
                    this.getItems();
                });
            },
            complete(item) {
                axios.post('/items/complete/'+item.id)
                    .then(response => {
                        this.getItems();
                    });
            },
            getItems(status = null) {
                if(! status) {
                    axios.get('/items')
                        .then(response => {
                            this.items = response.data;
                        });
                } else {
                    axios.get('/items/'+status)
                        .then(response => {
                            this.items = response.data;
                        });
                }
            },
            showComplete() {
                this.showing = 'complete';
                this.getItems('complete');
            },
            showPending() {
                this.showing = 'pending';
                this.getItems();
            }
        },
        mounted() {
            this.getItems();
        }
    }
</script>

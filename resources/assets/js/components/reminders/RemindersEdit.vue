<template>
    <div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document" >
                <form v-on:submit.prevent="saveCategory()">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Add new category</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-xs-12 form-group">
                                    <label class="control-label" >Would you like to add a new category?</label>
                                    <input type="text" style="width:50%; display:unset;" required v-model="category.name" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <span class="pull-right">
                                <button type="submit" class="btn btn-primary">
                                    Add Category
                                </button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="form-group">
            <router-link to="/" class="btn btn-default">Back</router-link>
        </div>
 
        <div class="panel panel-default">
            <div class="panel-heading">Edit reminder</div>
            <div class="panel-body">
                <form v-on:submit.prevent="saveForm()">
                    <div class="row">
                        <div class="col-xs-7 form-group">
                            <label class="control-label">Reminder title</label>
                            <input type="text" required v-model="reminder.title" class="form-control">
                        </div>
                        <div class="col-xs-5 form-group">
                            <label class="control-label" style="display:block;" >Category</label>
                            <select v-model="reminder.category" class="form-control" style="width:70%; display:unset;" >
                                <option v-for="category in categories" v-bind:value="category.id" :key="category.id" >
                                    {{ category.name }}
                                </option>
                            </select>
                            <button class="btn btn-default" style="border:none; padding:6px 4px;" v-on:click.prevent=";" data-toggle="modal" data-target="#myModal" >
                                <img src="/open-iconic/svg/plus.svg" width="15" alt="add category" />
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 form-group">
                            <label class="control-label">Is a Payment?</label>
                            <input type="checkbox" v-model="reminder.isPayment">
                        </div>
                        <div v-if="reminder.isPayment == 1" class="col-xs-8 form-group">
                            <label class="control-label">Amount</label>
                            <input type="number" v-bind:required="reminder.isPayment == 1 ? true : false"  min="0" step=".01" v-model="reminder.amount" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Location</label>
                            <input type="text" v-model="reminder.location" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Frecuency</label>
                            <input type="text" required v-model="reminder.frecuency" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            <label class="control-label">Repeat</label>
                            <input type="checkbox" v-model="reminder.repeat">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 form-group">
                            <label class="control-label">Alarm Date</label>
                            <input type="date" v-model="reminder.alarmDate" class="form-control">
                        </div>
                        <div class="col-xs-6 form-group">
                            <label class="control-label">Alarm Time</label>
                            <input type="time" required v-model="reminder.alarmTime" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Delete it when finished?</label>
                            <input type="checkbox" v-model="reminder.deleteIt">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            let app = this;
            let id = app.$route.params.id;
            app.reminderId = id;
            axios.get('/api/v1/reminders/' + id)
                .then(function (resp) {
                    app.reminder = resp.data;
                })
                .catch(function () {
                    alert("Could not load your reminder")
                });

            axios.get('/api/v1/categories')
                .then(function (resp) {
                    app.categories = resp.data;
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load categories");
                });
        },
        data: function () {
            return {
                reminderId: null,
                reminder: {
                    userId: '',
                    title: '',
                    isPayment: false,
                    amount: null,
                    location: null,
                    frecuency: '',
                    repeat: false,
                    alarmDate: null,
                    alarmTime: '',
                    deleteIt: false,
                },
                category: {
                    userId: '',
                    name: ''
                },
                categories: []
            }
        },
        methods: {
            saveForm() {
                var app = this;
                var newReminder = app.reminder;
                if (!newReminder.isPayment) {
                    newReminder.amount=null;
                }
                axios.patch('/api/v1/reminders/' + app.reminderId, newReminder)
                    .then(function (resp) {
                        app.$router.replace('/');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your reminder");
                    });
            },
            saveCategory() {
                var app = this;
                var newCategory = app.category;
                axios.post('/api/v1/categories', newCategory)
                    .then(function (resp) {
                        app.category.name='';
                        $('#myModal').modal('hide');
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your category");
                        app.category.name='';
                        $('#myModal').modal('hide');
                    });
                
                axios.get('/api/v1/categories')
                        .then(function (resp) {
                            app.categories = resp.data;
                        })
                        .catch(function (resp) {
                            console.log(resp);
                            alert("Could not load categories");
                        });
            }
        }
    }
</script>
 
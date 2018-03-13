<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-default">Back</router-link>
        </div>
 
        <div class="panel panel-default">
            <div class="panel-heading">Create new reminder</div>
            <div class="panel-body">
                <form v-on:submit.prevent="saveForm()">
                    <div class="row">
                        <div class="col-xs-7 form-group">
                            <label class="control-label">Reminder title</label>
                            <input type="text" required v-model="reminder.title" class="form-control">
                        </div>
                        <div class="col-xs-5 form-group">
                            <label class="control-label">Category</label>
                            <select v-model="reminder.category" class="form-control" >
                                <option v-for="category in categories" v-bind:value="category.id">
                                    {{ category.name }}
                                </option>
                            </select>
                            <button class="btn btn-default" v-on:click.prevent="addCategory()" >
                               <img src="/open-iconic/svg/plus.svg" alt="add category" />
                            </button>
                            <button class="btn btn-default" v-on:click.prevent="deleteCategory()" >
                               <img src="/open-iconic/svg/trash.svg" alt="delete category" />
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 form-group">
                            <label class="control-label">Is a Payment?</label>
                            <input type="checkbox" v-model="reminder.isPayment">
                        </div>
                        <div class="col-xs-8 form-group">
                            <label class="control-label">Amount</label>
                            <input type="number" required min="0" step=".01" v-model="reminder.amount" class="form-control">
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
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data: function () {
            return {
                reminder: {
                    title: '',
                    category: 1,
                    isPayment: false,
                    amount: null,
                    location: null,
                    frecuency: '',
                    repeat: false,
                    alarmDate: null,
                    alarmTime: '',
                    deleteIt: false,
                },
                categories: []
            }
        },
        mounted() {
            var app = this;
            axios.get('/api/v1/categories')
                .then(function (resp) {
                    app.categories = resp.data;
                    //console.log(app.categories);
                })
                .catch(function (resp) {
                    console.log(resp);
                    alert("Could not load categories");
                });
        },
        methods: {
            saveForm() {
                var app = this;
                var newReminder = app.reminder;
                axios.post('/api/v1/reminders', newReminder)
                    .then(function (resp) {
                        app.$router.push({path: '/'});
                    })
                    .catch(function (resp) {
                        console.log(resp);
                        alert("Could not create your reminder");
                    });
            },
            addCategory() {
                alert("");
            },
            deleteCategory() {
                alert("");
            }
        }
    }
</script>
 